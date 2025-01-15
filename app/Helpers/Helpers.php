<?php
use App\Models\backend\Gst;
use App\Models\frontend\Cart;
use App\Models\frontend\Orders;
// use App\Models\frontend\Orders;
use App\Models\frontend\CartCoupons;
use App\Models\backend\OrderReturnManagement;
use App\Models\backend\OrderCancelManagement;
use App\Models\backend\StateCodes;
use App\Models\frontend\ShippingAddresses;
use Illuminate\Database\Eloquent\Collection;

if (!function_exists('get_shipping_charges')) {
  // $md(string) : modeBilling mode of shipment(E: Express/ S: Surface)(mandatory)
  // $cgm(int32) : Weight of shipment in grams(Mandatory)
  // $o_pin(int32) : Origin center's Pin Code (optional)
  // $d_pin(int32) : Pin code of destination city (optional)
  // $ss(string) : Status of shipment Delivered,RTO,DTO(Mandatory)

  function get_shipping_charges($md, $cgm, $o_pin, $ss, $d_pin)
  {
    // dd($cgm);
    $accesstoken = 'c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49';
    // $url = "https://track.delhivery.com/api/kinko/v1/invoice/charges/.json?md=".$md."&cgm=".$cgm."&=".$o_pin."&ss=".$ss."&d_pin=".$d_pin;//staging
    $url = "https://track.delhivery.com/api/kinko/v1/invoice/charges/.json?md=" . $md . "&cgm=" . $cgm . "&=" . $o_pin . "&ss=" . $ss . "&d_pin=" . $d_pin;//live
    $curl = curl_init();

    $headr = array();
    $headr[] = 'Access: 0';
    $headr[] = 'Content-type: application/json';
    $headr[] = 'Authorization: Token ' . $accesstoken;

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);
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
if (!function_exists('get_cart_total')) {
  function get_cart_total()
  {
    $cart_total = new stdClass();
    $total = 0;
    $mrp_total = 0;
    if (isset(auth()->user()->id)) {
      $user_id = auth()->user()->id;
      if ($user_id) {
        // $cart_total = Cart::where('user_id',$user_id)->with(['products'])->select(DB::raw('sum(products.product_discounted_price*cart.qty) as cart_total'))->first();
        // $cart_total = Cart::where('user_id',$user_id)->join('products', 'products.product_id', '=', 'cart.product_id')->select(DB::raw('sum(products.product_discounted_price*cart.qty) as cart_total'))->first();
        $cart = Cart::where('user_id', $user_id)->with(['products', 'product_variant'])->get();
        foreach ($cart as $item) {
          $join_table = 'products';
          if ($item->product_type == "configurable") {
            $join_table = 'product_variant';
          }
          $total += $item->{$join_table}->product_discounted_price * $item->qty;
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

if (!function_exists('get_cart_mrp_total')) {
  function get_cart_mrp_total()
  {
    $cart_total = new stdClass();
    // $cart_total;
    $total = 0;
    if (isset(auth()->user()->id)) {
      $user_id = auth()->user()->id;
      if ($user_id) {
        // $cart_total = Cart::where('user_id',$user_id)->with(['products'])->select(DB::raw('sum(products.product_discounted_price*cart.qty) as cart_total'))->first();
        // $cart_total = Cart::where('user_id',$user_id)->join('products', 'products.product_id', '=', 'cart.product_id')->select(DB::raw('sum(products.product_price*cart.qty) as cart_total'))->first();
        $cart = Cart::where('user_id', $user_id)->with(['products', 'product_variant'])->get();
        foreach ($cart as $item) {
          $join_table = 'products';
          if ($item->product_type == "configurable") {
            $join_table = 'product_variant';
          }
          if ($item->{$join_table}->product_discounted_price != null && $item->{$join_table}->product_discount != 0) {
            $total += $item->{$join_table}->product_price * $item->qty;
          } elseif ($item->{$join_table}->product_discounted_price != null && $item->{$join_table}->product_discount == 0) {
            $total += $item->{$join_table}->product_discounted_price * $item->qty;
          } else {
            $total += $item->{$join_table}->product_price * $item->qty;
          }
        }
      }
    } else {
      if (session('cart') != null) {
        $cart = new Collection();
        foreach (session('cart') as $item) {
          $product_id[] = $item['product_id'];
          $cart_details = new Cart();
          $cart_details->fill($item);
          $cart_details->qty = $item['quantity'];
          $cart->push($cart_details);
        }
        foreach ($cart as $item) {
          $join_table = 'products';
          if ($item->product_type == "configurable") {
            $join_table = 'product_variant';
          }
          if ($item->{$join_table}->product_discounted_price != null && $item->{$join_table}->product_discount != 0) {
            $total += $item->{$join_table}->product_price * $item->qty;
          } elseif ($item->{$join_table}->product_discounted_price != null && $item->{$join_table}->product_discount == 0) {
            $total += $item->{$join_table}->product_discounted_price * $item->qty;
          } else {
            $total += $item->{$join_table}->product_price * $item->qty;
          }
        }
      }
    }
    $cart_total->cart_total = $total;
    return $cart_total;
  }
}

if (!function_exists('get_coupon_usage_count')) {
  function get_coupon_usage_count($coupon_code)
  {
    $coupon_count = 0;
    if (isset(auth()->user()->id)) {
      $user_id = auth()->user()->id;
      if ($user_id) {
        $coupon_count = Orders::where('user_id', $user_id)->where('coupon_code', $coupon_code)->count();
      }
    }

    return $coupon_count;
  }
}

if (!function_exists('verify_pincode')) {
  function verify_pincode($pincode)
  {
    $accesstoken = 'c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49';//'ec1ee821dc6ca3355a018d48828d3e2ccb892de7';//c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49
    //   $url = "https://staging-express.delhivery.com/c/api/pin-codes/json/?token=".$accesstoken."&filter_codes=".$pincode;//staging
    $url = "https://track.delhivery.com/c/api/pin-codes/json/?token=" . $accesstoken . "&filter_codes=" . $pincode;//live
    $curl = curl_init();

    $headr = array();
    $headr[] = 'Access: 0';
    $headr[] = 'Content-type: application/json';
    $headr[] = 'Authorization: Token ' . $accesstoken;

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    // dd($data);
    return $data;
  }
}

if (!function_exists('check_pincode')) {
  // $md(string) : modeBilling mode of shipment(E: Express/ S: Surface)(mandatory)
  // $cgm(int32) : Weight of shipment in grams(Mandatory)
  // $o_pin(int32) : Origin center's Pin Code (optional)
  // $d_pin(int32) : Pin code of destination city (optional)
  // $ss(string) : Status of shipment Delivered,RTO,DTO(Mandatory)
  function check_pincode($pincode)
  {
    // Shiprocket credentials from .env
    $email = env('SHIPROCKET_EMAIL');
    $password = env('SHIPROCKET_PASSWORD');

    // Shiprocket API endpoints
    $authUrl = 'https://apiv2.shiprocket.in/v1/external/auth/login';
    $checkServiceabilityUrl = 'https://apiv2.shiprocket.in/v1/external/courier/serviceability/';
    $pickupUrl = 'https://apiv2.shiprocket.in/v1/external/settings/company/pickup';

    // Step 1: Authenticate and get access token
    $authPayload = [
      'email' => $email,
      'password' => $password,
    ];

    $authResponse = makeCurlRequest($authUrl, $authPayload);

    if (!isset($authResponse['token'])) {
      throw new Exception('Authentication failed: ' . json_encode($authResponse));
    }

    $accessToken = $authResponse['token'];



    // Step 2: Prepare order data

    $payload = [
      "delivery_postcode" => (int) $pincode,
      "weight" => 0.5,
      "cod" => 0
    ];

    $pickup_pincode = json_decode(makeCurlGetRequest($pickupUrl, $payload, $accessToken))->data->shipping_address[0]->pin_code;

    $servicePayload = [
      "pickup_postcode" => (int) $pickup_pincode,
      "delivery_postcode" => (int) $pincode,
      "weight" => 0.5,
      "cod" => 0
    ];

    $pincodeServiceResponse = makeCurlGetRequest($checkServiceabilityUrl, $servicePayload, $accessToken);

    return $pincodeServiceResponse;
  }

  function makeCurlGetRequest($url, $payload, $accessToken)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_POSTFIELDS => json_encode($payload),
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
  }
}

if (!function_exists('order_creation')) {
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

    if (!isset($authResponse['token'])) {
      throw new Exception('Authentication failed: ' . json_encode($authResponse));
    }

    $accessToken = $authResponse['token'];

    // Step 2: Prepare order data
    $billingAddress = "{$current_order->shipping_address_line1}, {$current_order->shipping_address_line2}, {$current_order->shipping_landmark}";
    $shippingAddress = $current_order->shipping_is_billing ? $billingAddress : "{$current_order->shipping_address_line1}, {$current_order->shipping_address_line2}";
    $items = [];

    foreach ($current_order->orderproducts as $item) {
      $items[] = [
        "name" => $item->product_title,
        "sku" => $item->products->product_sku,
        "units" => $item->qty,
        "selling_price" => $item->product_discounted_price,
        "discount" => 0,
        "tax" => 0,
        "hsn" => (int) $item->products->hsncode->hsncode_name,
      ];
    }

    $orderPayload = [
      "order_id" => $current_order->order_id,
      "order_date" => $current_order->created_at->format('Y-m-d H:i'),
      "pickup_location" => "work",
      "channel_id" => "",
      "comment" => "Order from {$current_order->source}",
      "billing_customer_name" => $current_order->customer_name,
      "billing_last_name" => "",
      "billing_address" => $billingAddress,
      "billing_address_2" => "",
      "billing_city" => $current_order->shipping_city,
      "billing_pincode" => $current_order->shipping_pincode,
      "billing_state" => $current_order->shipping_state,
      "billing_country" => 'India',
      "billing_email" => $current_order->shipping_email,
      "billing_phone" => $current_order->shipping_mobile_no,
      "shipping_is_billing" => true,
      "order_items" => $items,
      "payment_method" => $current_order->payment_mode === 'cod' ? "COD" : "Prepaid",
      "shipping_charges" => $current_order->shipping_charges,
      "giftwrap_charges" => 0,
      "transaction_charges" => 0,
      "total_discount" => 0,
      "sub_total" => $current_order->total,
      "length" => 10,
      "breadth" => 15,
      "height" => 20,
      "weight" => 2.5,
    ];

    // Step 3: Create the order
    $orderResponse = makeCurlRequest($createOrderUrl, $orderPayload, $accessToken);

    return json_encode($orderResponse);
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
      CURLOPT_SSL_VERIFYPEER => false,
    ]);

    $response = curl_exec($curl);
    info($response);
    if (curl_errno($curl)) {
      throw new Exception('Curl error: ' . curl_error($curl));
    }

    curl_close($curl);

    return json_decode($response, true);
  }

  // function order_creation($current_order)
  // {
  //   // Shiprocket credentials from .env
  //   $email = env('SHIPROCKET_EMAIL');
  //   $password = env('SHIPROCKET_PASSWORD');

  //   // Shiprocket API endpoints
  //   $authUrl = 'https://apiv2.shiprocket.in/v1/external/auth/login';
  //   $createOrderUrl = 'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc';

  //   // Step 1: Authenticate and get access token
  //   $authPayload = [
  //     'email' => $email,
  //     'password' => $password,
  //   ];


  //   $authResponse = makeCurlRequest($authUrl, $authPayload);

  //   if (isset($authResponse['token'])) {
  //     $accessToken = $authResponse['token'];

  //   } else {
  //     throw new Exception('Authentication with Shiprocket failed: ' . json_encode($authResponse));
  //   }


  //   // Step 3: Create the order
  //   $orderResponse = makeCurlRequest2($createOrderUrl, $accessToken);
  //   return $orderResponse;
  // }

  // function makeCurlRequest($url, $payload, $accessToken = null)
  // {
  //   $curl = curl_init();

  //   $headers = [
  //     'Content-Type: application/json',
  //   ];

  //   if ($accessToken) {
  //     $headers[] = 'Authorization: Bearer ' . $accessToken;
  //   }

  //   curl_setopt_array($curl, [
  //     CURLOPT_URL => $url,
  //     CURLOPT_POST => true,
  //     CURLOPT_RETURNTRANSFER => true,
  //     CURLOPT_HTTPHEADER => $headers,
  //     CURLOPT_POSTFIELDS => json_encode($payload),
  //     CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification
  //   ]);

  //   $response = curl_exec($curl);

  //   if (curl_errno($curl)) {
  //     throw new Exception('Curl error: ' . curl_error($curl));
  //   }

  //   curl_close($curl);

  //   return json_decode($response, true);
  // }

  // function makeCurlRequest2($url, $accessToken = null)
  // {
  //   $curl = curl_init();

  //   curl_setopt_array($curl, array(
  //     CURLOPT_SSL_VERIFYPEER => false,
  //     CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc',
  //     CURLOPT_RETURNTRANSFER => true,
  //     CURLOPT_ENCODING => '',
  //     CURLOPT_MAXREDIRS => 10,
  //     CURLOPT_TIMEOUT => 0,
  //     CURLOPT_FOLLOWLOCATION => true,
  //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  //     CURLOPT_CUSTOMREQUEST => 'POST',
  //     CURLOPT_POSTFIELDS => '{
  //   "order_id": "224-447",
  //   "order_date": "2024-07-24 11:11",
  //   "pickup_location": "work",
  //   "channel_id": "",
  //   "comment": "Reseller: M/s Goku",
  //   "billing_customer_name": "Naruto",
  //   "billing_last_name": "Uzumaki",
  //   "billing_address": "House 221B, Leaf Village",
  //   "billing_address_2": "Near Hokage House",
  //   "billing_city": "New Delhi",
  //   "billing_pincode": "110002",
  //   "billing_state": "Delhi",
  //   "billing_country": "India",
  //   "billing_email": "naruto@uzumaki.com",
  //   "billing_phone": "9876543210",
  //   "shipping_is_billing": true,
  //   "shipping_customer_name": "",
  //   "shipping_last_name": "",
  //   "shipping_address": "",
  //   "shipping_address_2": "",
  //   "shipping_city": "",
  //   "shipping_pincode": "",
  //   "shipping_country": "",
  //   "shipping_state": "",
  //   "shipping_email": "",
  //   "shipping_phone": "",
  //   "order_items": [
  //     {
  //       "name": "Kunai",
  //       "sku": "chakra123",
  //       "units": 10,
  //       "selling_price": "900",
  //       "discount": "",
  //       "tax": "",
  //       "hsn": 441122
  //     }
  //   ],
  //   "payment_method": "Prepaid",
  //   "shipping_charges": 0,
  //   "giftwrap_charges": 0,
  //   "transaction_charges": 0,
  //   "total_discount": 0,
  //   "sub_total": 9000,
  //   "length": 10,
  //   "breadth": 15,
  //   "height": 20,
  //   "weight": 2.5
  // }',
  //     CURLOPT_HTTPHEADER => array(
  //       'Content-Type: application/json',
  //       'Authorization: Bearer '. $accessToken 
  //     )
  //   ));

  //   $response = curl_exec($curl);

  //   if (curl_errno($curl)) {
  //     throw new Exception('Curl error: ' . curl_error($curl));
  //   }

  //   curl_close($curl);

  //   return json_decode($response, true);
  // }
}


//cart total with all prices
if (!function_exists('get_cart_amounts')) {
  function get_cart_amounts()
  {
    $cart_total = new stdClass();
    $cart_mrp_total = 0;
    $cart_discounted_total = 0;
    $total_gst = 0;
    $coupon_discount = 0;
    $total_discount = 0;

    // Get GST rates

    $gstMode = 'sgst';
    $userState = ShippingAddresses::where('user_id', auth()->user()->id)->where('default_address_flag', 1)->first();

    if (get_pickup_address()->state !== $userState->shipping_state) {
      $gstMode = 'igst';
    }

    // GST rates
    // IGST rate

    if (isset(auth()->user()->id)) {
      $user_id = auth()->user()->id;
      if ($user_id) {
        $cart = Cart::where('user_id', $user_id)->with(['products', 'product_variant'])->get();

        foreach ($cart as $item) {
          $gst = Gst::where('gst_id', $item->products->gst_id)->first();
          $gstSgstRate = $gst->gst_sgst_percent; // SGST rate
          $gstCgstRate = $gst->gst_cgst_percent; // CGST rate
          $gstIgstRate = $gst->gst_igst_percent;
          $join_table = 'products';
          if ($item->product_type == "configurable") {
            $join_table = 'product_variant';
          }

          $product_price = $item->{$join_table}->product_discounted_price ?? $item->{$join_table}->product_price;

          // Calculate MRP and discounted total
          $cart_mrp_total += $item->{$join_table}->product_price * $item->qty;
          $cart_discounted_total += $product_price * $item->qty;

          // Calculate GST based on gstMode
          if ($gstMode === 'sgst') {
            $sgst = ($product_price * $item->qty * $gstSgstRate) / 100;
            $cgst = ($product_price * $item->qty * $gstCgstRate) / 100;
            $total_gst += $sgst + $cgst;
          } else if ($gstMode === 'igst') {
            $igst = ($product_price * $item->qty * $gstIgstRate) / 100;
            $total_gst += $igst;
          }
        }

        $cart_total->cart_mrp_total = $cart_mrp_total;
        $cart_total->cart_discounted_total = $cart_discounted_total + $total_gst; // Add GST to discounted total
      }

      if ($cart_total) {
        // Total discount
        $total_discount = $cart_total->cart_mrp_total - $cart_total->cart_discounted_total;

        // Coupon discount
        $cart_coupon = CartCoupons::where('user_id', $user_id)->with('coupon')->first();
        if (isset($cart_coupon->coupon)) {
          $paymentDate = date('Y-m-d');
          $contractDateBegin = date('Y-m-d', strtotime($cart_coupon->coupon->start_date));
          $contractDateEnd = date('Y-m-d', strtotime($cart_coupon->coupon->end_date));

          if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd)) {
            if ($cart_coupon->coupon->coupon_type == 'flat') {
              $coupon_discount = $cart_coupon->coupon->value;
            } else {
              $coupon_value = $cart_coupon->coupon->value;
              $coupon_discount = ($cart_total->cart_discounted_total * $coupon_value) / 100;
            }
          }
        }
      }
    } else {
      if (session('cart') != null) {
        $cart = new Collection();
        foreach (session('cart') as $item) {
          $product_id[] = $item['product_id'];
          $cart_details = new Cart();
          $cart_details->fill($item);
          $cart_details->qty = $item['quantity'];
          $cart->push($cart_details);
        }

        foreach ($cart as $item) {
          $gst = Gst::where('gst_id', $item->products->gst_id)->first();
          $gstSgstRate = $gst->gst_sgst_percent; // SGST rate
          $gstCgstRate = $gst->gst_cgst_percent; // CGST rate
          $gstIgstRate = $gst->gst_igst_percent;
          $join_table = 'products';
          if ($item->product_type == "configurable") {
            $join_table = 'product_variant';
          }

          $product_price = $item->{$join_table}->product_discounted_price ?? $item->{$join_table}->product_price;

          // Calculate MRP and discounted total
          $cart_mrp_total += $item->{$join_table}->product_price * $item->qty;
          $cart_discounted_total += $product_price * $item->qty;

          // Calculate GST based on gstMode
          if ($gstMode === 'sgst') {
            $sgst = ($product_price * $item->qty * $gstSgstRate) / 100;
            $cgst = ($product_price * $item->qty * $gstCgstRate) / 100;
            $total_gst += $sgst + $cgst;
          } else if ($gstMode === 'igst') {
            $igst = ($product_price * $item->qty * $gstIgstRate) / 100;
            $total_gst += $igst;
          }
        }

        $cart_total->cart_mrp_total = $cart_mrp_total;
        $cart_total->cart_discounted_total = $cart_discounted_total + $total_gst; // Add GST to discounted total
      }

      if ($cart_total) {
        // Total discount
        $total_discount = $cart_total->cart_mrp_total - $cart_total->cart_discounted_total;
      }
    }

    $product_discounted_price = $cart_total->cart_mrp_total - ($cart_total->cart_discounted_total - $total_gst);

    return (object) [
      'cart' => $cart_total,
      'product_discount' => $product_discounted_price,
      'total_discount' => $total_discount,
      'coupon_discount' => $coupon_discount,
      'total_gst' => $total_gst, // Return total GST as well
    ];
  }


}

