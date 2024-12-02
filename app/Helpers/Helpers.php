<?php
use App\Models\frontend\Cart;
use App\Models\frontend\Orders;
// use App\Models\frontend\Orders;
use App\Models\frontend\CartCoupons;
use App\Models\backend\OrderReturnManagement;
use App\Models\backend\OrderCancelManagement;
use App\Models\backend\StateCodes;
use Illuminate\Database\Eloquent\Collection;

if (!function_exists('get_shipping_charges'))
{
  // $md(string) : modeBilling mode of shipment(E: Express/ S: Surface)(mandatory)
  // $cgm(int32) : Weight of shipment in grams(Mandatory)
  // $o_pin(int32) : Origin center's Pin Code (optional)
  // $d_pin(int32) : Pin code of destination city (optional)
  // $ss(string) : Status of shipment Delivered,RTO,DTO(Mandatory)

  function get_shipping_charges($md,$cgm,$o_pin,$ss,$d_pin)
  {
    // dd($cgm);
    $accesstoken = 'c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49';
    // $url = "https://track.delhivery.com/api/kinko/v1/invoice/charges/.json?md=".$md."&cgm=".$cgm."&=".$o_pin."&ss=".$ss."&d_pin=".$d_pin;//staging
    $url = "https://track.delhivery.com/api/kinko/v1/invoice/charges/.json?md=".$md."&cgm=".$cgm."&=".$o_pin."&ss=".$ss."&d_pin=".$d_pin;//live
    $curl = curl_init();

    $headr = array();
    $headr[] = 'Access: 0';
    $headr[] = 'Content-type: application/json';
    $headr[] = 'Authorization: Token '.$accesstoken;

    curl_setopt($curl, CURLOPT_HTTPHEADER,$headr);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);

    return $data;

  }
}

//cart total
//discounted price total
if (!function_exists('get_cart_total'))
{
    function get_cart_total()
    {
      $cart_total = new stdClass();
      $total = 0;
      $mrp_total = 0;
      if(isset(auth()->user()->id))
      {
        $user_id = auth()->user()->id;
        if($user_id)
        {
          // $cart_total = Cart::where('user_id',$user_id)->with(['products'])->select(DB::raw('sum(products.product_discounted_price*cart.qty) as cart_total'))->first();
          // $cart_total = Cart::where('user_id',$user_id)->join('products', 'products.product_id', '=', 'cart.product_id')->select(DB::raw('sum(products.product_discounted_price*cart.qty) as cart_total'))->first();
          $cart = Cart::where('user_id',$user_id)->with(['products','product_variant'])->get();
          foreach ($cart as $item)
          {
            $join_table = 'products';
            if($item->product_type=="configurable")
            {
              $join_table = 'product_variant';
            }
            $total += $item->{$join_table}->product_discounted_price*$item->qty;
          }
        }
      }
      // else
      // {
      //   if (session('cart') != null) {
      //       $cart = new Collection();
      //       foreach (session('cart') as $item) {
      //           $product_id[] = $item['product_id'];
      //           $cart_details = new Cart();
      //           $cart_details->fill($item);
      //           $cart_details->qty = $item['quantity'];
      //           $cart->push($cart_details);
      //       }
      //       foreach ($cart as $item)
      //       {
      //         $join_table = 'products';
      //         if($item->product_type=="configurable")
      //         {
      //           $join_table = 'product_variant';
      //         }
      //         $total += $item->{$join_table}->product_discounted_price*$item->qty;
      //       }
      //   }
      // }
      $cart_total->cart_total = $total;
      return $cart_total;
    }
}

