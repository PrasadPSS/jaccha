<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\Coupons;
use App\Models\frontend\CartCoupons;
use App\Models\frontend\OrderCoupons;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController1 extends Controller
{
    public function applyCoupon(Request $request)
    {
        $couponCode = $request->coupon_code;

        // Validate input
        if (!$couponCode) {
            return response()->json(['success' => false, 'message' => 'Coupon code is required.']);
        }

        // Find coupon
        $coupon = \DB::table('coupons')->where('coupon_code', $couponCode)->where('status', 1)->first();
        $onceperuser = Coupons::where('coupon_code', $couponCode)->where('status', 1)->where('coupon_once_per_user', 1)->exists();


        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid coupon code.']);
        }

        // Check if expired
        $currentDate = Carbon::now();
        if ($currentDate->lt(Carbon::parse($coupon->start_date)) || $currentDate->gt(Carbon::parse($coupon->end_date))) {
            return response()->json(['success' => false, 'message' => 'Coupon is expired.']);
        }

        // Check cart usage limit
        $usageCount = OrderCoupons::where('user_id', auth()->user()->id)->where('coupon_code', $couponCode)->count();
        if ($usageCount >= $coupon->coupon_usage_limit || ($onceperuser && $usageCount >= 1)) {
            return response()->json(['success' => false, 'message' => 'Coupon usage limit has been reached.']);
        }

        // Check cart minimum value
        $cartTotal = get_cart_amounts()->cart->cart_mrp_total; // Assuming helper function is defined

        if ($cartTotal < $coupon->coupon_purchase_limit) {
            return response()->json(['success' => false, 'message' => 'Minimum cart value not met.']);
        }

        // Calculate discount
        $discountAmount = 0;
        if ($coupon->coupon_type === 'flat') {
            $discountAmount = $coupon->value;
        } elseif ($coupon->coupon_type === 'percentage') {
            $discountAmount = ($cartTotal * $coupon->value) / 100;
        }

        // Ensure discount doesn’t exceed cart total
        $discountAmount = min($discountAmount, $cartTotal);

        // Update final total
        $updatedTotal = $cartTotal - $discountAmount;

        // Decrement usage limit
        

        return response()->json([
            'success' => true,
            'discountAmount' => $discountAmount,
            'updatedTotal' => $updatedTotal,
            'message' => 'Coupon applied successfully!'
        ]);
    }
}
