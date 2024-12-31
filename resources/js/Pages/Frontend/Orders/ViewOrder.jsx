import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import HomeLayout from '@/Layouts/HomeLayout';
import convertToShortDateFormat from '@/Helpers/date';
import UserMenu from '@/Layouts/UserMenu';
import { Head, Link, router } from '@inertiajs/react';
import React from 'react';

export default function ViewOrder({ auth, orders }) {


    return (
        <UserMenu auth={auth} activeTab={'orders'}>
            <div
                className="tab-pane fade show active"
                id="pills-third"
                role="tabpanel"
                aria-labelledby="pills-third-tab"
            >
                <div className="account-right-content">
                    <div className="details-heading px-4 py-3">
                        <h3>My Orders</h3>
                    </div>
                    {orders.length === 0 ? (<div>No Orders Found</div>) :

                        orders.map((order, index) => (
                            <div className="order_boxes">
                                <div className="order_heading">
                                    <p>Ordered Id : <b>#{order.orders_counter_id}</b></p>
                                    { }
                                    <p>Ordered Placed Date : <b>{new Date(order.created_at).getDate() + '-' + new Date(order.created_at).getMonth() + '-' + new Date(order.created_at).getFullYear()}</b></p>
                                    <p>
                                        <span className={order.delivered_stage ? "sts_delivered":'sts_confirmed'}
                                        >Order Status :  {
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
                                        </span>
                                    </p>
                                    <Link as='button' className="black button" href={'/orders/viewinvoice/' + order.order_id}>View Invoice</Link>
                                </div>
                                <div className="order_content">
                                    <div className="checkout-product">
                                        <div className="checkout-product_details d-flex">
                                            <div className="checkout-product_img position-relative">
                                                <img
                                                    src="/assets/images/product-details/products-details-3.jpg"
                                                    alt=""
                                                />
                                                <p>{order.orderproducts[0].qty}</p>
                                            </div>
                                            <div className="checkout-product_content">
                                                <h5>{order.orderproducts[0].product_title}</h5>
                                                {/* <p>1kg | Medium Sweetness | Almonds | No Ghee</p> */}
                                                <p>₹{order.orderproducts[0].product_price}.00</p>
                                            </div>
                                        </div>
                                        <div className="delivery-date">
                                            <h5>Delivery Date</h5>
                                            <p><b>{(() => {
                                                const createdAt = new Date(order.created_at);
                                                createdAt.setDate(createdAt.getDate() + 7);
                                                return (
                                                    createdAt.getDate() +
                                                    '-' +
                                                    (createdAt.getMonth() + 1) +
                                                    '-' +
                                                    createdAt.getFullYear()
                                                );
                                            })()}</b></p>
                                        </div>
                                        <div className="order_button">
                                            <Link method="get" href={route('order.details')} data={{order_id: order.order_id}}
                                            ><button>View Order</button>
                                            </Link>

                                            <Link as='button' href={'/product/view/' + order.orderproducts[0].product_id} className="buy-again mt-2">Buy Again</Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))
                    }

                </div>
            </div>
        </UserMenu>
    );
};