if (!function_exists('generate_awb')) {
  function generate_awb($pincode, $shipment_id)
  {

    $authUrl = 'https://apiv2.shiprocket.in/v1/external/auth/login';
    $email = env('SHIPROCKET_EMAIL');
    $password = env('SHIPROCKET_PASSWORD');
    $authPayload = [
      'email' => $email,
      'password' => $password,
    ];
    $authResponse = makeCurlRequest($authUrl, $authPayload);
    $accessToken = $authResponse['token'];
    $courier_id = json_decode(check_pincode($pincode))->data->recommended_courier_company_id;

    $curl = curl_init();

    $awbParams = [
      "shipment_id" => $shipment_id,
      "courier_id" => $courier_id,
    ];

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/assign/awb?shipment_id='.$shipment_id. '&courier_id='. $courier_id,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return json_decode($response);
  }
}

if (!function_exists('place_shippment')) {
  function place_shipment($shipment_id)
  {
    $authUrl = 'https://apiv2.shiprocket.in/v1/external/auth/login';
    $email = env('SHIPROCKET_EMAIL');
    $password = env('SHIPROCKET_PASSWORD');
    $authPayload = [
      'email' => $email,
      'password' => $password,
    ];
    $authResponse = makeCurlRequest($authUrl, $authPayload);
    $accessToken = $authResponse['token'];
    $curl = curl_init();
    $awbParams = [
      "shipment_id" => $shipment_id,
    ];
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/generate/pickup?shipment_id=' . $shipment_id,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_POSTFIELDS => $awbParams,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
      ),
    ));

    $response = curl_exec($curl);


    curl_close($curl);

    return json_decode($response);
  }
}