if (!function_exists('get_cart_mrp_total'))
{
    function get_cart_mrp_total()
    {
      $cart_total = new stdClass();
      // $cart_total;
      $total = 0;
      if(isset(auth()->user()->id))
      {
        $user_id = auth()->user()->id;
        if($user_id)
        {
          // $cart_total = Cart::where('user_id',$user_id)->with(['products'])->select(DB::raw('sum(products.product_discounted_price*cart.qty) as cart_total'))->first();
          // $cart_total = Cart::where('user_id',$user_id)->join('products', 'products.product_id', '=', 'cart.product_id')->select(DB::raw('sum(products.product_price*cart.qty) as cart_total'))->first();
          $cart = Cart::where('user_id',$user_id)->with(['products','product_variant'])->get();
          foreach ($cart as $item)
          {
            $join_table = 'products';
            if($item->product_type=="configurable")
            {
              $join_table = 'product_variant';
            }
            if($item->{$join_table}->product_discounted_price!=null && $item->{$join_table}->product_discount!=0)
            {
              $total += $item->{$join_table}->product_price*$item->qty;
            }
            elseif($item->{$join_table}->product_discounted_price!=null && $item->{$join_table}->product_discount==0)
            {
              $total += $item->{$join_table}->product_discounted_price*$item->qty;
            }
            else
            {
              $total += $item->{$join_table}->product_price*$item->qty;
            }
          }
        }
      }
      else
      {
        if (session('cart') != null) {
            $cart = new Collection();
            foreach (session('cart') as $item) {
                $product_id[] = $item['product_id'];
                $cart_details = new Cart();
                $cart_details->fill($item);
                $cart_details->qty = $item['quantity'];
                $cart->push($cart_details);
            }
            foreach ($cart as $item)
            {
              $join_table = 'products';
              if($item->product_type=="configurable")
              {
                $join_table = 'product_variant';
              }
              if($item->{$join_table}->product_discounted_price!=null && $item->{$join_table}->product_discount!=0)
              {
                $total += $item->{$join_table}->product_price*$item->qty;
              }
              elseif($item->{$join_table}->product_discounted_price!=null && $item->{$join_table}->product_discount==0)
              {
                $total += $item->{$join_table}->product_discounted_price*$item->qty;
              }
              else
              {
                $total += $item->{$join_table}->product_price*$item->qty;
              }
            }
        }
      }
      $cart_total->cart_total = $total;
      return $cart_total;
    }
}

if (!function_exists('get_coupon_usage_count'))
{
    function get_coupon_usage_count($coupon_code)
    {
      $coupon_count = 0;
      if(isset(auth()->user()->id))
      {
        $user_id = auth()->user()->id;
        if($user_id)
        {
          $coupon_count = Orders::where('user_id',$user_id)->where('coupon_code',$coupon_code)->count();
        }
      }

      return $coupon_count;
    }
}

if (!function_exists('verify_pincode'))
{
    function verify_pincode($pincode)
    {
      $accesstoken = 'c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49';//'ec1ee821dc6ca3355a018d48828d3e2ccb892de7';//c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49
    //   $url = "https://staging-express.delhivery.com/c/api/pin-codes/json/?token=".$accesstoken."&filter_codes=".$pincode;//staging
      $url = "https://track.delhivery.com/c/api/pin-codes/json/?token=".$accesstoken."&filter_codes=".$pincode;//live
      $curl = curl_init();

      $headr = array();
      $headr[] = 'Access: 0';
      $headr[] = 'Content-type: application/json';
      $headr[] = 'Authorization: Token '.$accesstoken;

      curl_setopt($curl, CURLOPT_HTTPHEADER,$headr);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      $data = curl_exec($curl);
      curl_close($curl);
      // dd($data);
      return $data;
    }
}

