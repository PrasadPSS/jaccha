import { asset } from "@/Helpers/asset";
import HomeLayout from "@/Layouts/HomeLayout";
import { Head } from "@inertiajs/react";
import React from "react";

export default function ThankYou({ auth, orders }) {
    console.log('orders', orders);
    const today = new Date();
    const fiveDaysFromNow = new Date();
    fiveDaysFromNow.setDate(today.getDate() + 5);

    const formatDate = (date) => {
        return date.toLocaleDateString("en-US", {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric",
        });
    };

    return (
        <HomeLayout auth={auth}>
            <Head title="Order Success"></Head>
            <div className="sub-banner  pb-0">
                <div className="container">
                    <div className="row">
                        <div className="col-sm-12">
                            <div className="banner_heading pb-4 thank_heading">
                                <div>
                                    <h2><img src="/assets/images/congrats.png" alt="Jaccha Website Icon" className="img-fluid congrats-icon mb-2" /> Thank You for Your Order!</h2>
                                    <p>Your journey to wellness begins here. We’re excited to serve you!</p>
                                </div>
                                <div >
                                    <p>Order Id : <span>#{orders.orders_counter_id}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <section className="checkout thankYou">
                <div className="container pt-4">
                    <form action="">
                        <div className="row pt-2 g-5" >

                            <div className="col-sm-5">
                                <div className="checkout-right-wrap">
                                    <h2 className="pb-4 order-title">Order Summary</h2>
                                    <div className="checkout-right position-static">
                                        {orders.orderproducts.map((product) => <div className="checkout-product mb-3">
                                            <div className="checkout-product_img position-relative">
                                                <img
                                                    src={"/backend-assets/uploads/product_thumbs/" + product.products.product_thumb}
                                                    alt=""
                                                />
                                                <p>{product.qty}</p>
                                            </div>
                                            <div className="checkout-product_content">
                                                <h5>{product.products.product_title}</h5>

                                            </div>
                                            <div className="checkout-product_price">
                                                <p>₹{product.products.product_price}.00</p>
                                            </div>
                                        </div>)}

                                        {/* <div className="checkout-product mb-3">
                                            <div className="checkout-product_img position-relative">
                                                <img
                                                    src="/assets/images/product-details/products-details-3.jpg"
                                                    alt=""
                                                />
                                                <p>3</p>
                                            </div>
                                            <div className="checkout-product_content">
                                                <h5>Dana Methi Laddoo</h5>
                                                <p>1kg | Medium Sweetness | Almonds | No Ghee</p>
                                            </div>
                                            <div className="checkout-product_price">
                                                <p>₹750.00</p>
                                            </div>
                                        </div>
                                        <div className="checkout-product mb-5 checkout-btm">
                                            <div className="checkout-product_img position-relative">
                                                <img
                                                    src="/assets/images/product-details/products-details-3.jpg"
                                                    alt=""
                                                />
                                                <p>3</p>
                                            </div>
                                            <div className="checkout-product_content">
                                                <h5>Dana Methi Laddoo</h5>
                                                <p>1kg | Medium Sweetness | Almonds | No Ghee</p>
                                            </div>
                                            <div className="checkout-product_price">
                                                <p>₹750.00</p>
                                            </div>
                                        </div> */}
                                        {/* <div className="discount-code">
                  <input
                    type="text"
                    className="form-control"
                    placeholder="Discount Code"
                  />
                  <button className="discount-button" type="button">Apply</button>
                </div>  */}
                                        <div className="payment-history mt-5">
                                            <div className="payment-display mb-2">
                                                <p>Subtotal . {orders.orderproducts.length} Items</p>
                                                <p>₹{Number(orders.total_mrp - orders.total_mrp_dicount).toFixed(2)}</p>
                                            </div>
                                            <div className="payment-display mb-3">
                                                <p>Gst Charges</p>
                                                <p>₹{Math.sign(Number(orders.total_mrp_dicount)) *Number(orders.total_mrp_dicount)}</p>
                                            </div>
                                            {
                                                orders.cod_collection_charge !== null ? 
                                                (<div className="payment-display mb-3">
                                                <p>COD Charges</p>
                                                <p>₹{orders.cod_collection_charge}</p>
                                                </div> )
                                                :  
                                                ""
                                            }
                                            
                                            <div className="payment-display mb-3">
                                                <p>Shipping</p>
                                                <p>₹{orders.shipping_amount}</p>
                                            </div>
                                            
                                            <div className="payment-display">
                                                <p><b>Total</b></p>
                                                <p><b>₹{orders.total}</b></p>
                                            </div>
                                        </div>

                                    </div>

                                    <div className="what-next mt-5 pt-2 ">
                                        <h2 className="pb-4 order-title">What Next?</h2>
                                        <ul className="mb-4 pb-2">
                                            <li> Processing Your Order</li>
                                            <li> Track Your Order</li>
                                            <li><a href="/faq/view">Need Help?</a></li>
                                        </ul>
                                        <a href="/orders/view" id="trackMyorder" className="track-order-btn me-3">Track My Order</a>
                                        <a href="/products" id="continueShopping" className="track-order-btn">Continue Shopping</a>
                                    </div>
                                </div>
                            </div>
                            <div className="col-sm-7">
                                <div className="delivery-details">
                                    <h2 className="pb-4 pt-2 order-title">Delivery Details</h2>
                                    <p>
                                        <strong>Estimated Delivery:</strong> Between {formatDate(today)} and{" "}
                                        {formatDate(fiveDaysFromNow)}
                                    </p>
                                    <p id="shipStatus" className="pt-2 pb-4">🚚 Shipping Status: Processing</p>
                                    <h4>Your order is on its way to you! ✨ We’ll notify you as soon as it’s shipped.</h4>

                                    <div className="thankYouImg">
                                        <img src="/assets/images/thankYouLaddo.png" alt="Jaccha Website Element" className="img-fluid" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </HomeLayout>
    );
}
