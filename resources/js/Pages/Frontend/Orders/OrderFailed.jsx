import { asset } from "@/Helpers/asset";
import HomeLayout from "@/Layouts/HomeLayout";
import { Head, usePage } from "@inertiajs/react";
import React from "react";

export default function OrderFailed({transcation_id}) {
    let auth = usePage().props.auth;

    return (
        <HomeLayout auth={auth}>
            <Head title="Order Failed"></Head>
            <div className="sub-banner  pb-0">
                <div className="container">
                    <div className="row">
                        <div className="col-sm-12">
                            <div className="banner_heading pb-4 thank_heading">
                                <div>
                                    <h2> Oops! Something Went Wrong 😔</h2>
                                    <p>We're sorry, but your payment/order could not be processed at this time.</p>
                                </div>
                                <div className="order-id">
                                    <p>Transaction Id : <span>#{transcation_id}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section className="checkout thankYou">
                <div className="container">
                    <form action="">
                        <div className="row">
                            <div className="col-sm-12">
                                <div className="checkout-right-wrap">
                                    <div className="what-next mt-5 pt-3">
                                        <h2 className="pb-2 order-title">Here’s what you can do:</h2>
                                        <ul className="mb-4 pb-2">
                                            <li> Check your payment details to ensure everything is correct.</li>
                                            <li> Try again after a few minutes—sometimes it's just a temporary issue.</li>
                                            <li><a href="/faq/view"> Need Help?</a></li>
                                        </ul>
                                        <a href="/cart/view" className="track-order-btn me-3">Try Again</a>
                                        <a href="/products" id="continueShopping" className="track-order-btn">Continue Shopping</a>
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