if (!function_exists('get_pickup_address')) {

  function get_pickup_address()
  {
    $authUrl = 'https://apiv2.shiprocket.in/v1/external/auth/login';
    $email = env('SHIPROCKET_EMAIL');
    $password = env('SHIPROCKET_PASSWORD');
    $pickupUrl = 'https://apiv2.shiprocket.in/v1/external/settings/company/pickup';

    // Step 1: Authenticate and get access token
    $authPayload = [
      'email' => $email,
      'password' => $password,
    ];

    $authResponse = makeCurlRequest($authUrl, $authPayload);

    if (!isset($authResponse['token'])) {
      throw new Exception('Authentication failed: ' . json_encode($authResponse));
    }

    $accessToken = $authResponse['token'];



    // Step 2: Prepare order data

    $payload = [];

    $pickup_address = json_decode(makeCurlGetRequest($pickupUrl, $payload, $accessToken))->data->shipping_address[0];

    return $pickup_address;
  }


}

if (!function_exists('order_status')) {
  function order_status($orders)
  {
    $progress = "PROCESSING";
    if ($orders->order_return_flag == 1 && $orders->order_return_status == 1) {
      $progress = "RETURNED & REFUNDED";
    } else if ($orders->order_return_flag == 1 && $orders->order_return_status == 0 && $orders->order_return_status != NULL) {
      // dd($orders);
      $progress = "RETURNED";
    } else if ($orders->order_return_flag == 1) {
      $progress = "RETURNING";
    } else {
      if ($orders->cancel_order_flag == 1) {
        $progress = "CANCELLED";
      } else {
        if ($orders->confirmed_stage == 1) {
          $progress = "CONFIRMED";
        }
        if ($orders->preparing_order_stage == 1) {
          $progress = "PREPARING YOUR ORDER";
        }
        if ($orders->shipped_stage == 1) {
          $progress = "SHIPPED";
        }
        if ($orders->out_for_delivery_stage == 1) {
          $progress = "OUT FOR DELIVERY";
        }
        if ($orders->delivered_stage == 1) {
          $progress = "DELIVERED";
        }
      }
    }

    return $progress;
  }
}

