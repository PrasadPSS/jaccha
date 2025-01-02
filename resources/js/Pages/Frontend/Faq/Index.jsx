import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Link, router, useForm, usePage } from '@inertiajs/react';
import { Transition } from '@headlessui/react';
import UserMenu from '@/Layouts/UserMenu';
import { useState } from 'react';
import axios from 'axios';

export default function UpdateProfileInformation() {
    const auth = usePage().props.auth;

    return (<UserMenu auth={auth} activeTab={'faq'}>

<div
                  className="tab-pane fade show active"
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
                </div>
    </UserMenu>);
}





