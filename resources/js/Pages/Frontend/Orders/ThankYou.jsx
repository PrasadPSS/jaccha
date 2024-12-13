import { asset } from "@/Helpers/asset";
import HomeLayout from "@/Layouts/HomeLayout";
import { Head } from "@inertiajs/react";
import React from "react";

export default function ThankYou({auth}) {

    return (
        <HomeLayout auth={auth}>
            <Head title="Order Success"></Head>
            <div className="container text-center py-5">
                <div className="row justify-content-center">
                    <div className="col-md-6">
                        <div className="card shadow-lg p-4">
                            <div className="card-body">
                                <div className="text-success mb-3">
                                    <i className="bi bi-check-circle display-4"></i>
                                </div>
                                <h1 className="h3 mb-3">Thank You for Your Order!</h1>
                                <p className="text-muted">
                                    Your order has been successfully placed. We’ll send you a confirmation email shortly with the details.
                                </p>
                                <a href={route('product.index')} className="btn btn-primary mt-3">
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </HomeLayout>
    );
}
