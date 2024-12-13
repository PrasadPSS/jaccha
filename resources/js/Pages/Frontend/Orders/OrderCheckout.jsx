import { asset } from "@/Helpers/asset";
import HomeLayout from "@/Layouts/HomeLayout";
import { Head } from "@inertiajs/react";
import React from "react";

export default function OrderCheckout({auth, data }) {
    console.log(data);
    // Destructure the required data
    const {
        cart,
        user,
        shipping_address,
        cart_amounts,
        shipping_amount,
        payment_mode,
        order_delivery,
        increment_id,
        shipping_charges,
        grand_total
    } = data;

    // Calculate grand total
    const finalGrandTotal = cart_amounts.cart.cart_discounted_total + shipping_amount;

    console.log(shipping_amount);

    return (
        <HomeLayout auth={auth}>
            <Head title="Place Order" />
            <div className="container my-4">
                <h1 className="text-center mb-4">Place Your Order</h1>

                {/* Cart Summary */}
                <div className="card mb-4">
                    <div className="card-header">
                        <h4>Cart Summary</h4>
                    </div>
                    <div className="card-body">
                        {cart.map((item, index) => (
                            <div className="row mb-3" key={index}>
                                <div className="col-md-3">
                                    <img
                                        src={asset('backend-assets/uploads/product_thumbs/'+ item.products.product_thumb)}
                                        alt={item.products.product_title}
                                        className="img-fluid"
                                    />
                                </div>
                                <div className="col-md-6">
                                    <h5>{item.products.product_title}</h5>
                                    <p>{item.products.product_desc}</p>
                                    <p>
                                        Price: ₹{item.products.product_price} | Quantity: {item.qty}
                                    </p>
                                </div>
                                <div className="col-md-3 text-end">
                                    <h5>₹{item.products.product_price}</h5>
                                </div>
                            </div>
                        ))}
                        <hr />
                        <div className="d-flex justify-content-between">
                            <h5>Total MRP:</h5>
                            <h5>₹{cart_amounts.cart.cart_mrp_total}</h5>
                        </div>
                        <div className="d-flex justify-content-between">
                            <h5>Discount:</h5>
                            <h5>- ₹{cart_amounts.total_discount}</h5>
                        </div>
                        <div className="d-flex justify-content-between">
                            <h5>Shipping:</h5>
                            <h5>₹{shipping_amount}</h5>
                        </div>
                        <hr />
                        <div className="d-flex justify-content-between">
                            <h4>Total Amount:</h4>
                            <h4>₹{finalGrandTotal}</h4>
                        </div>
                    </div>
                </div>

                {/* Form to place order */}
                <form action="/order/place" method="POST">
                    <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]').getAttribute('content')} />

                    {/* Hidden Fields */}
                    <input type="hidden" name="amount" value={finalGrandTotal} />
                    <input type="hidden" name="shipping_amount" value={shipping_amount} />
                    <input type="hidden" name="txnid" value={increment_id || ""} />
                    <input type="hidden" name="shipping_charges" value={JSON.stringify(shipping_charges || {})} />
                    <input type="hidden" name="shipping_id" value={shipping_address.shipping_address_id} />
                    {/* Shipping Details */}
                    <div className="card mb-4">
                        <div className="card-header">
                            <h4>Shipping Details</h4>
                        </div>
                        <div className="card-body">
                            <p><strong>Name:</strong> {shipping_address.shipping_full_name}</p>
                            <p><strong>Mobile:</strong> {shipping_address.shipping_mobile_no}</p>
                            <p><strong>Address:</strong> {`${shipping_address.shipping_address_line1}, ${shipping_address.shipping_address_line2}, ${shipping_address.shipping_city}, ${shipping_address.shipping_state}, ${shipping_address.shipping_pincode}`}</p>
                        </div>
                    </div>

                    {/* Payment Options */}
                    <div className="card mb-4">
                        <div className="card-header">
                            <h4>Payment Options</h4>
                        </div>
                        <div className="card-body">
                            {payment_mode.map((mode, index) => (
                                <div className="form-check mb-2" key={index}>
                                    <input
                                        className="form-check-input"
                                        type="radio"
                                        name="paymentmode"
                                        id={`paymentMode${mode.payment_mode_id}`}
                                        value={mode.payment_mode_name}
                                        defaultChecked={mode.default_selected === 1}
                                    />
                                    <label className="form-check-label" htmlFor={`paymentMode${mode.payment_mode_id}`}>
                                        {mode.payment_mode_name}
                                    </label>
                                </div>
                            ))}
                        </div>
                    </div>

                    {/* Place Order Button */}
                    <div className="text-center">
                        <button type="submit" className="btn btn-primary btn-lg">Place Order</button>
                    </div>
                </form>
            </div>
        </HomeLayout>
    );
}