if (!function_exists('order_creation'))
{
  // $md(string) : modeBilling mode of shipment(E: Express/ S: Surface)(mandatory)
  // $cgm(int32) : Weight of shipment in grams(Mandatory)
  // $o_pin(int32) : Origin center's Pin Code (optional)
  // $d_pin(int32) : Pin code of destination city (optional)
  // $ss(string) : Status of shipment Delivered,RTO,DTO(Mandatory)

  function order_creation($current_order)
{
    // Shiprocket credentials from .env
    $email = env('SHIPROCKET_EMAIL');
    $password = env('SHIPROCKET_PASSWORD');

    // Shiprocket API endpoints
    $authUrl = 'https://apiv2.shiprocket.in/v1/external/auth/login';
    $createOrderUrl = 'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc';

    // Step 1: Authenticate and get access token
    $authPayload = [
        'email' => $email,
        'password' => $password,
    ];


    $authResponse = makeCurlRequest($authUrl, $authPayload);

    if (isset($authResponse['token'])) {
        $accessToken = $authResponse['token'];
        
    } else {
        throw new Exception('Authentication with Shiprocket failed: ' . json_encode($authResponse));
    }

    // Step 2: Prepare order payload
    $orderPayload = [
      "order_id" => $current_order->order_id,
      "order_date" => now()->toDateTimeString(), // Format: "YYYY-MM-DD HH:MM"
      "pickup_location" => "Jammu", // Replace with the actual pickup location configured in Shiprocket
      "channel_id" => "", // Leave empty if not applicable
      "comment" => "Reseller: M/s Goku", // Replace with the comment if needed
      "billing_customer_name" => $current_order->shipping_full_name,
      "billing_last_name" => "", // Optional
      "billing_address" => "sadsadsa", // Address (Make sure it is filled)
      "billing_address_2" => $current_order->shipping_address_line2 ?? "dsfsdfsdf", // Address line 2 (Optional)
      "billing_city" => $current_order->shipping_city,
      "billing_pincode" => $current_order->shipping_pincode,
      "billing_state" => $current_order->shipping_state,
      "billing_country" => "India", // Default to India
      "billing_email" => $current_order->customer_email ?? "test@example.com", // Replace fallback email as needed
      "billing_phone" => $current_order->shipping_mobile_no,
      "shipping_is_billing" => true, // Assuming shipping is the same as billing
      "shipping_customer_name" => $current_order->shipping_full_name, // Same as billing
      "shipping_last_name" => "", // Optional
      "shipping_address" => "sadsadsa", // Address (Same as billing)
      "shipping_address_2" => $current_order->shipping_address_line2 ?? "dsfsdfsdf", // Address line 2 (Same as billing)
      "shipping_city" => $current_order->shipping_city,
      "shipping_pincode" => $current_order->shipping_pincode,
      "shipping_country" => "India", // Same as billing
      "shipping_state" => $current_order->shipping_state,
      "shipping_email" => $current_order->customer_email ?? "test@example.com", // Same as billing
      "shipping_phone" => $current_order->shipping_mobile_no,
      "order_items" => $current_order->orderproducts->map(function ($item) {
          return [
              "name" => $item->product_title, // Product name
              "sku" => $item->product_sku ?? "N/A", // SKU or fallback
              "units" => $item->qty, // Quantity
              "selling_price" => $item->product_discounted_price, // Selling price per unit
              "discount" => "", // Discount if applicable
              "tax" => "", // Tax if applicable
              "hsn" => $item->product_hsn ?? 441122 // Fallback HSN
          ];
      })->toArray(),
      "payment_method" => $current_order->payment_mode == "cod" ? "COD" : "Prepaid", // COD or Prepaid
      "shipping_charges" => 0, // Replace with actual charges if applicable
      "giftwrap_charges" => 0, // Replace if applicable
      "transaction_charges" => 0, // Replace if applicable
      "total_discount" => 0, // Replace if applicable
      "sub_total" => $current_order->total, // Total amount
      "length" => 10, // Replace with actual length
      "breadth" => 15, // Replace with actual breadth
      "height" => 20, // Replace with actual height
      "weight" => $current_order->orderproducts->sum(fn($item) => $item->product_weight * $item->qty) // Total weight
  ];

  
  

    // Step 3: Create the order
    $orderResponse = makeCurlRequest2($createOrderUrl, $orderPayload, $accessToken);
    dd($orderResponse);
    return $orderResponse;
}

 function makeCurlRequest($url, $payload, $accessToken = null)
{
    $curl = curl_init();

    $headers = [
        'Content-Type: application/json',
    ];

    if ($accessToken) {
        $headers[] = 'Authorization: Bearer ' . $accessToken;
    }

    curl_setopt_array($curl, [
      CURLOPT_URL => $url,
      CURLOPT_POST => true,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => json_encode($payload),
      CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification
  ]);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        throw new Exception('Curl error: ' . curl_error($curl));
    }

    curl_close($curl);

    return json_decode($response, true);
}