if (!function_exists('order_return_days_status')) {
  function order_return_days_status($orders)
  {
    $return_status = false;

    if ($orders->delivered_stage == 1 && $orders->delivered_date != '') {
      $order_return = OrderReturnManagement::first();

      $todayDate = date('Y-m-d H:i:s');
      $todayDate = date('Y-m-d H:i:s', strtotime($todayDate));

      $deliveryDate = $orders->delivered_date;
      $deliveryDate = date('Y-m-d H:i:s', strtotime($deliveryDate));

      $contractDateEnd = date('Y-m-d H:i:s', strtotime($deliveryDate . ' +' . $order_return->order_return_max_days . ' days'));
      // dd($todayDate);
      if ($todayDate <= $contractDateEnd) {
        $return_status = true;
      }
    }


    return $return_status;
  }
}

if (!function_exists('order_cancel_days_status')) {
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
    $cdateincd = 'P' . $order_cancel->order_cancel_max_days . 'D';
    $cdateinch = 'PT' . $order_cancel->order_cancel_max_hours . 'H';
    // $cdate->add(new DateInterval($cdateincd)); // P1D means a period of 1 day
    $cdate->add(new DateInterval($cdateinch)); // P1D means a period of 1 day
    $contractDateEnd = $cdate->format('Y-m-d H:i:s');
    // $contractDateEnd = date('Y-m-d h:i:s', strtotime('+'.$order_cancel->order_cancel_max_days.' days +'.$order_cancel->order_cancel_max_hours.' hours',strtotime($deliveryDate)));
    // dd($cdateinch.' '.$todayDate.' '.$contractDateEnd.' '.$deliveryDate);
    if ($todayDate <= $contractDateEnd) {
      $cancel_status = true;
    }
    // }


    return $cancel_status;
  }
}

