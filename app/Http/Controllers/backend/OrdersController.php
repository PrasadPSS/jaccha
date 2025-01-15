<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Models\backend\Categories;
use App\Models\backend\Company;
use App\Models\backend\MissingPayments;
use App\Services\phpMailerService;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\backend\SubSubCategories;
use App\Models\frontend\Orders;
use App\Models\frontend\OrdersProductDetails;
use App\Models\frontend\ShippingAddresses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\backend\PaymentInfo;
use App\Models\frontend\OrderCancellationReasons;
use App\Models\frontend\Newsletters;
use App\Models\frontend\InvoiceCounter;
require 'mailer/PHPMailerAutoload.php';


class OrdersController extends Controller
{



  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */


  public function index()
  {
    $orders = Orders::orderBy('order_id', 'DESC')->get();
    // $orders=DB::table('orders')
    //     ->join('users','users.id','=','orders.user_id')
    //     ->select('users.name','users.email','orders.orders_counter_id','orders.total',
    //        'orders.payment_tracking_code','orders.created_at','orders.order_id')
    //     ->get();
    return view('backend.orders.index', compact('orders'));
  }

  public function viewInvoice($id)
  {
    $orders = Orders::where('order_id', $id)->with(['orderproducts'])->first();
    $shipping_address = ShippingAddresses::where('user_id', $orders->user_id)->where('default_address_flag', 1)->first();
    if (!$shipping_address) {
      $shipping_address = ShippingAddresses::where('user_id', $orders->user_id)->first();
    }
    $company = Company::first();
    return view('backend.orders.viewinvoice', compact('orders', 'shipping_address', 'company'));
  }

  public function downloadInvoice($id)
  {
    $orders = Orders::where('order_id', $id)->with('orderproducts')->first();

    $company = Company::first();
    $pdf = PDF::loadView('backend.orders.downloadinvoice', ['orders' => $orders, 'company' => $company]);
    return $pdf->download('jacchainvoice.pdf');
  }

  public function details($id)
  {
    $orders = Orders::where('order_id', $id)->with('orderproducts', 'cancelreason', 'orderproducts.products')->first();
    $shipping_address = ShippingAddresses::where('user_id', $orders->user_id)->where('default_address_flag', 1)->first();
    if (!$shipping_address) {
      $shipping_address = ShippingAddresses::where('user_id', $orders->user_id)->first();
    }
    $payment_details = PaymentInfo::where('transaction_id', $orders->transaction_id)->first();
    //diable progress checkbox
    $shipped_disable = false;
    if ($orders->shipped_stage == 1) {
      $shipped_disable = true;
    }
    if ($orders->confirmed_stage == 1 && $shipped_disable == false) {
      $preparing_order_stage = false;
    } else {
      $preparing_order_stage = true;
    }
    if ($orders->preparing_order_stage == 1 && $shipped_disable == false) {
      $shipped_stage = false;
    } else {
      $shipped_stage = true;
    }
    if ($orders->shipped_stage == 1) {
      $out_for_delivery_stage = false;
    } else {
      $out_for_delivery_stage = true;
    }
    if ($orders->out_for_delivery_stage == 1) {
      $delivered_stage = false;
    } else {
      $delivered_stage = true;
    }

    return view('backend.orders.viewdetails', compact('orders', 'shipping_address', 'payment_details', 'shipped_disable', 'preparing_order_stage', 'shipped_stage', 'out_for_delivery_stage', 'delivered_stage'));
  }

  public function updatecodstatus(Request $request)
  {
    $payment_id = $request->input('payment_id');
    $this->validate($request, [
      'status' => 'required',
    ]);
    $payment_details = PaymentInfo::where('payment_id', $payment_id)->first();
    $payment_details->fill($request->all());
    // dd($payment_details);
    if ($payment_details->update()) {
      return back()->with('success', 'COD Payment Status Updated!');
    } else {
      return back()->with('error', 'Something went wrong!');
    }
  }