function makeCurlRequest2($url, $payload, $accessToken = null)
{
    $curl = curl_init();

    $headers = [
        'Content-Type: application/json',
    ];

    if ($accessToken) {
        $headers[] = 'Authorization: Bearer ' . $accessToken;
    }

    curl_setopt_array($curl, [
      CURLOPT_URL => $url,
      CURLOPT_POST => true,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => '{
        "order_id": "ORD123456789",
        "order_date": "2024-11-28 10:30:00",
        "pickup_location": "New Delhi",
        "channel_id": "1234",
        "comment": "Reseller: M/s XYZ Ltd.",
        "reseller_name": "M/s XYZ Ltd.",
        "company_name": "XYZ Pvt Ltd.",
        "billing_customer_name": "John Doe",
        "billing_last_name": "Doe",
        "shipping_address": "123, ABC Street",
        "billing_address_2": "Near XYZ Park",
        "billing_isd_code": "+91",
        "billing_city": "New Delhi",
        "billing_pincode": "110001",
        "billing_state": "Delhi",
        "billing_country": "India",
        "billing_email": "johndoe@example.com",
        "billing_phone": "9876543210",
        "billing_alternate_phone": "9876543211",
        "shipping_is_billing": false,
        "shipping_customer_name": "John Doe",
        "shipping_last_name": "Doe",
        "shipping_address": "123, ABC Street",
        "shipping_address_2": "Near XYZ Park",
        "shipping_city": "New Delhi",
        "shipping_pincode": "110001",
        "shipping_country": "India",
        "shipping_state": "Delhi",
        "shipping_email": "johndoe@example.com",
        "shipping_phone": "9876543210",
        "order_items": [
          {
            "name": "Product A",
            "sku": "PROD-A123",
            "units": 2,
            "selling_price": 500.00,
            "discount": 10.00,
            "tax": 18.00,
            "hsn": "123456"
          },
          {
            "name": "Product B",
            "sku": "PROD-B456",
            "units": 1,
            "selling_price": 1000.00,
            "discount": 20.00,
            "tax": 18.00,
            "hsn": "789012"
          }
        ],
        "payment_method": "Prepaid",
        "shipping_charges": 50.00,
        "giftwrap_charges": 20.00,
        "transaction_charges": 30.00,
        "total_discount": 30.00,
        "sub_total": 1450.00,
        "length": 15,
        "breadth": 10,
        "height": 5,
        "weight": 2.5,
        "ewaybill_no": "EWB123456789",
        "customer_gstin": "29ABCDE1234F1Z5",
        "invoice_number": "INV123456789",
        "order_type": "Adhoc"
      }'
      ,
      CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification
  ]);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        throw new Exception('Curl error: ' . curl_error($curl));
    }

    curl_close($curl);

    return json_decode($response, true);
}
}
//cart total with all prices
if (!function_exists('get_cart_amounts'))
{
    function get_cart_amounts()
    {
      $cart_total = new stdClass();
      $cart_mrp_total = 0;
      $cart_discounted_total = 0;
      $coupon_discount = 0;
      $total_discount = 0;
      // dd('test');
      if(isset(auth()->user()->id))
      {
        $user_id = auth()->user()->id;
        if($user_id)
        {
          // $cart_total = Cart::where('user_id',$user_id)->with(['products'])->select(DB::raw('sum(products.product_discounted_price*cart.qty) as cart_total'))->first();
          // $cart_total = Cart::where('user_id',$user_id)->join('products', 'products.product_id', '=', 'cart.product_id')->select(DB::raw('sum(products.product_price*cart.qty) as cart_mrp_total, sum(products.product_discounted_price*cart.qty) as cart_discounted_total'))->first();
          $cart = Cart::where('user_id',$user_id)->with(['products','product_variant'])->get();
          foreach ($cart as $item)
          {
            $join_table = 'products';
            if($item->product_type=="configurable")
            {
              $join_table = 'product_variant';
            }
            if($item->{$join_table}->product_discounted_price!=null && $item->{$join_table}->product_discount!=0)
            {
              $cart_mrp_total += $item->{$join_table}->product_price*$item->qty;
              $cart_discounted_total += $item->{$join_table}->product_discounted_price*$item->qty;
            }
            elseif($item->{$join_table}->product_discounted_price!=null && $item->{$join_table}->product_discount==0)
            {
              $cart_mrp_total += $item->{$join_table}->product_discounted_price*$item->qty;
              $cart_discounted_total += $item->{$join_table}->product_discounted_price*$item->qty;
            }
            else
            {
              $cart_mrp_total += $item->{$join_table}->product_price*$item->qty;
              $cart_discounted_total += $item->{$join_table}->product_discounted_price*$item->qty;
            }
          }
          $cart_total->cart_mrp_total = $cart_mrp_total;
          $cart_total->cart_discounted_total = $cart_discounted_total;
        }

        if ($cart_total)
        {
          //total_discount
          $total_discount = $cart_total->cart_mrp_total-$cart_total->cart_discounted_total;
          //coupon discount
          $cart_coupon = CartCoupons::where('user_id',$user_id)->with('coupon')->first();

          if(isset($cart_coupon->coupon))
          {
            $paymentDate = date('Y-m-d');
            $paymentDate = date('Y-m-d', strtotime($paymentDate));
            $contractDateBegin = date('Y-m-d', strtotime($cart_coupon->coupon->start_date));
            $contractDateEnd = date('Y-m-d', strtotime($cart_coupon->coupon->end_date));

            if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd))
            {
              if($cart_coupon->coupon->coupon_type == 'flat')
              {
                $coupon_value = $cart_coupon->coupon->value;
                $coupon_discount = $coupon_value;
              }
              else
              {
                $coupon_value = $cart_coupon->coupon->value;
                if (isset($cart_total->cart_discounted_total))
                {
                  $coupon_discount = ($cart_total->cart_discounted_total*$coupon_value)/100;
                }
              }
            }
            else
            {
            }
          }
        }
      }
      else
      {
        if (session('cart') != null) {
            $cart = new Collection();
            foreach (session('cart') as $item) {
                $product_id[] = $item['product_id'];
                $cart_details = new Cart();
                $cart_details->fill($item);
                $cart_details->qty = $item['quantity'];
                $cart->push($cart_details);
            }
            foreach ($cart as $item)
            {
              $join_table = 'products';
              if($item->product_type=="configurable")
              {
                $join_table = 'product_variant';
              }
              if($item->{$join_table}->product_discounted_price!=null && $item->{$join_table}->product_discount!=0)
              {
                $cart_mrp_total += $item->{$join_table}->product_price*$item->qty;
                $cart_discounted_total += $item->{$join_table}->product_discounted_price*$item->qty;
              }
              elseif($item->{$join_table}->product_discounted_price!=null && $item->{$join_table}->product_discount==0)
              {
                $cart_mrp_total += $item->{$join_table}->product_discounted_price*$item->qty;
                $cart_discounted_total += $item->{$join_table}->product_discounted_price*$item->qty;
              }
              else
              {
                $cart_mrp_total += $item->{$join_table}->product_price*$item->qty;
                $cart_discounted_total += $item->{$join_table}->product_discounted_price*$item->qty;
              }
            }
            $cart_total->cart_mrp_total = $cart_mrp_total;
            $cart_total->cart_discounted_total = $cart_discounted_total;
            if ($cart_total)
            {
              //total_discount
              $total_discount = $cart_total->cart_mrp_total-$cart_total->cart_discounted_total;
              
            }
        }
      }

      return (object)['cart'=>$cart_total,'total_discount'=>$total_discount,'coupon_discount'=>$coupon_discount];
    }
}

