import { useEffect } from 'react';
import Checkbox from '@/Components/Checkbox';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';
import HomeLayout from '@/Layouts/HomeLayout';

export default function Login({ auth, status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    useEffect(() => {
        return () => {
            reset('password');
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();

        post(route('login'));
    };

    return (
        <HomeLayout auth={auth}>
        <section className="login-sec section">
            <div className="container">
                <h2 data-aos="fade-right" data-aos-duration="2000">Enjoy exclusive deals & track your orders</h2>
                <div className="row g-5">
                    <div className="col-lg-6" data-aos="fade-right" data-aos-duration="2000">
                        <div className="login-img">
                            <img src="/assets/images/login/dots.png" alt="Jaccha Website Element" className="img-fluid dots-img d-i1" loading="lazy"/>
                                <div className="laddo-img-wrap"><img src="/assets/images/login/laddoo.png" alt="Jaccha Website Element" className="img-fluid laddo-img" loading="lazy"/>
                                </div>
                                <img src="/assets/images/login/dots.png" alt="Jaccha Website Element" className="img-fluid dots-img d-i2" loading="lazy"/>
                        </div>
                    </div>
                        <div className="col-lg-6" data-aos="fade-left" data-aos-duration="2000">
                            <div className="login-form">
                                <h3>Login</h3>
                                <p>Please enter your e-mail and password:</p>
                                <form onSubmit={submit}>
                                    <div className="mb-3 mt-4">
                                        <input type="email" className="form-control" id="emailAddrs" placeholder="Enter email address*" onChange={(e) => setData('email', e.target.value)}/>
                                        <InputError message={errors.email} className="mt-2" />
                                    </div>
                                    <div className="mb-3 position-relative">
                                        <input type="password" className="form-control" id="passoword" placeholder="Password*" onChange={(e) => setData('password', e.target.value)}/>
                                        <InputError message={errors.password} className="mt-2" />
                                            <div className="forgt-pass">
                                                <a href={route('profile.forgotPassword')}>Forgot password?</a>
                                            </div>
                                    </div>
                                    <div className="mb-4">
                                        <button type='submit' className="login-btn">Login</button>
                                    </div>

                                </form>

                                <h4 className="mt-4 py-2">Create Account</h4>
                                <ul>
                                    <li>View your order history</li>
                                    <li>Track your order status and shipping</li>
                                    <li>Store multiple delivery addresses</li>
                                </ul>
                                <Link href={route('register')} className="create-acc-btn">Create Account</Link>
                            </div>
                        </div>
                    </div>
                </div>
               
        </section>
        </HomeLayout>
    );
}
