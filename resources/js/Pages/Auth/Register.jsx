import { useEffect } from 'react';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';
import HomeLayout from '@/Layouts/HomeLayout';

export default function Register({ auth }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    useEffect(() => {
        return () => {
            reset('password', 'password_confirmation');
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();

        post(route('register'));
    };

    return (
        <HomeLayout auth={auth}>
            <section className="login-sec section">
                <div className="container">
                    <h2 data-aos="fade-right" data-aos-duration="2000">Enjoy exclusive deals & track your orders</h2>
                    <div className="row g-5">
                        <div className="col-lg-6" data-aos="fade-right" data-aos-duration="2000">
                            <div className="login-img create-acc">
                                <img src="./assets/images/login/dots.png" alt="Jaccha Website Element" className="img-fluid dots-img d-i1" loading="lazy" />
                                <div className="laddo-img-wrap">
                                <img src="./assets/images/login/laddoo.png" alt="Jaccha Website Element" className="img-fluid laddo-img" loading="lazy" />
                                </div>
                                <img src="./assets/images/login/dots.png" alt="Jaccha Website Element" className="img-fluid dots-img d-i2" loading="lazy" />
                            </div>
                        </div>
                    
                    <div className="col-lg-6" data-aos="fade-left" data-aos-duration="2000">
                        <div className="login-form">
                            <h3>Create an account</h3>
                            <p>Please enter your details to create an account.</p>
                            <form onSubmit={submit}>
                                <div className="mb-3 mt-4">
                                    <input type="text" className="form-control" id="firstName" placeholder="First Name*" onChange={(e) => setData('firstName', e.target.value)} />
                                    <InputError message={errors.firstName} className="mt-2" />
                                </div>
                                <div className="mb-3">
                                    <input type="text" className="form-control" id="lastName" placeholder="Last Name*" onChange={(e) => setData('lastName', e.target.value)} />
                                    <InputError message={errors.lastName} className="mt-2" />
                                </div>
                                <div className="mb-3">
                                    <input type="email" className="form-control" id="emailId" placeholder="E-mail Address*" onChange={(e) => setData('email', e.target.value)} />
                                    <InputError message={errors.email} className="mt-2" />
                                </div>
                                <div className="mb-3">
                                    <input onChange={(e) => setData('phoneNo', e.target.value)} type="number" className="form-control" id="emailId" placeholder="Phone No*"  />
                                    <InputError message={errors.phoneNo} className="mt-2" />
                                </div>

                                <div className="mb-3">
                                    <input type="password" className="form-control" id="password" placeholder="Password*" onChange={(e) => setData('password', e.target.value)} />
                                    <InputError message={errors.password} className="mt-2" />
                                    
                                     Note: 'The password must be at least 10 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character (e.g., @$!%*?&).',
                                </div>
                                <div className="mb-3">
                                    <input onChange={(e) => setData('password_confirmation', e.target.value)} type="password" className="form-control" id="passoword" placeholder="Confirm Password*" />
                                    <InputError message={errors.password_confirmation} className="mt-2" />
                                </div>

                                <div className="mb-4">
                                    <button type='submit'  className="login-btn">Create an Account</button>
                                </div>

                            </form>

                            <h4 className="mt-4 py-2">Already have an account?</h4>

                            <Link href={route('login')} className="create-acc-btn">Login</Link>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </HomeLayout >
    );
}
