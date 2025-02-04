import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import HomeLayout from '@/Layouts/HomeLayout';
import { Head } from '@inertiajs/react';

export default function View({ auth, publications }) {

    return (
        <HomeLayout auth={auth}>
            <Head title={publications.publications_title} />
            <div className="sub-banner bg-light">
                <div className="container">
                    <div className="row">
                        <div className="col-sm-12">
                            <div className="banner_heading pb-4">
                                <h2>{publications.publications_title}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section className="section product_listing privacy-policy">
                <div className="container">
                    <div className="row align-items-center">
                        <div className="col-sm-12" dangerouslySetInnerHTML={{ __html: publications.publications_content }}>
                            
                        </div>
                    </div>
                </div>
            </section>


        </HomeLayout>
    );
}
