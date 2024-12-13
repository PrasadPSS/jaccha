import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import HomeLayout from '@/Layouts/HomeLayout';
import { Head, Link, router } from '@inertiajs/react';
import React from 'react';

export default function ViewOrder({ auth, orders }) {
    console.log(orders);

    return (
        <HomeLayout auth={auth}>
            <div className="container mt-5">
                <h1 className="mb-4">My Orders</h1>
                {orders.length === 0 ? (
                    <div className="alert alert-warning">No orders found!</div>
                ) : (
                    <div className="accordion" id="ordersAccordion">
                        {orders.map((order, index) => (
                            <div className="accordion-item" key={order.order_id}>
                                
                                <h2 className="accordion-header" id={`heading-${index}`}>
                                    <button
                                        className={`accordion-button ${index !== 0 ? "collapsed" : ""}`}
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target={`#collapse-${index}`}
                                        aria-expanded={index === 0 ? "true" : "false"}
                                        aria-controls={`collapse-${index}`}
                                    >
                                        Order #{order.orders_counter_id} - {order.orderproducts.length}{" "}
                                        Product(s)
                                    </button>
                                </h2>
                                <div
                                    id={`collapse-${index}`}
                                    className={`accordion-collapse collapse ${index === 0 ? "show" : ""}`}
                                    aria-labelledby={`heading-${index}`}
                                    data-bs-parent="#ordersAccordion"
                                >
                                    <div><Link href={'/orders/viewinvoice/' + order.order_id}>View Invoice</Link></div>
                                    <div className="accordion-body">
                                        <h5>Order Details</h5>
                                        <ul className="list-group mb-3">
                                            <li className="list-group-item">
                                                <strong>Order ID:</strong> {order.orders_counter_id}
                                            </li>
                                            <li className="list-group-item">
                                                <strong>Total:</strong> ₹{order.total}
                                            </li>
                                            <li className="list-group-item">
                                                <strong>Payment Mode:</strong> {order.payment_mode.toUpperCase()}
                                            </li>
                                            <li className="list-group-item">
                                                <strong>Status:</strong>{" "}
                                                {
                                                    order.delivered_stage
                                                        ? "Delivered"
                                                        : order.out_of_delivery_stage
                                                            ? "Out for Delivery"
                                                            : order.shipped_stage
                                                                ? "Shipped"
                                                                : order.preparing_order_stage
                                                                    ? "Preparing Order"
                                                                    : order.confirmed_stage
                                                                        ? "Confirmed"
                                                                        : "Pending"
                                                }

                                            </li>
                                            <li className="list-group-item">
                                                <strong>Confirmed Date:</strong>{" "}
                                                {order.confirmed_date ? order.confirmed_date : "Not yet confirmed"}
                                            </li>
                                        </ul>

                                        <h5>Shipping Details</h5>
                                        <ul className="list-group mb-3">
                                            <li className="list-group-item">
                                                <strong>Name:</strong> {order.shipping_full_name}
                                            </li>
                                            <li className="list-group-item">
                                                <strong>Mobile:</strong> {order.shipping_mobile_no}
                                            </li>
                                            <li className="list-group-item">
                                                <strong>Address:</strong>{" "}
                                                {`${order.shipping_address_line1}, ${order.shipping_address_line2}, ${order.shipping_city}, ${order.shipping_state}, ${order.shipping_pincode}`}
                                            </li>
                                        </ul>

                                        <h5>Product Details</h5>
                                        <table className="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {order.orderproducts.map((product) => (
                                                    <tr key={product.orders_product_details_id}>
                                                        <td>{product.product_title}</td>
                                                        <td>₹{product.product_price}</td>
                                                        <td>{product.qty}</td>
                                                        <td>₹{product.product_price * product.qty}</td>
                                                    </tr>
                                                ))}
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                )}
            </div>
        </HomeLayout>
    );
};