  public function updateprogress(Request $request)
  {
    $order_id = $request->input('order_id');
    $this->validate($request, [
      'order_id' => 'required',
    ]);
    $date_time = date('Y-m-d h:i:s');

    $order = Orders::where('order_id', $order_id)->first();

    if (!$order) {
      return back()->with('error', 'Order not found.');
    }

    // Check if the order is already canceled or returned
    if ($order->cancel_order_flag == 1) {
      return back()->with('error', 'Order already cancelled, unable to update the order status!');
    } elseif ($order->order_return_flag == 1) {
      return back()->with('error', 'Order is already returning, unable to update the order status!');
    }

    // Validate stage transitions to ensure no regression
    $stages = [
      'confirmed_stage' => $order->confirmed_stage,
      'preparing_order_stage' => $order->preparing_order_stage,
      'shipped_stage' => $order->shipped_stage,
      'out_for_delivery_stage' => $order->out_for_delivery_stage,
      'delivered_stage' => $order->delivered_stage,
    ];
    
    foreach ($stages as $stage => $currentValue) {
      info( ($request->$stage == 0 || $request->$stage == null) && $currentValue == 1);
      if (  ($request->$stage == 0 || $request->$stage == null) && $currentValue == 1) {
        return back()->with('error', 'You cannot move back from a completed stage.');
      }
    }

    // Handle stage updates and perform actions based on stages
    if (($order->confirmed_stage == 0 || $order->confirmed_stage == null) && $request->confirmed_stage) {
      // Confirm stage logic
      if ($order->package_order_status == 0) {
        $package_response = self::create_package_order_on_update($order_id);
        if ($package_response[0] == 'error') {
          return back()->with('error', $package_response[1]);
        }
      }

      if (!$order->invoice_counter_id) {
        $invoice_counter = InvoiceCounter::first();
        $invoice_counter_increment_id = $invoice_counter->invoice_counter + 1;
        $invoice_counter->invoice_counter = $invoice_counter_increment_id;
        $invoice_counter->save();
        $order->invoice_counter_id = "GRP" . $invoice_counter_increment_id;
        $order->update();
      }

      self::SendInvoice($order, $order->email);

      if (isset($order->mobile_no) && strlen($order->mobile_no) == 10) {
        $mobile_no = $order->mobile_no;
        $message = "Dear {$order->customer_name}, Thank you for Shopping at Jaccha.com! Your Order Number {$order->orders_counter_id} has been confirmed and is being processed for shipping.\nJaccha Team.";
        $sms_api = send_sms($mobile_no, $message);
        $sms_api_response = json_decode($sms_api, true);
        $order->order_confirmation_sms = isset($sms_api_response['ErrorCode']) && $sms_api_response['ErrorCode'] == 0 ? 1 : 0;
        $order->update();
      }
    }

    if (($order->shipped_stage == 0 || $order->shipped_stage == null) && $request->shipped_stage) {

      // Shipped stage logic
      $awb = generate_awb($order->shipping_pincode, json_decode($order->package_order_dump)->shipment_id);
      $shipment = place_shipment($order->shipping_pincode);
      if($awb->response->data->awb_code != null)
      {
        $order->wbn = $awb->response->data->awb_code;
      }
      $order->package_item_dump = json_encode($awb);
      $order->package_waybill = json_encode($shipment);
      $order->update();

      if (isset($order->mobile_no) && strlen($order->mobile_no) == 10) {
        $mobile_no = $order->mobile_no;
        $message = "Dear {$order->customer_name}, Your Order Number {$order->orders_counter_id} from Jaccha.com has shipped via Shiprocket. Your Order's Tracking Number is {$order->wbn}.\nJaccha Team.";
        $sms_api = send_sms($mobile_no, $message);
        $sms_api_response = json_decode($sms_api, true);
        $order->order_shipped_sms = isset($sms_api_response['ErrorCode']) && $sms_api_response['ErrorCode'] == 0 ? 1 : 0;
        $order->update();
      }
    }

    if (($order->delivered_stage == 0 || $order->delivered_stage == null) && $request->delivered_stage) {
      // Delivered stage logic
      if (isset($order->mobile_no) && strlen($order->mobile_no) == 10) {
        $mobile_no = $order->mobile_no;
        $message = "Dear {$order->customer_name},\nYour Order Number {$order->orders_counter_id} has been delivered at your given shipping address. Keep Shopping at www.Jaccha.com. Share the Jaccha love with your family, relatives and friends.\nRegards,\nJaccha Team,\nG.R. Parwani Trading Co.";
        $sms_api = send_sms($mobile_no, $message);
        $sms_api_response = json_decode($sms_api, true);
        $order->order_delivered_sms = isset($sms_api_response['ErrorCode']) && $sms_api_response['ErrorCode'] == 0 ? 1 : 0;
        $order->update();
      }
    }

    // Update dates and save progress
    $order->confirmed_date = $order->confirmed_stage == 0 && $request->confirmed_stage ? $date_time : $order->confirmed_date;
    $order->preparing_order_date = $order->preparing_order_stage == 0 && $request->preparing_order_stage ? $date_time : $order->preparing_order_date;
    $order->shipped_date = $order->shipped_stage == 0 && $request->shipped_stage ? $date_time : $order->shipped_date;
    $order->out_for_delivery_date = $order->out_for_delivery_stage == 0 && $request->out_for_delivery_stage ? $date_time : $order->out_for_delivery_date;
    $order->delivered_date = $order->delivered_stage == 0 && $request->delivered_stage ? $date_time : $order->delivered_date;

    $order->fill($request->all());
    $order->confirmed_stage = isset($request->confirmed_stage) ? 1 : $order->confirmed_stage;
    $order->preparing_order_stage = isset($request->preparing_order_stage) ? 1 : $order->preparing_order_stage;
    $order->shipped_stage = isset($request->shipped_stage) ? 1 : $order->shipped_stage;
    $order->out_for_delivery_stage = isset($request->out_for_delivery_stage) ? 1 : $order->out_for_delivery_stage;
    $order->delivered_stage = isset($request->delivered_stage) ? 1 : $order->delivered_stage;

    if ($order->update()) {
      return back()->with('success', 'Order Progress Updated!');
    } else {
      return back()->with('error', 'Something went wrong!');
    }
  }

