import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import HomeLayout from '@/Layouts/HomeLayout';
import convertToShortDateFormat from '@/Helpers/date';
import UserMenu from '@/Layouts/UserMenu';
import { Head, Link, router } from '@inertiajs/react';
import React from 'react';

export default function ViewOrderDetails({ auth, orders }) {


    return (
        <UserMenu auth={auth} activeTab={'orders'}>
            <div
                  class="tab-pane fade show active"
                  id="pills-third"
                  role="tabpanel"
                  aria-labelledby="pills-third-tab"
                >
                  <div class="account-right-content">
                    <div class="details-heading px-4 py-3">
                      <h3>My Orders{'>>'} Order Id : #{orders.orders_counter_id}</h3>
                    </div>
                    <div class="order_boxes">
                      <div class="order_heading">
                        <p>Ordered Id : <b>#{orders.orders_counter_id}</b></p>
                        <p>Ordered Placed Date : <b>{new Date(orders.created_at).getDate() + '-' + new Date(orders.created_at).getMonth() + '-' + new Date(orders.created_at).getFullYear()}</b></p>
                        <p>
                          <span className={orders.delivered_stage ? "sts_delivered":'sts_confirmed'}
                            >Order Status : {
                                orders.delivered_stage
                                    ? orders.delivered_stage
                                    : orders.out_of_delivery_stage
                                        ? "Out for Delivery"
                                        : orders.shipped_stage
                                            ? "Shipped"
                                            : orders.preparing_order_stage
                                                ? "Preparing Order"
                                                : orders.confirmed_stage
                                                    ? "Confirmed"
                                                    : "Pending"
                            }
                            </span>
                        </p>
                        <Link as='button' className="black button" href={'/orders/viewinvoice/' + orders.order_id}>View Invoice</Link>
                      </div>
                      {orders.delivered_stage == 1  || orders.wbn != null &&
                        <div className="track-order-box d-flex order_heading">

                          <p> {orders.delivered_stage == 1 ? "Delivered Date:" + orders.delivered_date : ""}</p>
                              {orders.delivered_stage == 0 && orders.wbn != null &&

                          <button data-bs-toggle="modal"
                          data-bs-target="#exampleModal" className="black button" onClick={()=> window.open('https://shiprocket.co/tracking/' + orders.wbn,'winname','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=500,height=800')} target='_blank'>Track Order</button>}
                         
                        </div>
                      }
                      
                      <div className="order_content">
                        {orders.orderproducts.map((products, index)=>
                        (
                            <div class="checkout-product mt-3" key={index}>
                          <div class="checkout-product_details d-flex">
                            <div class="checkout-product_img position-relative">
                              <img
                                src={'/backend-assets/uploads/product_thumbs/' +products.products.product_thumb}
                                alt=""
                              />
                              <p>{products.qty}</p>
                            </div>
                            <div class="checkout-product_content">
                              <h5>{products.product_title}</h5>
                              {/* <p>1kg | Medium Sweetness | Almonds | No Ghee</p> */}
                            </div>
                          </div>
                          <div class="view-order-price"><p>₹{products.product_price}.00</p></div>
                        </div>
                        ))}
                        <br></br>
                      
                        <div class="view-order-payment">
                          <div class="contact_details">
                            <h3>Payment</h3>
                            <p>{orders.payment_mode}</p>
                          </div>
                          <div class="contact_details">
                            <h3>Delivery Address</h3>
                            <p>
                     
                              {orders.shipping_full_name}<br />{orders.shipping_city} 
                              {orders.shipping_pincode}<br />{orders.shipping_state}, {orders.shipping_address_line1}, {orders.shipping_address_line2}
                            </p>
                          </div>
                        </div>
                        <div class="view-order-payment">
                          <div class="contact_details">
                            <h3>Need Help</h3>
                            <p>Order Issues</p>
                            <p>Returns</p>
                          </div>
                          <div class="contact_details">
                            <h3>Order Summary</h3>
                           
                            <div class="view-order-summary">
                              <p>Shipping</p>
                              <p>₹{orders.shipping_amount}</p>
                            </div>
                            {/* <div class="view-order-summary">
                              <p>Delivery</p>
                              <p>₹0.00</p>
                            </div> */}
                            <div class="view-order-summary">
                              <p>Tax</p>
                              <p>+₹{-Number(orders.total_mrp_dicount).toFixed(2)}</p>
                            </div>
                            <div class="view-order-summary">
                              <p><b>Total</b></p>
                              <p><b>₹{Number(orders.total).toFixed(2)}</b></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
        </UserMenu>
    );
};