if (!function_exists('order_status'))
{
    function order_status($orders)
    {
      $progress = "PROCESSING";
      if($orders->order_return_flag == 1 && $orders->order_return_status == 1)
      {
        $progress = "RETURNED & REFUNDED";
      }
      else if($orders->order_return_flag == 1 && $orders->order_return_status == 0 && $orders->order_return_status != NULL)
      {
        // dd($orders);
        $progress = "RETURNED";
      }
      else if ($orders->order_return_flag == 1)
      {
        $progress = "RETURNING";
      }
      else
      {
        if ($orders->cancel_order_flag == 1)
        {
          $progress = "CANCELLED";
        }
        else
        {
          if ($orders->confirmed_stage == 1)
          {
            $progress = "CONFIRMED";
          }
          if ($orders->preparing_order_stage == 1)
          {
            $progress = "PREPARING YOUR ORDER";
          }
          if ($orders->shipped_stage == 1)
          {
            $progress = "SHIPPED";
          }
          if ($orders->out_for_delivery_stage == 1)
          {
            $progress = "OUT FOR DELIVERY";
          }
          if ($orders->delivered_stage == 1)
          {
            $progress = "DELIVERED";
          }
        }
      }

      return $progress;
    }
}

if (!function_exists('order_return_days_status'))
{
    function order_return_days_status($orders)
    {
      $return_status = false;

      if ($orders->delivered_stage == 1 && $orders->delivered_date != '')
      {
        $order_return = OrderReturnManagement::first();

        $todayDate = date('Y-m-d H:i:s');
        $todayDate = date('Y-m-d H:i:s', strtotime($todayDate));

        $deliveryDate = $orders->delivered_date;
        $deliveryDate = date('Y-m-d H:i:s', strtotime($deliveryDate));

        $contractDateEnd = date('Y-m-d H:i:s', strtotime($deliveryDate.' +'.$order_return->order_return_max_days.' days'));
        // dd($todayDate);
        if ($todayDate <= $contractDateEnd)
        {
          $return_status = true;
        }
      }


      return $return_status;
    }
}