  //not using this one now
  public function create_package_order($id)
  {
    $orders = Orders::where('order_id', $id)->with('orderproducts', 'orderproducts.products.hsncode')->first();
    if ($orders) {
      if ($orders->cancel_order_flag == 1) {
        return back()->with('error', 'Order already cancelled, unable to create package!');
      }
      if ($orders->package_order_status == 0) {
        // $product_qty = isset($orders->orderproducts)?$orders->orderproducts->sum('qty'):0;
        // $bulk_waybills = create_bulk_waybill($product_qty);
        $order_creation_response = order_creation($orders);

        $order_creation_response = json_decode($order_creation_response, true);
        // dd($order_creation_response);
        if ($order_creation_response['status'] == true) {
          $phpMailer = new phpMailerService();
          $phpMailer->sendMail($orders->email, 'Order Created Successfully', 'Your order has been created successfully' . ' click here to view your order ' . route('order.details') . '?order_id=' . $orders->order_id, 'Order Creation');
          $orderDate = date('Y-m-d');
          $orderDate = date('Y-m-d', strtotime($orderDate));
          $orders->package_order_status = 1;
          $orders->package_order_dump = json_encode($order_creation_response);
          $orders->shiprocket_order_id = $order_creation_response['order_id'];
          $orders->package_order_date = $orderDate;

          
          if ($orders->update()) {
            // dd($order_creation_response);
            return back()->with('success', 'Package Order created Successfully!');
          } else {
            return back()->with('error', 'Something went wrong!');
          }
        } else {
          // dd($order_creation_response);
          return back()->with('error', 'Something went wrong while creating the package order!');
        }
        // dd($order_creation_response);
      } else {
        return back()->with('error', 'Package Order already created!');
      }
    } else {
      return back()->with('error', 'Order Not Found!');
    }

  }

