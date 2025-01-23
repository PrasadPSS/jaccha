import { getCsrfToken } from '@/Helpers/getCsrfToken';
import HomeLayout from '@/Layouts/HomeLayout';
import { Link, usePage } from '@inertiajs/react';
import { useState } from 'react';

export default function ResetPassword({ shipping_address }) {
    let token1 =  usePage().props.auth.csrf_token;
    const auth = usePage().props.auth;

    const queryParameters = new URLSearchParams(window.location.search);
    const token = queryParameters.get("token");
    const email = queryParameters.get("email");
    return (
        <HomeLayout auth={auth}>
            <section className="login-sec section">
                <div className="container">
                    <h2 data-aos="fade-right" data-aos-duration="2000">Enjoy exclusive deals & track your orders</h2>
                    <div className="row g-5">
                        <div className="col-lg-6" data-aos="fade-right" data-aos-duration="2000">
                            <div className="login-img create-acc">
                                <img src="/assets/images/login/dots.png" alt="Jaccha Website Element" className="img-fluid dots-img d-i1" loading="lazy" />
                                <div className="laddo-img-wrap"><img src="/assets/images/login/laddoo.png" alt="Jaccha Website Element" className="img-fluid laddo-img" loading="lazy"/></div>
                                <img src="/assets/images/login/dots.png" alt="Jaccha Website Element" className="img-fluid dots-img d-i2" loading="lazy" />
                            </div>
                        </div>
                        <div className="col-lg-6" data-aos="fade-left" data-aos-duration="2000">
                            <div className="login-form">
                                <h3>Set New Password</h3>
                               
                                <p>Please set a new password for your account.</p>
                                <form action={route('profile.updatepassword')} method="post">
                                    <input type="hidden" name="_token" value={token1} />
                                    <input type="hidden" name='token' id='token' value={token}/>
                                    <input type="hidden" name="email" id="email" value={email} />
                                    <div className="mb-3 mt-4">
                                        <input type="password" className="form-control" id="password" name='password' placeholder="Enter New Password*" />
                                    </div>
                                    <div className="mb-3">
                                        <input type="password" className="form-control" id="confirm_password" name='confirm_password' placeholder="Confirm New Password*" />
                                    </div>
                                    <div className="mb-4" >
                                        <button href={route('profile.updatepassword')} className="login-btn">Set Password</button>
                                    </div>

                                </form>

                                <h4 className="mt-4 py-2">Already have an account?</h4>

                                <a href={route('login')} className="create-acc-btn">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </HomeLayout>
    );
}





