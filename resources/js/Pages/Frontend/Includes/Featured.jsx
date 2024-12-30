import { asset } from "@/Helpers/asset";
import { Link } from "@inertiajs/react";
import React from "react";


export default function Featured({ title, subTitle, sectionChildren, paddingTop, paddingBottom, data }) {

    const products = [];
    data.products.forEach(element => {
        products.push({
            id: element.product_id,
            image: asset('backend-assets/uploads/product_thumbs/' + element.product_thumb), name: element.product_title, price: element.product_price
            , category: "Pregnancy Care", stage: "1st Month of Pregnan", rating: 6
        });
    });
    return (
        <section className="section pt-2">
            <div className="container">
                <div className="row">
                    <div className="col-sm-12 text-center" data-aos="fade-up">
                        <h2 className="mini-heading">Our Featured Products</h2>
                    </div>
                </div>
                <div className="row mt-5" data-aos="fade-up">
                    {products.map((product, index) => (
                        <Link href={"/product/view/" + product.id} key={index} className="col-sm-3">
                            <div className="feature-box">
                                <div className="basket-box">
                                    <Link href="/product/addtocart" method="post" data={{ product_id: product.id, product_type: "simple", product_variant_id: null, quantity: 1, _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'), sweetnesslevel: null, ingrediantaddons: null, exclusions: null }}>
                                        <i className="fal fa-shopping-basket"></i>
                                    </Link>

                                </div>
                                <Link type='button' href={route('wishlist.add')} method="post" as='button' className="gray" data={{ product_id: product.id }}>
                                    <i className="fal fa-heart heart"></i>
                                </Link>
                                <img src={product.image} alt={product.name} />
                                <div className="features-content">
                                    <p>{product.stage}</p>
                                    <h5>{product.name}</h5>
                                    <h6>₹{product.price}</h6>
                                    <div className="star">
                                        {[...Array(product.rating)].map((_, i) => (
                                            <img key={i} src='/assets/images/star.png' alt="" className="object-contain shrink-0 aspect-[1.12] w-[18px]" />
                                        ))}

                                        <span>( {product.rating} reviews )</span>
                                    </div>
                                </div>
                            </div>
                        </Link>

                    ))}
                    <div className="col-sm-12 m-auto text-center mt-5">
                        <Link as="button" href="/products" className="button">See All</Link>
                    </div>
                </div>
            </div>
        </section>
    );
};