if (!function_exists('warehouse_creation')) {
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

    $postRequest = '{
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
    $headr[] = 'Authorization: Token ' . $accesstoken;

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, '' . $postRequest);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);

    return $data;

  }
}

if (!function_exists('get_state')) {
  function get_state($state_code)
  {
    $state = "";
    if (isset($state_code) && $state_code != '') {
      $state = StateCodes::where('state_code', $state_code)->first();
    }
    return $state;
  }
}

if (!function_exists('create_bulk_waybill')) {
  function create_bulk_waybill($count)
  {
    $accesstoken = 'c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49';//'ec1ee821dc6ca3355a018d48828d3e2ccb892de7';//c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49
    $cl = 'GR0068088SURFACE-B2C';
    //   $url = "https://staging-express.delhivery.com/waybill/api/bulk/json/?token=".$accesstoken."&cl=".$cl."&count=".$count;//staging
    $url = "https://track.delhivery.com/waybill/api/bulk/json/?token=" . $accesstoken . "&cl=" . $cl . "&count=" . $count;//live
    $curl = curl_init();

    $headr = array();
    $headr[] = 'Access: 0';
    $headr[] = 'Content-type: application/json';
    $headr[] = 'Authorization: Token ' . $accesstoken;

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    // dd($data);
    return $data;
  }
}