  public function track_order($id)
  {
    $orders = Orders::where('order_id', $id)->with('orderproducts')->first();
    if ($orders) {
      if ($orders->package_order_status == 0) {
        // $product_qty = isset($orders->orderproducts)?$orders->orderproducts->sum('qty'):0;
        // $bulk_waybills = create_bulk_waybill($product_qty);
        $order_creation_response = order_creation($orders);
        $order_creation_response = json_decode($order_creation_response, true);
        // dd($order_creation_response);exit;
        if ($order_creation_response['success'] == true) {
          $orderDate = date('Y-m-d');
          $orderDate = date('Y-m-d', strtotime($orderDate));
          $orders->package_order_status = 1;
          $orders->package_order_dump = json_encode($order_creation_response);
          $orders->package_order_date = $orderDate;

          if ($orders->update()) {
            return back()->with('success', 'Package Order created Successfully!');
          } else {
            return back()->with('error', 'Something went wrong!');
          }
        } else {
          // dd($order_creation_response);exit;
          return back()->with('error', 'Something went wrong while creating the package order!');
        }
      } else {
        return back()->with('error', 'Package Order already created!');
      }
    } else {
      return back()->with('error', 'Order Not Found!');
    }

  }


  public function generate_pacakge_slips($id)
  {
    $package_slip_responses = [];
    $orders = Orders::where('order_id', $id)->with('orderproducts')->first();
    if ($orders) {
      if ($orders->cancel_order_flag == 1) {
        return back()->with('error', 'Order already cancelled, unable to create slips!');
      }
      // else if ($orders->order_return_flag==1)
      // {
      //   return back()->with('error', 'Order already returing, unable to update the order status!');
      // }
      if ($orders->package_order_status == 1) {
        // $product_qty = isset($orders->orderproducts)?$orders->orderproducts->sum('qty'):0;
        // $bulk_waybills = create_bulk_waybill($product_qty);
        // foreach ($orders->orderproducts as $orderproduct)
        // {
        $package_slip_response = packing_slip($orders->package_waybill);
        $package_slip_responses = json_decode($package_slip_response, true);
        // dd($package_slip_responses);//exit;
        // }
        return view('backend.orders.viewpackageslips', compact('orders', 'package_slip_responses'));
      } else {
        return back()->with('error', 'Package Order Not created!');
      }
    } else {
      return back()->with('error', 'Order Not Found!');
    }

  }

  public function generate_product_labels($id)
  {
    // $package_slip_responses = [];
    $orders = Orders::where('order_id', $id)->with('orderproducts')->first();
    if ($orders) {
      if ($orders->preparing_order_stage == 1) {
        // $product_qty = isset($orders->orderproducts)?$orders->orderproducts->sum('qty'):0;
        // $bulk_waybills = create_bulk_waybill($product_qty);
        // foreach ($orders->orderproducts as $orderproduct)
        // {
        //   $package_slip_response = packing_slip($orderproduct->package_waybill);
        //   $package_slip_responses[$orderproduct->orders_product_details_id] = json_decode($package_slip_response,true);
        //   // dd($package_slip_responses);exit;
        // }
        return view('backend.orders.viewproductlabels', compact('orders'));
      } else {
        return back()->with('error', 'Package Not ready!');
      }
    } else {
      return back()->with('error', 'Order Not Found!');
    }

  }

