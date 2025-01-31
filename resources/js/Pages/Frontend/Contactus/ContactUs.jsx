import React from "react";
import HomeLayout from "@/Layouts/HomeLayout";
import Banner from "@/Pages/Frontend/Includes/Banner";
import Highlights from "@/Pages/Frontend/Includes/Highlights";
import Benefits from "@/Pages/Frontend/Includes/Benefits";
import Featured from "@/Pages/Frontend/Includes/Featured";
import About from "@/Pages/Frontend/Includes/About";
import Testimonials from "@/Pages/Frontend/Includes/Testimonials";
import { useForm } from "@inertiajs/react";

export default function ContactUs({ auth, company }) {

    const { data, setData, post, processing, errors } = useForm({
        name: '',
        email: '',
        mobile_no: '',
        comment: '',
    })

    function submit(e) {
        e.preventDefault()
        post(route('contactus.store'))
    }

    return (
        <HomeLayout auth={auth}>

            <section className="contact-us-title section">
                <div className="container">
                    <div className="row">
                        <div className="col-lg-9">
                            <div className="contact-us-head">
                                <h2>Get Started - Contact Us</h2>
                                <h1 className="mt-4">Get in touch with us. We're here to assist you.</h1>
                            </div>
                        </div>
                        <div className="col-lg-3">
                            <div className="contact-us-social pt-5">
                                <a href={company.facebook} className="contactSocial">
                                    <i className="ri-facebook-fill"></i>
                                </a>
                                <a href={company.instagram} className="contactSocial my-3">
                                    <i className="ri-instagram-line"></i>
                                </a>
                        
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section className="contact-us-form">
                <div className="container">
                    <div className="col-lg-12">
                        <div className="contact-us-wrapper">
                            <form action="">
                                <div className="container">
                                    <div className="row">
                                        <div className="col-lg-4">
                                            <div className="mb-3">
                                                <input type="text" className="form-control contact" id="name" name="name" placeholder="Your Name" value={data.name} onChange={(e) => setData('name', e.target.value)} />
                                            </div>
                                        </div>
                                        <div className="col-lg-4">
                                            <div className="mb-3">
                                                <input type="email" className="form-control contact" id="email" name="email" placeholder="Email Address" value={data.email} onChange={(e) => setData('email', e.target.value)} />
                                            </div>
                                        </div>
                                        <div className="col-lg-4">
                                            <div className="mb-3">
                                                <input type="number" className="form-control contact" id="mobile_no" name="mobile_no" value={data.mobile_no} onChange={(e) => setData('mobile_no', e.target.value)}
                                                    placeholder="Phone Number (optional)" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="mb-3 mt-4 pt-1">
                                    <textarea className="form-control contact" id="comment" name="comment" rows="5" placeholder="Message" onChange={(e) => setData('comment', e.target.value)}>{data.comment}</textarea>
                                </div>
                                <div className="mb-3">
                                <button onClick={submit} type="button" className="leaveMessage">Leave us a Message <i className="ri-arrow-right-line"></i></button>
                                </div>
                            </form>
                            <p className="dropEmail">Drop us an email with your queries, and we’ll get back to you within 24-48 hours</p>
                        </div>
                    </div>
                </div>
            </section>
            <section className="assistYou section">
                <div className="container">
                    <div className="row">
                        <div className="col-lg-6">
                            <div className="assistYou-sec pe-5">
                                <div className="contact-us-head">
                                    <h2>Contact Info</h2>
                                    <h3>We are always happy to assist you</h3>
                                </div>
                            </div>
                        </div>
                        <div className="col-lg-3">
                            <div className="assistYou-sec">
                                <h5 className="pb-4">Contact Details</h5>
                                <h5 className="my-4"><a href={"mailto:" + company.email}>{company.email}</a></h5>
                                <h5 className="my-4"><a href="tel: +91 9983425622">(+91) {company.mobile_no}</a></h5>

                                
                                </div>
                            </div>
                            <div className="col-lg-3">
                                <div className="assistYou-sec">
                                    <h5 className="pb-4">Office Address</h5>
                                    <h5 className="my-4">{company.address_line1}, {company.address_line2}, <br/>{company.city} -{company.pincode}, {company.state}, {company.country}</h5>
                                  
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
     

                </HomeLayout>
                );
}