if (!function_exists('order_cancel_days_status'))
{
    function order_cancel_days_status($orders)
    {
      $cancel_status = false;

      // if ($orders->delivered_stage == 1 && $orders->delivered_date != '')
      // {
        $order_cancel = OrderCancelManagement::first();

        // $Date1 = '2010-09-17';
        $todayDate = date('Y-m-d H:i:s');
        $tdate = new DateTime($todayDate);
        // $tdate->add(new DateInterval('P1D')); // P1D means a period of 1 day
        $todayDate = $tdate->format('Y-m-d H:i:s');

        // $todayDate = date('Y-m-d h:i:s', strtotime($todayDate));

        $deliveryDate = $orders->created_at;
        $ddate = new DateTime($deliveryDate);
        // $ddate->add(new DateInterval('P1D')); // P1D means a period of 1 day
        $deliveryDate = $ddate->format('Y-m-d H:i:s');
        // $deliveryDate = date('Y-m-d h:i:s', strtotime($deliveryDate));

        $cdate = new DateTime($deliveryDate);
        $cdateincd = 'P'.$order_cancel->order_cancel_max_days.'D';
        $cdateinch = 'PT'.$order_cancel->order_cancel_max_hours.'H';
        // $cdate->add(new DateInterval($cdateincd)); // P1D means a period of 1 day
        $cdate->add(new DateInterval($cdateinch)); // P1D means a period of 1 day
        $contractDateEnd = $cdate->format('Y-m-d H:i:s');
        // $contractDateEnd = date('Y-m-d h:i:s', strtotime('+'.$order_cancel->order_cancel_max_days.' days +'.$order_cancel->order_cancel_max_hours.' hours',strtotime($deliveryDate)));
        // dd($cdateinch.' '.$todayDate.' '.$contractDateEnd.' '.$deliveryDate);
        if ($todayDate <= $contractDateEnd)
        {
          $cancel_status = true;
        }
      // }


      return $cancel_status;
    }
}

if (!function_exists('warehouse_creation'))
{
  // $md(string) : modeBilling mode of shipment(E: Express/ S: Surface)(mandatory)
  // $cgm(int32) : Weight of shipment in grams(Mandatory)
  // $o_pin(int32) : Origin center's Pin Code (optional)
  // $d_pin(int32) : Pin code of destination city (optional)
  // $ss(string) : Status of shipment Delivered,RTO,DTO(Mandatory)

  function warehouse_creation()
  {
    $accesstoken = 'c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49';//'ec1ee821dc6ca3355a018d48828d3e2ccb892de7';
    // $url = "https://staging-express.delhivery.com/api/backend/clientwarehouse/create/";//staging
    $url = "https://track.delhivery.com/api/backend/clientwarehouse/create/";//live

    $postRequest=  '{
                    "phone": "7498042995",
                    "city": "Greater Thane",
                    "name": "DILIPKUMAR PARWANI",
                    "pin": "421004",
                    "address": "HARNAM APARTMENT 403, 4TH FLOOR, SECTION 30, ULHASNAGAR, 421004 , Ulhasnagar, Maharashtra ,India 421004",
                    "country": "India",
                    "email": "grparwanitradingco@gmail.com",
                    "registered_name": "GR0068088",
                     "return_address": "HARNAM APARTMENT 403, 4TH FLOOR, SECTION 30, ULHASNAGAR, 421004 , Ulhasnagar, Maharashtra ,India 421004",
                     "return_pin":"421004",
                     "return_city":"Greater Thane",
                     "return_state":"Maharashtra",
                     "return_country": "India"
                  }';
    // $postRequest = json_encode($postRequest);
    $curl = curl_init();

    $headr = array();
    $headr[] = 'Access: 0';
    $headr[] = 'Content-type: application/json';
    $headr[] = 'Authorization: Token '.$accesstoken;

    curl_setopt($curl, CURLOPT_HTTPHEADER,$headr);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, ''.$postRequest);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);

    return $data;

  }
}

if (!function_exists('get_state'))
{
    function get_state($state_code)
    {
      $state = "";
      if(isset($state_code) && $state_code!='')
      {
        $state = StateCodes::where('state_code',$state_code)->first();
      }
      return $state;
    }
}

if (!function_exists('create_bulk_waybill'))
{
    function create_bulk_waybill($count)
    {
      $accesstoken = 'c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49';//'ec1ee821dc6ca3355a018d48828d3e2ccb892de7';//c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49
      $cl = 'GR0068088SURFACE-B2C';
    //   $url = "https://staging-express.delhivery.com/waybill/api/bulk/json/?token=".$accesstoken."&cl=".$cl."&count=".$count;//staging
      $url = "https://track.delhivery.com/waybill/api/bulk/json/?token=".$accesstoken."&cl=".$cl."&count=".$count;//live
      $curl = curl_init();

      $headr = array();
      $headr[] = 'Access: 0';
      $headr[] = 'Content-type: application/json';
      $headr[] = 'Authorization: Token '.$accesstoken;

      curl_setopt($curl, CURLOPT_HTTPHEADER,$headr);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      $data = curl_exec($curl);
      curl_close($curl);
      // dd($data);
      return $data;
    }
}