  public function updatereturnstatus(Request $request)
  {
    $order_id = $request->input('order_id');
    $this->validate($request, [
      'order_return_status' => 'required',
    ]);
    $date_time = date('Y-m-d h:i:s');
    $date_time = date('Y-m-d h:i:s', strtotime($date_time));

    $order = Orders::where('order_id', $order_id)->first();
    $order->order_return_status_date = $date_time;
    $order->fill($request->all());
    // dd($order);
    if ($order->update()) {
      return back()->with('success', 'Order Return Status Updated!');
    } else {
      return back()->with('error', 'Something went wrong!');
    }
  }

  public function cancelorder($id)
  {
    $orders = Orders::where('order_id', $id)->with('orderproducts')->first();
    if ($orders->cancel_order_flag == 1) {
      return back()->with('error', 'Order already cancelled');
    }
    // else if($orders->shipped_stage==1)
    // {
    //   return back()->with('error','Order already Shipped');
    // }
    else if ($orders->delivered_stage == 1) {
      return back()->with('error', 'Order already Delivered');
    } else if ($orders->order_return_flag == 1) {
      return back()->with('error', 'Order already Returned');
    }
    $reasons = OrderCancellationReasons::where('for_jaccha', 1)->get()->pluck('order_cancellation_reason_desc', 'order_cancellation_reason_id');
    return view('backend.orders.cancel_order', compact('orders', 'reasons'));
    // return redirect()->to('/myaccount/profile');
  }

  public function cancelorderstatus(Request $request)
  {
    $id = $request->order_id;
    $user_id = auth()->user()->id;
    $this->validate(request(), [
      'order_id' => 'required',
      'order_cancellation_reason_id' => 'required',
    ]);
    // echo "string";exit;
    $date_time = date('Y-m-d h:i:s');
    $date_time = date('Y-m-d h:i:s', strtotime($date_time));

    $reasons = OrderCancellationReasons::where('order_cancellation_reason_id', $request->order_cancellation_reason_id)->first();
    $orders = Orders::where('order_id', $id)->with('orderproducts')->first();
    if ($orders->cancel_order_flag == 1) {
      return back()->with('error', 'Order already cancelled');
    } else if ($orders->delivered_stage == 1) {
      return back()->with('erv', 'Order already Delivered');
    } else if ($orders->order_return_flag == 1) {
      return back()->with('error', 'Order already Returned');
    }
    $orders->cancel_order_flag = 1;
    $orders->cancel_order_date = $date_time;
    $orders->order_cancellation_reason_id = $reasons->order_cancellation_reason_id;
    $orders->cancel_reason = $reasons->order_cancellation_reason_desc;
    // dd($orders->mobile_no);
    if ($orders->fill($request->all())->update())//->update()
    {
      //cancel delivery order if exists
      if ($orders->package_order_status == 1) {
       
          $shiprocket_order_id = $orders->shiprocket_order_id;
          if ($shiprocket_order_id != '') {

            $orderproduct_cancel = order_cancellation($shiprocket_order_id);
            $orderproduct_cancel = json_decode($orderproduct_cancel);
            if ($orderproduct_cancel != null && $orderproduct_cancel->status_code == 200) {
              $orders->package_cancel_return_status = 1;
              $orders->package_cancel_return_dump = json_encode($orderproduct_cancel);
            } else {
              $orders->package_cancel_return_status = 0;
            }
          }
          $orders->update();
        
      }
      $this->send_cancel_order_email($orders);
      //send cancellation SMS
      if (isset($orders->mobile_no) && $orders->mobile_no != "" && strlen($orders->mobile_no) == 10) {
        $mobile_no = $orders->mobile_no;

        $message = "Dear " . $orders->customer_name . ",\nWe regret to inform you that due to some unforeseen issues, your Order Number " . $orders->orders_counter_id . " has been cancelled by Jaccha.\nIn case, if you have already made payment for the same Order, your refund will be credited shortly to your original payment method.We apologize for the inconvenience caused.\nJaccha Team.";
        $message_url = urlencode($message);

        $sms_api = send_sms($mobile_no, $message);
        $sms_api_response = json_decode($sms_api, true);
        $orders->order_cancel_sms = (isset($sms_api_response['ErrorCode']) && $sms_api_response['ErrorCode'] == 0) ? 1 : 0;
        $orders->update();
        // dd($sms_api_response);

      }
      return redirect()->to('admin/orders/details/' . $id)->with('success', 'Order Cancelled Successfully');
    } else {
      return back()->with('error', 'Something went wrong!');
    }

  }


