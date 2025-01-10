import { getCsrfToken } from '@/Helpers/getCsrfToken';
import HomeLayout from '@/Layouts/HomeLayout';
import { Link, usePage } from '@inertiajs/react';
import { useState } from 'react';

export default function ForgotPassword({ shipping_address }) {
    let token = await getCsrfToken();
    const auth = usePage().props.auth;
    const [email, setEmail] = useState("");
    const handleEmailChange =(e)=>{
        setEmail(e.target.value);
    };
    return (
        <HomeLayout auth={auth}>
            <section className="login-sec section">
                <div className="container">
                    <h2 data-aos="fade-right" data-aos-duration="2000">Enjoy exclusive deals & track your orders</h2>
                    <div className="row g-5">
                        <div className="col-lg-6" data-aos="fade-right" data-aos-duration="2000">
                            <div className="login-img">
                                <img src="/assets/images/login/dots.png" alt="Jaccha Website Element" className="img-fluid dots-img d-i1" loading="lazy" />
                                <div className="laddo-img-wrap"><img src="/assets/images/login/laddoo.png" alt="Jaccha Website Element" className="img-fluid laddo-img" loading="lazy" /></div>
                                <img src="/assets/images/login/dots.png" alt="Jaccha Website Element" className="img-fluid dots-img d-i2" loading="lazy" />
                            </div>
                        </div>
                        <div className="col-lg-6" data-aos="fade-left" data-aos-duration="2000">
                            <div className="login-form">
                                <h3>Reset Password</h3>
                                <p>Enter your email and we will send you a reset link.</p>
                                <form action="">
                                    <div className="mb-4 mt-4">
                                        <input onChange={handleEmailChange} type="email" className="form-control" id="email" name="email" placeholder="Enter E-mail Address*" required/>
                                    </div>

                                    <div className="mb-5 pt-1">
                                        <Link as='button' method="post" href={route('profile.sendresetlink')} data={{email: email, _token: token}} className="login-btn">Send Reset Password</Link>
                                    </div>

                                </form>

                                <h4 className="mt-4 pt-3 pb-2">I remember my password</h4>

                                <a href="login.html" className="create-acc-btn">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </HomeLayout>
    );
}