if (!function_exists('track_order')) {
  function track_order($waybill)
  {
    $accesstoken = 'c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49';//'ec1ee821dc6ca3355a018d48828d3e2ccb892de7';//c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49
    $cl = 'GR0068088SURFACE-B2C';
    //$url = "https://staging-express.delhivery.com/api/v1/packages/json/?token=".$accesstoken."&waybill=".$waybill;//staging
    $url = "https://track.delhivery.com/api/v1/packages/json/?token=" . $accesstoken . "&waybill=" . $waybill;//live
    $curl = curl_init();

    $headr = array();
    $headr[] = 'Access: 0';
    $headr[] = 'Content-type: application/json';
    $headr[] = 'Authorization: Token ' . $accesstoken;

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    // dd($data);
    return $data;
  }
}

if (!function_exists('packing_slip')) {
  function packing_slip($waybill)
  {
    // $waybill = "8863210000022";
    $accesstoken = 'c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49';//'ec1ee821dc6ca3355a018d48828d3e2ccb892de7';//c7bd1bd7f2ed46a36775d63e8c9ee43617ffee49
    $cl = 'GR0068088SURFACE-B2C';
    //   $url = "https://staging-express.delhivery.com/api/p/packing_slip?token=".$accesstoken."&wbns=".$waybill;//staging
    $url = "https://track.delhivery.com/api/p/packing_slip?token=" . $accesstoken . "&wbns=" . $waybill;//live
    $curl = curl_init();

    $headr = array();
    $headr[] = 'Access: 0';
    $headr[] = 'Content-type: application/json';
    $headr[] = 'Authorization: Token ' . $accesstoken;

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    //   dd($data);
    return $data;
  }
}