  public function send_cancel_order_email($orders)
  {

    $email = ($orders->email != "") ? $orders->email : auth()->user()->email;
    info($email);
    $customer_name = ($orders->customer_name != "") ? $orders->customer_name : auth()->user()->name;
    try {
      $mail = new PHPMailer();
      $mail->IsSMTP();

      $mail->CharSet = "utf-8";// set charset to utf8
      // $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
      // $mail->SMTPAuth = true; // authentication enabled
      // $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
      // $mail->Host = "smtp.gmail.com";
      // $mail->Port = 587; // or 465

      //for live start
      $mail->Host = "localhost";
      $mail->SMTPSecure = "tls";
      $mail->SMTPDebug = 0;
      $mail->SMTPAuth = false;
      $mail->Mailer = "smtp";
      $mail->Port = 25;
      $mail->Username = "";
      $mail->Password = '';
      //for live end

      //for local start
      // $mail->SMTPAuth = true; // authentication enabled
      // $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
      // $mail->Host = "smtp.gmail.com";
      // $mail->Port = 587; // or 465
      // $mail->Username = "testesatwat@gmail.com";
      // $mail->Password = 'Esatwat@0000';
      //for local end

      $mail->SMTPOptions = array(
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        )
      );

      // $mail->isHTML(true);
      $mail->SetFrom('info@Jaccha.com', 'Jaccha');
      $mail->AddBCC("maheshm@parasightsolutions.com");
      $mail->AddAddress($email);
      $mail->Subject = "Cancellation of your Order Number: " . $orders->orders_counter_id . " Dated: " . date('d.m.Y', strtotime($orders->created_at));
      $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically

      $newsletter = Newsletters::where('email', $orders->email)->first();
      $unsubscribe_data = "";
      if (isset($newsletter) && $newsletter->token != '') {
        $unsub_token = $newsletter->token;
        $unsubscribe_url = url('/newsletter/unsubscribe', $unsub_token);
        $unsubscribe_data = "<p style='font-size:12px;line-height:normal;font-family:arial;text-align:center;'>--<br><a href='" . $unsubscribe_url . "' target='_blank' >Click Here</a> to unsubscribe from this newsletter.<br><br></p>";
      }

      // $unsubscribe_url = URL::to('/').'/newsletter/unsubscribe/'.$unsub_token;
      // $unsubscribe_url = '';
      //$invoive_msg=$this->renderPartial('invoice',['orders'=>$orders,'date'=>$date,'payment_mode'=>$payment_mode]);
      $cancel_reason = ($orders->cancel_reason != "") ? $orders->cancel_reason : 'Out Of Stock';
      $message = "
        <html>
        <head>
        <style>
        table{width:100%;}
        table,td{
          border:1px solid #ccc;
          border-collapse: collapse;
        }
        td{
          padding:8px;
          font-size:15px;
        }
        h1{
          font-size:16px;
        }
        tr:nth-child(even) {background-color: #f2f2f2;}
        th{
            background-color:rgba(127,82,53, 0.85);
        }
        </style>
        </head>
        <body>
        <div style='margin:auto;'><a href='https://jaccha.com'></a></div>
        <p>Dear " . $customer_name . ",</p>
        <p>We regret to inform you that your order on https://jaccha.com has been canceled due to the following reason:</p>
        <p>" . $cancel_reason . "</p>
        <p>We apologise for the inconvenience caused to you due to this cancellation. Any amount you have paid for the above mentioned order will be refunded to your source account within 3 to 5 working days.</p>
        <p>Your understanding and support in this regard is highly appreciated. For any further queries in this regard, please feel free to contact our customer care team.</p>
        <p>Thank you for shopping with Jaccha!</p>
        <p>You are always welcome at https://jaccha.com</p>
        <br>
        <p>Regards,</p>
        <p>Pooja Gupta</p>
        <p>Jaccha</p>
        <br>

        " . $unsubscribe_data . "</body></html>
        ";
      $mail->MsgHTML($message);
      //echo $message;
      // var_dump($message);
      $mail->IsHTML(true);
      // $pdf->output();
      $mail->Send();
      $phpMailer = new phpMailerService();
      $phpMailer->sendMail($orders->email, 'Your Order has been Cancelled', $message, $message);

      //echo "Message Sent OK</p>\n";
    } catch (phpmailerException $e) {
      echo $e->errorMessage(); //Pretty error messages from PHPMailer
    } catch (Exception $e) {
      echo $e->getMessage(); //Boring error messages from anything else!
    }
    // end try catch block

  }

