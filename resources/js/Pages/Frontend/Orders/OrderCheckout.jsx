import { asset } from "@/Helpers/asset";
import HomeLayout from "@/Layouts/HomeLayout";
import { Head, Link, useForm } from "@inertiajs/react";
import axios from "axios";
import React, { useState } from "react";


export default function OrderCheckout({ auth, data }) {


    // Destructure the required data
    const {
        cart,
        user,
        shipping_address,
        shipping_addresses,
        cart_amounts,
        shipping_amount,
        payment_mode,
        order_delivery,
        increment_id,
        shipping_charges,
        grand_total,
        cod_rmk,
        cod_response,
        cod_charges
    } = data;

    const [shippingAmount, setShippingAmount] = useState(shipping_amount);

    const [shippingAddressId, setShippingAddressId] = useState(shipping_address.shipping_address_id);

    const [paymentMode, setPaymentMode] = useState('');
    let finalGrandTotal;
    // Calculate grand total
    if (paymentMode == 'Cash On Delivery') {
        finalGrandTotal = parseFloat(cart_amounts.cart.cart_discounted_total + shippingAmount + Number(cod_charges)).toFixed(2);
    }
    else {
        finalGrandTotal = parseFloat(cart_amounts.cart.cart_discounted_total + shippingAmount).toFixed(2);
    }

    const totalGst = parseFloat(cart_amounts.total_gst).toFixed(2);
    const savings = parseFloat((cart_amounts.cart.cart_discounted_total - totalGst + cart_amounts.product_discount) - finalGrandTotal).toFixed(2);
    const handleAddressChange = (shipping_address_id) => {
        axios.get('/orders/calculaterate/' + shipping_address_id)
            .then(res => {
                setShippingAmount(res.data.shipping_amount);
            })
    }

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
                                        src={asset('backend-assets/uploads/product_thumbs/' + item.products.product_thumb)}
                                        alt={item.products.product_title}
                                        className="img-fluid"
                                    />
                                </div>
                                <div className="col-md-6">
                                    <h5>{item.products.product_title}</h5>
                                    <p>{item.products.product_sub_title}</p>
                                    <p>
                                        Price: ₹{item.products.product_price} | Quantity: {item.qty}
                                    </p>
                                </div>
                                <div className="col-md-3 text-end">
                                    {/* Original Price with Strike-through */}
                                    {item.products.product_price > item.products.product_discounted_price && (
                                        <>
                                            <h5 className="text-muted text-decoration-line-through d-inline me-2">
                                                ₹{item.products.product_price}
                                            </h5>
                                            {/* Discounted Price */}
                                            <h5 className="d-inline text-danger">
                                                ₹{item.products.product_discounted_price}
                                            </h5>
                                            {/* Discount Amount */}
                                            <span className="badge bg-success ms-2">
                                                -₹{item.products.product_price - item.products.product_discounted_price}
                                            </span>
                                        </>
                                    )}
                                    {/* If no discount exists */}
                                    {item.products.product_price <= item.products.product_discounted_price && (
                                        <h5>₹{item.products.product_price}</h5>
                                    )}
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
                            <h5>- ₹{cart_amounts.product_discount}</h5>
                        </div>
                        {cod_response == 'Y' && paymentMode == 'Cash On Delivery' &&
                            <div className="d-flex justify-content-between">
                                <h5>Cod Charges:</h5>
                                <h5>₹{cod_charges}</h5>
                            </div>}

                        <div className="d-flex justify-content-between">
                            <h5>Shipping:</h5>
                            <h5>₹{parseFloat(shippingAmount).toFixed(2)}</h5>
                        </div>
                        <div className="d-flex justify-content-between">
                            <h5>Gst:</h5>
                            <h5>₹{totalGst}</h5>
                        </div>
                        <div className="d-flex justify-content-between">
                            <h5 className="text-success">Total Savings:</h5>
                            <h5 className="text-success">₹{savings}</h5>
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
                    <input type="hidden" name="shipping_amount" value={shippingAmount} />
                    <input type="hidden" name="txnid" value={increment_id || ""} />
                    <input type="hidden" name="shipping_charges" value={JSON.stringify(shipping_charges || {})} />
                    <input type="hidden" name="shipping_id" value={shippingAddressId} />
                    {/* Shipping Details */}
                    <div className="card mb-4">
                        <div className="card-header">
                            <h4>Shipping Details &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <Link
                                    href="/shippingaddress/index"
                                    method="get"
                                    as="button"
                                    className="btn btn-outline-info"
                                >
                                    Edit / Add Shipping Address
                                </Link>
                            </h4>
                        </div>
                        <div className="card-body">
                            {shipping_addresses.map((address) => {
                                return (<div style={{ display: 'flex', flexDirection: 'row' }}>
                                    <input onClick={() => {
                                        setShippingAddressId(address.shipping_address_id);
                                        handleAddressChange(address.shipping_address_id);
                                    }} type="radio" className="me-4" name="shipping_address" checked={address.shipping_address_id == shippingAddressId} />
                                    <div>
                                        <p><strong>Name:</strong> {address.shipping_full_name}</p>
                                        <p><strong>Mobile:</strong> {address.shipping_mobile_no}</p>
                                        <p><strong>Address:</strong> {`${address.shipping_address_line1}, ${address.shipping_address_line2}, ${address.shipping_city}, ${address.shipping_state}, ${address.shipping_pincode}`}</p>
                                    </div>
                                </div>)
                            })}

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
                                        disabled={mode.payment_mode_name == "Cash On Delivery" && cod_response == 'N'}
                                        className="form-check-input"
                                        type="radio"
                                        name="paymentmode"
                                        id={`paymentMode${mode.payment_mode_id}`}
                                        value={mode.payment_mode_name}
                                        defaultChecked={mode.default_selected === 1}
                                        onClick={() => setPaymentMode(mode.payment_mode_name)}
                                    />
                                    <label className="form-check-label" htmlFor={`paymentMode${mode.payment_mode_id}`}>
                                        {mode.payment_mode_name == 'Cash On Delivery' && cod_response == 'N' ? cod_rmk : mode.payment_mode_name}
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