if (!function_exists('get_cart_product_weight')) {
  function get_cart_product_weight()
  {
    $cart_total = new stdClass();
    if (isset(auth()->user()->id)) {
      $user_id = auth()->user()->id;
      if ($user_id) {
        // $cart_total = Cart::where('user_id',$user_id)->with(['products'])->select(DB::raw('sum(products.product_discounted_price*cart.qty) as cart_total'))->first();
        // $cart_total = Cart::where('user_id',$user_id)->join('products', 'products.product_id', '=', 'cart.product_id')->select(DB::raw('sum(products.product_weight*cart.qty) as cart_total_product_weight'))->first();
        $cart = Cart::where('user_id', $user_id)->with(['products', 'product_variant'])->get();
        $product_wt = 0;
        foreach ($cart as $item) {
          $join_table = 'products';
          if ($item->product_type == "configurable") {
            $join_table = 'product_variant';
          }
          $product_wt = $product_wt + ($item->{$join_table}->product_weight * $item->qty);
        }
        // dd($product_wt);
        $cart_total->cart_total_product_weight = $product_wt;
        $cart_total = ($cart_total->cart_total_product_weight) ? $cart_total->cart_total_product_weight : 0;
      }
    } else {
      if (session('cart') != NULL) {
        $cart = new Collection();
        foreach (session('cart') as $item) {
          $product_id[] = $item['product_id'];
          $cart_details = new Cart();
          $cart_details->fill($item);
          $cart_details->qty = $item['quantity'];
          $cart->push($cart_details);
        }

        $product_wt = 0;
        foreach ($cart as $item) {
          $join_table = 'products';
          if ($item->product_type == "configurable") {
            $join_table = 'product_variant';
          }
          $product_wt = $product_wt + ($item->{$join_table}->product_weight * $item->qty);
        }
        // dd($product_wt);
        $cart_total->cart_total_product_weight = $product_wt;
        $cart_total = ($cart_total->cart_total_product_weight) ? $cart_total->cart_total_product_weight : 0;
      }
    }
    // dd($cart_total);
    return $cart_total;
  }
}