  public function delhivery_list(Request $request)
  {
    $start_date = $request->start_date;
    $end_date = $request->end_date;
    if (isset($start_date) && $start_date != "" && isset($end_date) && $end_date != "") {
      $orders = Orders::where('shipped_stage', 0)->whereBetween('orders.created_at', [$start_date, $end_date])->orderBy('order_id', 'DESC')->get();
    } else {
      $end_date = date("Y-m-d");
      $start_date = date('Y-m-01', strtotime($end_date . ' - 1 months'));
      // $orders=Orders::where('shipped_stage',0)->orderBy('order_id','DESC')->get();
      $orders = Orders::where('shipped_stage', 0)->whereBetween('orders.created_at', [$start_date, $end_date])->orderBy('order_id', 'DESC')->get();
    }
    $company = Company::first();
    return view('backend.orders.delhivery_list', compact('orders', 'company', 'start_date', 'end_date'));
  }

  public function SendInvoice($invoicemodel, $email)
  {
    // var_dump($email);exit;
    try {
      $mail = new \PHPMailer();
      $mail->IsSMTP();

      $mail->CharSet = "utf-8";// set charset to utf8
      // $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only

      // $mail->SMTPAuth = true; // authentication enabled
      // $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
      // $mail->Host = "smtp.gmail.com";
      // $mail->Port = 587; // or 465

      //for live start
      $mail->Host = "localhost";
      $mail->SMTPSecure = "tls";
      $mail->SMTPDebug = 0;
      $mail->SMTPAuth = false;
      $mail->Mailer = "smtp";
      $mail->Port = 25;
      $mail->Username = "";
      $mail->Password = '';
      //for live end

      //for local start
      // $mail->SMTPAuth = true; // authentication enabled
      // $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
      // $mail->Host = "smtp.gmail.com";
      // $mail->Port = 587; // or 465
      // $mail->Username = "testesatwat@gmail.com";
      // $mail->Password = 'Esatwat@0000';
      //for local end

      $mail->SMTPOptions = array(
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        )
      );

      // $mail->isHTML(true);
      $mail->SetFrom('info@Jaccha.com', 'Jaccha');
      $mail->AddBCC("maheshm@parasightsolutions.com");
      $mail->AddAddress($email);
      $mail->Subject = "Order Invoice";
      $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically

      $id = $invoicemodel->order_id;
      $orders = Orders::where('order_id', $id)->join("users", "users.id", "=", "orders.user_id")->join("payment_info", "payment_info.payment_tracking_code", "=", "orders.payment_tracking_code")->orderBy('order_id', 'DESC')->first();

      $company = Company::first();
      $pdf = PDF::loadView('frontend.orders.invoice_card', ['orders' => $orders, 'company' => $company]);
      $invoice_msg = view('frontend.orders.invoice_card', compact('orders', 'company'))->render();
      $newsletter = Newsletters::where('email', $invoicemodel->email)->first();
      $unsubscribe_data = "";
      if (isset($newsletter) && $newsletter->token != '') {
        $unsub_token = $newsletter->token;
        $unsubscribe_url = url('/newsletter/unsubscribe', $unsub_token);
        $unsubscribe_data = "<p style='font-size:12px;line-height:normal;font-family:arial;text-align:center;'>--<br><a href='" . $unsubscribe_url . "' target='_blank' >Click Here</a> to unsubscribe from this newsletter.<br><br></p>";
      }

      $message = "
        <html>
        <head>
        <style>
        table{width:100%;}
        table,td{
          border:1px solid #ccc;
          border-collapse: collapse;
        }
        td{
          padding:8px;
          font-size:15px;
        }
        h1{
          font-size:16px;
        }
        tr:nth-child(even) {background-color: #f2f2f2;}
        th{
            background-color:rgba(127,82,53, 0.85);
        }
        </style>
        </head>
        <body><div style='margin:auto;'><a href='http://Jaccha.com/'><img src='http://parasightdemo.com/Jaccha/frontend-assets/images/logoparwani.png' width='120'></a></div>
        <h2 style='color:#333;'>Jaccha</h2><h4 style='color:#333;'>Thank you for shoping at Jaccha. You order is under process and hopefully will be delivered in <span styly='font-weight:bold;'>7 to 8 days.</span></h4>" . $invoice_msg . "
        " . $unsubscribe_data . "</body></html>
        ";
      $mail->MsgHTML($message);
      //echo $message;
      // var_dump($message);
      $mail->IsHTML(true);
      // $pdf->output();
      $mail->addStringAttachment($pdf->output('S'), "Invoice.pdf");
      $mail->Send();
      //echo "Message Sent OK</p>\n";
    } catch (phpmailerException $e) {
      echo $e->errorMessage(); //Pretty error messages from PHPMailer
    } catch (Exception $e) {
      echo $e->getMessage(); //Boring error messages from anything else!
    }
    // end try catch block

  }

