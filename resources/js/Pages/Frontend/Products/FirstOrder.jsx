import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import HomeLayout from '@/Layouts/HomeLayout';
import { Head } from '@inertiajs/react';

export default function FirstOrder() {
    return (
        <section className="product-first-order">
            <div className="container">
                <div className="row">
                    <div className="col-sm-2">
                        <div className="first-order-image" data-aos="fade-up" data-aos-delay="200">
                            <img src="/assets/images/about.png" alt="about image" />
                        </div>
                    </div>
                    <div className="col-sm-8 text-center">
                        <div className="about-what-content" data-aos="fade-up" data-aos-delay="1000">
                            <h2>Get 25% Off On Your First Order !</h2>
                        </div>
                    </div>
                    <div className="col-sm-2">
                        <div className="flip-image" data-aos="fade-up" data-aos-delay="400">
                            <img src="/assets/images/banner.png" alt="about image" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