if (!function_exists('track_order'))
{
    function track_order($waybill)
    {
      $accesstoken = 'c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49';//'ec1ee821dc6ca3355a018d48828d3e2ccb892de7';//c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49
      $cl = 'GR0068088SURFACE-B2C';
      //$url = "https://staging-express.delhivery.com/api/v1/packages/json/?token=".$accesstoken."&waybill=".$waybill;//staging
      $url = "https://track.delhivery.com/api/v1/packages/json/?token=".$accesstoken."&waybill=".$waybill;//live
      $curl = curl_init();

      $headr = array();
      $headr[] = 'Access: 0';
      $headr[] = 'Content-type: application/json';
      $headr[] = 'Authorization: Token '.$accesstoken;

      curl_setopt($curl, CURLOPT_HTTPHEADER,$headr);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      $data = curl_exec($curl);
      curl_close($curl);
      // dd($data);
      return $data;
    }
}

if (!function_exists('packing_slip'))
{
    function packing_slip($waybill)
    {
        // $waybill = "8863210000022";
      $accesstoken = 'c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49';//'ec1ee821dc6ca3355a018d48828d3e2ccb892de7';//c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49
      $cl = 'GR0068088SURFACE-B2C';
    //   $url = "https://staging-express.delhivery.com/api/p/packing_slip?token=".$accesstoken."&wbns=".$waybill;//staging
      $url = "https://track.delhivery.com/api/p/packing_slip?token=".$accesstoken."&wbns=".$waybill;//live
      $curl = curl_init();

      $headr = array();
      $headr[] = 'Access: 0';
      $headr[] = 'Content-type: application/json';
      $headr[] = 'Authorization: Token '.$accesstoken;

      curl_setopt($curl, CURLOPT_HTTPHEADER,$headr);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      $data = curl_exec($curl);
      curl_close($curl);
    //   dd($data);
      return $data;
    }
}

if (!function_exists('get_cart_product_weight'))
{
    function get_cart_product_weight()
    {
      $cart_total = new stdClass();
      if(isset(auth()->user()->id))
      {
        $user_id = auth()->user()->id;
        if($user_id)
        {
          // $cart_total = Cart::where('user_id',$user_id)->with(['products'])->select(DB::raw('sum(products.product_discounted_price*cart.qty) as cart_total'))->first();
          // $cart_total = Cart::where('user_id',$user_id)->join('products', 'products.product_id', '=', 'cart.product_id')->select(DB::raw('sum(products.product_weight*cart.qty) as cart_total_product_weight'))->first();
          $cart = Cart::where('user_id',$user_id)->with(['products','product_variant'])->get();
          $product_wt = 0;
          foreach ($cart as $item)
          {
            $join_table = 'products';
            if($item->product_type=="configurable")
            {
              $join_table = 'product_variant';
            }
            $product_wt = $product_wt+($item->{$join_table}->product_weight*$item->qty);
          }
          // dd($product_wt);
          $cart_total->cart_total_product_weight = $product_wt;
          $cart_total = ($cart_total->cart_total_product_weight)?$cart_total->cart_total_product_weight:0;
        }
      }
      else
      {
        if(session('cart') != NULL)
        {
          $cart = new Collection();
          foreach(session('cart') as $item){
            $product_id[] = $item['product_id'];
            $cart_details = new Cart();
            $cart_details->fill($item);
            $cart_details->qty = $item['quantity'];
            $cart->push($cart_details);
          }

          $product_wt = 0;
          foreach ($cart as $item)
          {
            $join_table = 'products';
            if($item->product_type=="configurable")
            {
              $join_table = 'product_variant';
            }
            $product_wt = $product_wt+($item->{$join_table}->product_weight*$item->qty);
          }
          // dd($product_wt);
          $cart_total->cart_total_product_weight = $product_wt;
          $cart_total = ($cart_total->cart_total_product_weight)?$cart_total->cart_total_product_weight:0;
        }
      }
      // dd($cart_total);
      return $cart_total;
    }
}


