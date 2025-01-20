
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import HomeLayout from '@/Layouts/HomeLayout';
import UserMenu from '@/Layouts/UserMenu';
import { Head, Link, router, usePage } from '@inertiajs/react';
import React from 'react';

export default function Index({ wishlist }) {

    let token =  usePage().props.auth.csrf_token;;
    const auth = usePage().props.auth;
    const handleAddToCart = (id, quantity = 1) => {
        router.post('/wishlist/add-to-cart', { product_id: id, quantity: quantity }, {
            onSuccess: () => alert('Item added to cart!'),
            onError: (errors) => console.error(errors),
        });
    };

    const handleDeleteFromWishlist = (id, quantity = 1) => {
        router.post('/wishlist/delete', { product_id: id }, {
            onSuccess: () => '',
            onError: (errors) => console.error(errors),
        });
    };

    return (
        <UserMenu auth={auth} activeTab={'wishlist'}>
            {wishlist.length <= 0 &&
                <div
                    className="tab-pane fade active show"
                    id="pills-fourth"
                    role="tabpanel"
                    aria-labelledby="pills-fourth-tab"
                >
                    <div className="my-wishlist">
                        <div className="my-wishlist-box mb-4">
                            <h4>My Wish list</h4>

                        </div>
                        <div className="row align-items-center">

                            <div className="col-md-6">
                                <div className="empty-wishlist-content">
                                    <h2>Your Wish List is Empty!</h2>
                                    <p>
                                        Looks like you haven’t added anything to your wishlist yet.
                                        Start exploring our wide range of products and save your favorites for later!
                                    </p>
                                    <Link as='button' href='/products' className="btn btn-primary">Start Shopping</Link>
                                </div>
                            </div>


                            <div className="col-md-6">
                                <div className="empty-wishlist-image">
                                    <img
                                        src="/assets/images/empty-wishlist.png"
                                        alt="Empty Wishlist Illustration"
                                        className="img-fluid"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>}
            {wishlist.length > 0 && <div
                className="tab-pane fade show active"
                id="pills-fourth"
                role="tabpanel"
                aria-labelledby="pills-fourth-tab"
            >
                <div className="my-wishlist">
                    <div className="my-wishlist-box mb-4">
                        <h4>My Wish list</h4>
                        <Link as='button' method="get" href={route('wishlist.addAllToCart')} className="button">Add all to Basket</Link>
                    </div>

                    <div className="row g-5" data-aos="fade-up">
                        {wishlist.length > 0 && wishlist.map((item, index) => (
                            <Link className="col-sm-4" as='a' href={"/product/view/" + item.products.product_id} key={index}>

                                <div className="feature-box">
                                    <div className="basket-box">
                                        <Link href="/product/addtocart" as='a' method="post" id="addtoBasketButton" data={{ product_id: item.products.product_id, product_type: "simple", product_variant_id: null, quantity: 1, _token: token, sweetnesslevel: 'low', ingrediantaddons: 'NA', exclusions: 'NA' }}>
                                            <i className="fal fa-shopping-basket"></i>
                                        </Link>

                                    </div>

                                    <Link method="post" href={route('wishlist.delete')} data={{ product_id:  item.products.product_id }}>
                                    <i className="fas fa-heart heart"></i>
                                    </Link>
                                    <img
                                        src={'/backend-assets/uploads/product_thumbs/' + item.products.product_thumb}
                                        alt="feature image"
                                    />
                                    <div className="features-content">
                                        <h5>{item.products.product_title}</h5>
                                        <h6>₹{item.products.product_price}.00</h6>
                                    </div>
                                </div>

                            </Link>
                        ))}
                        

                    </div>

                </div>
            </div>}

        </UserMenu>

    );
};