  public function create_package_order_on_update($id)
  {
    $orders = Orders::where('order_id', $id)->with('orderproducts')->first();
    if ($orders) {
      if ($orders->cancel_order_flag == 1) {
        return array('error', 'Order already cancelled, unable to create package!');
      }
      if ($orders->package_order_status == 0) {
        // $product_qty = isset($orders->orderproducts)?$orders->orderproducts->sum('qty'):0;
        // $bulk_waybills = create_bulk_waybill($product_qty);
        $order_creation_response = order_creation($orders);
        $order_creation_response = json_decode($order_creation_response, true);
        // dd($order_creation_response);
        if ($order_creation_response['status_code'] == true) {
          $orderDate = date('Y-m-d');
          $orderDate = date('Y-m-d', strtotime($orderDate));
          $orders->package_order_status = 1;
          $orders->package_order_dump = json_encode($order_creation_response);
          $orders->package_order_date = $orderDate;
          $orders->wbn = $order_creation_response['upload_wbn'];

          if (isset($order_creation_response['packages']) && count($order_creation_response['packages']) > 0) {
            foreach ($order_creation_response['packages'] as $order_package) {
              //after merging the items
              $orders->package_waybill = $order_package['waybill'];
              $orders->package_item_dump = json_encode($order_package);
            }
          }
          if ($orders->update()) {
            // dd($order_creation_response);
            return array('success', 'Package Order created Successfully!');
          } else {
            return array('error', 'Something went wrong!');
          }
        } else {
          // dd($order_creation_response);
          return array('error', 'Something went wrong while creating the package order!');
        }
        // dd($order_creation_response);
      } else {
        return array('error', 'Package Order already created!');
      }
    } else {
      return array('error', 'Order Not Found!');
    }

  }


}//class end
