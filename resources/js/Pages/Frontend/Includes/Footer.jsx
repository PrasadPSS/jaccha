import { Link } from "@inertiajs/react";
import React from "react";


export default function Footer() {
    return (
        <footer className="footer">
            <div className="container">
                <div className="row">
                    <div className="col-sm-4">
                        <div className="footer-about">
                            <a className="navbar-brand" href="index.html"><img className="logo" src="/assets/images/logo.png" alt="Logo" /></a>
                            <h3>
                                Handmade<br />
                                nutritional products delivered with love.
                            </h3>
                        </div>
                    </div>
                    <div className="col-sm-2">
                        <div className="footer-content">
                            <h4 className="mb-3">Quick Links</h4>
                            <ul>
                                <li><a href={route('home')} >Home </a></li>
                                <li><Link href="/view-page/about-us" >About Us</Link></li>
                                <li><a href="/products">Products</a></li>
                                <li><Link href="/view-page/contact-us" >Contact Us</Link></li>
                                <li><Link href="/view-page/privacy-policy" >Privacy Policy</Link></li>
                                <li><Link href="/view-page/terms-and-conditions" >Terms & Condition</Link></li>
                                <li><Link href="/view-page/cancellation-policy">Cancellation Policy</Link></li>
                            </ul>
                        </div>
                    </div>
                    <div className="col-sm-6">
                        <div className="footer-content">
                            <h4 className="mb-3">Get In Touch</h4>
                            <p>Email: <a href="mailto:care@jaccha.com">care@jaccha.com</a></p>
                            <p>Phone: <a href="tel:+91 9876543210">+91 9876543210</a></p>
                            <p>
                                Address:
                                <a href="mailto:care@jaccha.com"> Mumbai, Maharashtra, India</a>
                            </p>
                        </div>
                        <div className="footer-content mt-4">
                            <h4 className="mb-3">Subscribe to our Newsletter</h4>
                            <div className="newsletter d-flex align-items-center">
                                <input type="email" placeholder="Email address here..." id="email" />
                                <button className="submit" id="subscribe-btn">
                                    Subscribe <i className="fal fa-long-arrow-right"></i>
                                </button>
                                <div className="footer-image">
                                    <img src="/assets/images/footer.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="footer-bottom">
                    <div className="copy-text">
                        <p>© 2024 Jaccha. All Rights Reserved.</p>
                    </div>
                    <div className="social-text">
                        <p><a href="">Facebook</a></p>
                        <p><a href="">Instagram</a></p>
                    </div>
                </div>
            </div>
        </footer>
    );
};

