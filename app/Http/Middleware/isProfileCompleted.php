<?php

namespace App\Http\Middleware;

use App\Models\frontend\ShippingAddresses;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isProfileCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $shipping_address = ShippingAddresses::where('user_id', auth()->user()->id)->exists();
        if (!$shipping_address) 
        {
            return redirect()->route('address.index')->with('error' , 'Please complete your shipping address details');
        }

        return $next($request);
    }
}
