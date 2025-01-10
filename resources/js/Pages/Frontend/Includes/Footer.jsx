import { Link, usePage } from "@inertiajs/react";
import React from "react";
import InputError from "@/Components/InputError";
import { useForm } from "@inertiajs/react";
import { useState } from "react";

export default function Footer() {
    const { data, setData, post, processing, errors } = useForm({
        email: ''
    })
    const auth= usePage().props.auth;
    const quicklinks = usePage().props.auth.quick_links;
    function submit(e) {
        e.preventDefault()
        post(route('newsletter.subscribe'), { preserveScroll: 'errors' })
    }

    return (
        <footer className="footer">
            <div className="container">
                <div className="row">
                    <div className="col-sm-12 col-md-12 col-lg-4">
                        <div className="footer-about">
                            <a className="navbar-brand" href="/"><img className="logo" src={"/assets/images/" + auth.logo_path} alt="Logo" /></a>
                            <h3>
                                Handmade
                                <br />
                                nutritional products delivered with love.
                            </h3>
                        </div>
                    </div>
                    <div className="col-sm-12 col-md-12 col-lg-2">
                        <div className="footer-content">
                            <h4 className="mb-3">Quick Links</h4>
                            <ul>
                                <li>
                                    <a href={route("home")}>Home </a>
                                </li>
                                <li>
                                    <a href="/products">Products</a>
                                </li>
                                <li>
                                    <Link href="/contact-us">
                                        Contact Us
                                    </Link>
                                </li>
                                {quicklinks.map((link) =>
                                    <li>
                                        <Link as="a" href={"/view-page/" + link.cms_slug}>
                                            {link.cms_pages_title}
                                        </Link>
                                    </li>)}
                            </ul>

                        </div>

                    </div>
                    <div className="col-sm-12 col-md-12 col-lg-6">
                        <div className="footer-content">
                            <h4 className="mb-3">Get In Touch</h4>
                            <p>
                                Email:{" "}
                                <a href="mailto:care@jaccha.com">
                                    care@jaccha.com
                                </a>
                            </p>
                            <p>
                                Phone:{" "}
                                <a href="tel:+91 9876543210">+91 9876543210</a>
                            </p>
                            <p>
                                Address:
                                <a href="mailto:care@jaccha.com">
                                    {" "}
                                    Mumbai, Maharashtra, India
                                </a>
                            </p>
                        </div>
                        <div className="footer-content mt-4">
                            <h4 className="mb-3">
                                Subscribe to our Newsletter
                            </h4>
                            <div className="newsletter d-flex align-items-center">
                                <input onChange={(e) => setData('email', e.target.value)} value={data.email} type="email" placeholder="Email address here..." id="email" />

                                <button className="submit" id="subscribe-btn" type="button" onClick={submit}>
                                    Subscribe <i className="fal fa-long-arrow-right"></i>
                                </button>

                                <div className="footer-image">
                                    <img src="/assets/images/footer.png" />
                                </div>
                            </div>
                            <InputError message={errors.email} />
                        </div>
                    </div>
                </div>
                <div className="footer-bottom">
                    <div className="copy-text">
                        <p>© 2024 Jaccha. All Rights Reserved.</p>
                    </div>
                    <div className="social-text">
                        <p>
                            <a href="">Facebook</a>
                        </p>
                        <p>
                            <a href="">Instagram</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    );
}