if (!function_exists('order_cancellation')) {

  function order_cancellation($shiprocket_order_id)
  {
    $email = env('SHIPROCKET_EMAIL');
    $password = env('SHIPROCKET_PASSWORD');

    // Shiprocket API endpoints
    $authUrl = 'https://apiv2.shiprocket.in/v1/external/auth/login';

    // Step 1: Authenticate and get access token
    $authPayload = [
      'email' => $email,
      'password' => $password,
    ];

    $authResponse = makeCurlRequest($authUrl, $authPayload);

    if (!isset($authResponse['token'])) {
      throw new Exception('Authentication failed: ' . json_encode($authResponse));
    }

    $accessToken = $authResponse['token'];

    // $url = "https://staging-express.delhivery.com/api/p/edit";//staging
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/cancel',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '{
      "ids": [' . $shiprocket_order_id . ']
      }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;

  }
}

//mahesh 09-02-2022 
//for setting status wise color for orders
if (!function_exists('order_status_color')) {
  function order_status_color($orders)
  {
    $status_color = "order-status-color-default";
    if ($orders->order_return_flag == 1 && $orders->order_return_status == 1) {
      $status_color = "order-status-color-return";
    } else if ($orders->order_return_flag == 1 && $orders->order_return_status == 0 && $orders->order_return_status != NULL) {
      $status_color = "order-status-color-return";
    }
    if ($orders->order_return_flag == 1) {
      $status_color = "order-status-color-return";
    } else {
      if ($orders->cancel_order_flag == 1) {
        $status_color = "order-status-color-cancellation";
      } else {
        if ($orders->confirmed_stage == 1) {
          $status_color = "order-status-color-confirmed";
        }
        if ($orders->preparing_order_stage == 1) {
          $status_color = "order-status-color-preparing";
        }
        if ($orders->shipped_stage == 1) {
          $status_color = "order-status-color-shipped";
        }
        if ($orders->out_for_delivery_stage == 1) {
          $status_color = "order-status-color-out-of-delivery";
        }
        if ($orders->delivered_stage == 1) {
          $status_color = "order-status-color-delivery";
        }
      }
    }

    return $status_color;
  }
}

if (!function_exists('get_sender_id')) {
  function get_sender_id()
  {
    $api_key = 'dFj1uhayNYO2HeeWXLOalL2iW193a3PMd1SqzNoDvdk=';
    $client_id = '7a7bb9c4-3e0c-4f1a-990e-16f5046510e6';
    $url = " https://smppapi.theitmatic.com/api/v2/SenderId?ApiKey=" . $api_key . "&ClientId=" . $client_id;//live
    $curl = curl_init();
    $headr = array();
    $headr[] = 'Access: 0';
    $headr[] = 'Content-type: application/json';
    $headr[] = 'Type: json';
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    //   dd($data);
    return $data;
  }
}
if (!function_exists('send_sms')) {
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
    if (isset($sender_id) && $sender_id != "") {
      $url = "https://smppapi.theitmatic.com/api/v2/SendSMS";//live
      $postRequest = '{
                        "SenderId": "' . $sender_id . '",
                        "Message": "' . $message . '",
                        "MobileNumbers": "' . $mobile_no . '",
                        "ApiKey": "' . $api_key . '",
                        "ClientId": "' . $client_id . '"
                      }';
      $curl = curl_init();
      $headr = array();
      // $headr[] = 'Access: 0';
      $headr[] = 'Content-type: application/json';
      // $headr[] = 'Type: json';
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);
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