if (!function_exists('order_cancellation'))
{

  function order_cancellation($waybill)
  {
    $accesstoken = 'c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49';//'ec1ee821dc6ca3355a018d48828d3e2ccb892de7';
    // $url = "https://staging-express.delhivery.com/api/p/edit";//staging
    $url = "https://track.delhivery.com/api/p/edit";//live

    $postRequest=  '{"cancellation": "true",
                    "waybill": "'.$waybill.'"
                  }';
    // $postRequest = json_encode($postRequest);

    // "waybill": "'.$bulk_waybills.'",
    $curl = curl_init();

    $headr = array();
    $headr[] = 'Access: 0';
    $headr[] = 'Content-type: application/json';
    $headr[] = 'Authorization: Token '.$accesstoken;

    curl_setopt($curl, CURLOPT_HTTPHEADER,$headr);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, ''.$postRequest);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);

    return $data;

  }
}

//mahesh 09-02-2022 
//for setting status wise color for orders
if (!function_exists('order_status_color'))
{
    function order_status_color($orders)
    {
      $status_color = "order-status-color-default";
      if($orders->order_return_flag == 1 && $orders->order_return_status == 1)
      {
        $status_color = "order-status-color-return";
      }
      else if($orders->order_return_flag == 1 && $orders->order_return_status == 0 && $orders->order_return_status != NULL)
      {
        $status_color = "order-status-color-return";
      }
      if ($orders->order_return_flag == 1)
      {
        $status_color = "order-status-color-return";
      }
      else
      {
        if ($orders->cancel_order_flag == 1)
        {
          $status_color = "order-status-color-cancellation";
        }
        else
        {
          if ($orders->confirmed_stage == 1)
          {
            $status_color = "order-status-color-confirmed";
          }
          if ($orders->preparing_order_stage == 1)
          {
            $status_color = "order-status-color-preparing";
          }
          if ($orders->shipped_stage == 1)
          {
            $status_color = "order-status-color-shipped";
          }
          if ($orders->out_for_delivery_stage == 1)
          {
            $status_color = "order-status-color-out-of-delivery";
          }
          if ($orders->delivered_stage == 1)
          {
            $status_color = "order-status-color-delivery";
          }
        }
      }

      return $status_color;
    }
}

if (!function_exists('get_sender_id'))
{
    function get_sender_id()
    {
      $api_key = 'dFj1uhayNYO2HeeWXLOalL2iW193a3PMd1SqzNoDvdk=';
      $client_id = '7a7bb9c4-3e0c-4f1a-990e-16f5046510e6';
      $url = " https://smppapi.theitmatic.com/api/v2/SenderId?ApiKey=".$api_key."&ClientId=".$client_id;//live
      $curl = curl_init();
      $headr = array();
      $headr[] = 'Access: 0';
      $headr[] = 'Content-type: application/json';
      $headr[] = 'Type: json';
      curl_setopt($curl, CURLOPT_HTTPHEADER,$headr);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      $data = curl_exec($curl);
      curl_close($curl);
    //   dd($data);
      return $data;
    }
}
if (!function_exists('send_sms'))
{
  function send_sms($mobile_no, $message)
  {
    $api_key = 'dFj1uhayNYO2HeeWXLOalL2iW193a3PMd1SqzNoDvdk=';
    $client_id = '7a7bb9c4-3e0c-4f1a-990e-16f5046510e6';
    // $sender_id_response = json_decode(get_sender_id(),true);
    // if($sender_id_response['ErrorCode'] == 0)
    // {
    //   $sender_id = $sender_id_response['Data']['Sender-Id'];
    // }
    // else
    // {
    //   return false;
    // }
    $sender_id = "DADREE";
    if(isset($sender_id) && $sender_id != "")
    {
      $url = "https://smppapi.theitmatic.com/api/v2/SendSMS";//live
      $postRequest=  '{
                        "SenderId": "'.$sender_id.'",
                        "Message": "'.$message.'",
                        "MobileNumbers": "'.$mobile_no.'",
                        "ApiKey": "'.$api_key.'",
                        "ClientId": "'.$client_id.'"
                      }';
      $curl = curl_init();
      $headr = array();
      // $headr[] = 'Access: 0';
      $headr[] = 'Content-type: application/json';
      // $headr[] = 'Type: json';
      curl_setopt($curl, CURLOPT_HTTPHEADER,$headr);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $postRequest);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      $data = curl_exec($curl);
      curl_close($curl);
      // dd($data);
      return $data;
    }
    return false;
  }
}

?>
