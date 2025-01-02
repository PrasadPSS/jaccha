import { Head, Link } from "@inertiajs/react";
import React from "react";
import HomeLayout from "./HomeLayout";

export default function UserMenu({ children, auth, activeTab }) {
    return (
        <HomeLayout auth={auth}>

            <section className="myaccount bg-light pt-5 pb-5">
                <div className="container">
                    <div className="row">
                        <div className="col-sm-3">
                            <div className="account-list">
                                <ul
                                    className="nav nav-pills flex-column nav-pills"
                                    id="pills-tab"
                                    role="tablist"
                                >
                                    <li className="nav-item" role="presentation">
                                        <Link
                                            as="button"
                                            className={activeTab == 'account' ? "nav-link active position-relative" : "nav-link position-relative"}
                                            id="pills-first-tab"
                                            href={route('profile.viewBasic')}
                                            data-bs-toggle="pill"
                                            data-bs-target="#pills-first"
                                            type="button"
                                            role="tab"
                                            aria-controls="pills-first"
                                            aria-selected={activeTab == 'account'}
                                        >
                                            My Account
                                        </Link>
                                    </li>
                                    <li className="nav-item" role="presentation">
                                        <Link
                                            as="button"
                                            href={route('profile.view')}
                                            className={activeTab == 'profile' ? "nav-link active position-relative" : "nav-link position-relative"}
                                            id="pills-second-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#pills-second"
                                            type="button"
                                            role="tab"
                                            aria-controls="pills-second"
                                            aria-selected={activeTab == 'profile'}
                                        >
                                            Personal & Address Details
                                        </Link>
                                    </li>
                                    <li className="nav-item" role="presentation">
                                        <Link
                                            as="button"
                                            href={route('order.index')}
                                            className={activeTab == 'orders' ? "nav-link active position-relative" : "nav-link position-relative"}
                                            id="pills-third-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#pills-third"
                                            type="button"
                                            role="tab"
                                            aria-controls="pills-third"
                                            aria-selected={activeTab == 'orders'}
                                        >
                                            My Orders
                                        </Link>
                                    </li>
                                    <li className="nav-item" role="presentation">
                                        <Link
                                            as="button"
                                            href={route('wishlist.index')}

                                            className={activeTab == 'wishlist' ? "nav-link active position-relative" : "nav-link position-relative"}
                                            id="pills-fourth-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#pills-fourth"
                                            type="button"
                                            role="tab"
                                            aria-controls="pills-fourth"
                                            aria-selected={activeTab == 'wishlist'}
                                        >
                                            Wishlist's
                                        </Link>
                                    </li>

                                    <li className="nav-item" role="presentation">
                                        <button
                                            className="nav-link position-relative"
                                            id="pills-fifth-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#pills-fifth"
                                            type="button"
                                            role="tab"
                                            aria-controls="pills-fifth"
                                            aria-selected="false"
                                        >
                                            Need Help?
                                        </button>
                                    </li>
                                    {/* <li className="nav-item" role="presentation">
                                    <button
                                        className="nav-link position-relative"
                                        id="pills-sixth-tab"
                                        data-bs-toggle="pill"
                                        data-bs-target="#pills-sixth"
                                        type="button"
                                        role="tab"
                                        aria-controls="pills-sixth"
                                        aria-selected="false"
                                    >
                                        Change Password
                                    </button>
                                </li> */}
                                    <li className="nav-item" role="presentation">
                                        <Link
                                            method="post"
                                            href={route('logout')}
                                            as="button"
                                            className="nav-link position-relative"
                                            id="pills-seventh-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#pills-seventh"
                                            type="button"
                                            role="tab"
                                            aria-controls="pills-seventh"
                                            aria-selected="false"
                                        >
                                            Logout
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div className="col-sm-9">
                            <div className="account-details">
                                <div className="tab-content w-100" id="pills-tabContent">
                                    {children}
                                    {/* <div
                                    className="tab-pane fade show active"
                                    id="pills-first"
                                    role="tabpanel"
                                    aria-labelledby="pills-first-tab"
                                >
                                    <div className="account-right-content d-flex p-4">
                                        <div className="contact_details">
                                            <p>Name: Deepali Gopal Mane</p>
                                            <p>Mail: manedeepali98@gmail.com</p>
                                            <p>Phone: +91 9874589965</p>
                                        </div>
                                        <div className="contact_details">
                                            <p>
                                                Deepali Mane<br />Arihant Anmol<br />Badlapur 421503<br />Maharashtra,
                                                India
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    className="tab-pane fade"
                                    id="pills-second"
                                    role="tabpanel"
                                    aria-labelledby="pills-second-tab"
                                >
                                    <div className="account-right-content">
                                        <div className="details-heading px-4 py-3">
                                            <h3>Personal Details</h3>
                                        </div>
                                        <div className="contact_details p-4">
                                            <p>Name: Deepali Gopal Mane</p>
                                            <p>Mail: manedeepali98@gmail.com</p>
                                            <p>Phone: +91 9874589965</p>
                                        </div>
                                    </div>
                                    <div className="account-right-content mt-4">
                                        <div
                                            className="details-heading px-4 py-3 d-flex align-items-center"
                                        >
                                            <h3>Address Details</h3>
                                            <button
                                                type="button"
                                                className="btn add-new-address-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"
                                            >
                                                <i className="fas fa-plus-circle"></i> Add New Address
                                            </button>
                                        </div>
                                        <div className="d-flex g-4">
                                            <div className="contact_details p-4">
                                                <p>Name: Deepali Gopal Mane</p>
                                                <p>Mail: manedeepali98@gmail.com</p>
                                                <p>Phone: +91 9874589965</p>
                                            </div>
                                            <div className="contact_details p-4">
                                                <p>Name: Deepali Gopal Mane</p>
                                                <p>Mail: manedeepali98@gmail.com</p>
                                                <p>Phone: +91 9874589965</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    className="tab-pane fade"
                                    id="pills-third"
                                    role="tabpanel"
                                    aria-labelledby="pills-third-tab"
                                >
                                    <div className="account-right-content">
                                        <div className="details-heading px-4 py-3">
                                            <h3>My Orders</h3>
                                        </div>
                                        <div className="order_boxes">
                                            <div className="order_heading">
                                                <p>Ordered Id : <b>#89473777</b></p>
                                                <p>Ordered Placed Date : <b>09-10-2024</b></p>
                                                <p>
                                                    <span className="sts_delivered"
                                                    >Order Status : Delivered</span
                                                    >
                                                </p>
                                                <button className="black button">View Invoice</button>
                                            </div>
                                            <div className="order_content">
                                                <div className="checkout-product">
                                                    <div className="checkout-product_details d-flex">
                                                        <div className="checkout-product_img position-relative">
                                                            <img
                                                                src="./assets/images/product-details/products-details-3.jpg"
                                                                alt=""
                                                            />
                                                            <p>3</p>
                                                        </div>
                                                        <div className="checkout-product_content">
                                                            <h5>Dana Methi Laddoo</h5>
                                                            <p>1kg | Medium Sweetness | Almonds | No Ghee</p>
                                                            <p>₹750.00</p>
                                                        </div>
                                                    </div>
                                                    <div className="delivery-date">
                                                        <h5>Delivery Date</h5>
                                                        <p><b>11-10-2024</b></p>
                                                    </div>
                                                    <div className="order_button">
                                                        <a href="view-order.html"
                                                        ><button>View Order</button></a
                                                        >

                                                        <button className="buy-again mt-2">Buy Again</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div className="order_boxes">
                                            <div className="order_heading">
                                                <p>Ordered Id : <b>#89473777</b></p>
                                                <p>Ordered Placed Date : <b>09-10-2024</b></p>
                                                <p>
                                                    <span className="sts_confirmed"
                                                    >Order Status : Confirmed</span
                                                    >
                                                </p>
                                                <button className="black button">View Invoice</button>
                                            </div>
                                            <div className="order_content">
                                                <div className="checkout-product">
                                                    <div className="checkout-product_details d-flex">
                                                        <div className="checkout-product_img position-relative">
                                                            <img
                                                                src="./assets/images/product-details/products-details-3.jpg"
                                                                alt=""
                                                            />
                                                            <p>3</p>
                                                        </div>
                                                        <div className="checkout-product_content">
                                                            <h5>Dana Methi Laddoo</h5>
                                                            <p>1kg | Medium Sweetness | Almonds | No Ghee</p>
                                                            <p>₹750.00</p>
                                                        </div>
                                                    </div>
                                                    <div className="delivery-date">
                                                        <h5>Delivery Date</h5>
                                                        <p><b>11-10-2024</b></p>
                                                    </div>
                                                    <div className="order_button">
                                                        <a href="view-order.html"
                                                        ><button>View Order</button></a
                                                        >

                                                        <button className="buy-again mt-2 cancel-order">
                                                            Cancel Order
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div className="order_boxes">
                                            <div className="order_heading">
                                                <p>Ordered Id : <b>#89473777</b></p>
                                                <p>Ordered Placed Date : <b>09-10-2024</b></p>
                                                <p>
                                                    <span className="sts_confirmed"
                                                    >Order Status : Confirmed</span
                                                    >
                                                </p>
                                                <button className="black button">View Invoice</button>
                                            </div>
                                            <div className="order_content">
                                                <div className="checkout-product">
                                                    <div className="checkout-product_details d-flex">
                                                        <div className="checkout-product_img position-relative">
                                                            <img
                                                                src="./assets/images/product-details/products-details-3.jpg"
                                                                alt=""
                                                            />
                                                            <p>3</p>
                                                        </div>
                                                        <div className="checkout-product_content">
                                                            <h5>Dana Methi Laddoo</h5>
                                                            <p>1kg | Medium Sweetness | Almonds | No Ghee</p>
                                                            <p>₹750.00</p>
                                                        </div>
                                                    </div>
                                                    <div className="delivery-date">
                                                        <h5>Delivery Date</h5>
                                                        <p><b>11-10-2024</b></p>
                                                    </div>
                                                    <div className="order_button">
                                                        <a href="view-order.html"
                                                        ><button>View Order</button></a
                                                        >
                                                        <button className="buy-again mt-2 cancel-order">
                                                            Cancel Order
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                               

                                <div
                                    className="tab-pane fade"
                                    id="pills-fifth"
                                    role="tabpanel"
                                    aria-labelledby="pills-fifth-tab"
                                >
                                    <div className="account-right-content">
                                        <div className="details-heading px-4 py-3">
                                            <h3>Need Help?</h3>
                                        </div>
                                        <div className="contact_details p-4 need-help">
                                            <div className="accordion" id="accordionExample">
                                                <div className="accordion-item">
                                                    <h2 className="accordion-header">
                                                        <button
                                                            className="accordion-button collapsed"
                                                            type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne"
                                                            aria-expanded="true"
                                                            aria-controls="collapseOne"
                                                        >
                                                            <span>Orders & Delivery</span> <br />
                                                            <p>
                                                                Looking for help with your order or have a
                                                                question regarding delivery?
                                                            </p>
                                                        </button>
                                                    </h2>
                                                    <div
                                                        id="collapseOne"
                                                        className="accordion-collapse collapse"
                                                        data-bs-parent="#accordionExample"
                                                    >
                                                        <div className="accordion-body">
                                                            <div className="accoridan-in-box mb-4">
                                                                <h4>How can I track my order?</h4>
                                                                <p>
                                                                    After your order is shipped, you’ll receive a
                                                                    tracking link via email or SMS. Click the link
                                                                    to view your package's current status.
                                                                    Alternatively, you can log in to your account,
                                                                    go to the "Orders" section, and track your
                                                                    shipment.
                                                                </p>
                                                            </div>
                                                            <div className="accoridan-in-box mb-4">
                                                                <h4>What is the estimated delivery time?</h4>
                                                                <p>
                                                                    Delivery usually takes 3-5 business days
                                                                    within major cities and up to 7 days for
                                                                    remote areas. You can check the estimated
                                                                    delivery date on the product page or during
                                                                    checkout.
                                                                </p>
                                                            </div>
                                                            <div className="accoridan-in-box">
                                                                <h4>
                                                                    Can I change my delivery address after placing
                                                                    an order?
                                                                </h4>
                                                                <p>
                                                                    Yes, you can update your address within 24
                                                                    hours of placing your order. Please contact
                                                                    our support team immediately with your order
                                                                    details.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div className="accordion-item">
                                                    <h2 className="accordion-header">
                                                        <button
                                                            className="accordion-button collapsed"
                                                            type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseTwo"
                                                            aria-expanded="true"
                                                            aria-controls="collapseTwo"
                                                        >
                                                            <span>Payments and Refunds</span> <br />
                                                            <p>
                                                                Confused about payment methods or need help with
                                                                a refund? Find answers here.
                                                            </p>
                                                        </button>
                                                    </h2>
                                                    <div
                                                        id="collapseTwo"
                                                        className="accordion-collapse collapse"
                                                        data-bs-parent="#accordionExample"
                                                    >
                                                        <div className="accordion-body">
                                                            <div className="accoridan-in-box mb-4">
                                                                <h4>How can I track my order?</h4>
                                                                <p>
                                                                    After your order is shipped, you’ll receive a
                                                                    tracking link via email or SMS. Click the link
                                                                    to view your package's current status.
                                                                    Alternatively, you can log in to your account,
                                                                    go to the "Orders" section, and track your
                                                                    shipment.
                                                                </p>
                                                            </div>
                                                            <div className="accoridan-in-box mb-4">
                                                                <h4>How can I track my order?</h4>
                                                                <p>
                                                                    After your order is shipped, you’ll receive a
                                                                    tracking link via email or SMS. Click the link
                                                                    to view your package's current status.
                                                                    Alternatively, you can log in to your account,
                                                                    go to the "Orders" section, and track your
                                                                    shipment.
                                                                </p>
                                                            </div>
                                                            <div className="accoridan-in-box">
                                                                <h4>How can I track my order?</h4>
                                                                <p>
                                                                    After your order is shipped, you’ll receive a
                                                                    tracking link via email or SMS. Click the link
                                                                    to view your package's current status.
                                                                    Alternatively, you can log in to your account,
                                                                    go to the "Orders" section, and track your
                                                                    shipment.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div className="accordion-item">
                                                    <h2 className="accordion-header">
                                                        <button
                                                            className="accordion-button collapsed"
                                                            type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseThree"
                                                            aria-expanded="true"
                                                            aria-controls="collapseThree"
                                                        >
                                                            <span>Product Customization</span> <br />
                                                            <p>
                                                                Want to customize your order or know more about
                                                                ingredients? Let us guide you
                                                            </p>
                                                        </button>
                                                    </h2>
                                                    <div
                                                        id="collapseThree"
                                                        className="accordion-collapse collapse"
                                                        data-bs-parent="#accordionExample"
                                                    >
                                                        <div className="accordion-body">
                                                            <div className="accoridan-in-box mb-4">
                                                                <h4>How can I track my order?</h4>
                                                                <p>
                                                                    After your order is shipped, you’ll receive a
                                                                    tracking link via email or SMS. Click the link
                                                                    to view your package's current status.
                                                                    Alternatively, you can log in to your account,
                                                                    go to the "Orders" section, and track your
                                                                    shipment.
                                                                </p>
                                                            </div>
                                                            <div className="accoridan-in-box mb-4">
                                                                <h4>How can I track my order?</h4>
                                                                <p>
                                                                    After your order is shipped, you’ll receive a
                                                                    tracking link via email or SMS. Click the link
                                                                    to view your package's current status.
                                                                    Alternatively, you can log in to your account,
                                                                    go to the "Orders" section, and track your
                                                                    shipment.
                                                                </p>
                                                            </div>
                                                            <div className="accoridan-in-box">
                                                                <h4>How can I track my order?</h4>
                                                                <p>
                                                                    After your order is shipped, you’ll receive a
                                                                    tracking link via email or SMS. Click the link
                                                                    to view your package's current status.
                                                                    Alternatively, you can log in to your account,
                                                                    go to the "Orders" section, and track your
                                                                    shipment.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> */}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </HomeLayout>
    );
};

