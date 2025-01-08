import { asset } from "@/Helpers/asset";
import { Link } from "@inertiajs/react";
import React from "react";

export default function Featured({
    title,
    subTitle,
    sectionChildren,
    paddingTop,
    paddingBottom,
    data,
}) {
    const products = [];
    data.products.forEach(element => {
        let avg_rating = 0;
        let sum_rating = 0;
        element.reviews.map((reviews) => {
            sum_rating = sum_rating + reviews.rating;
        })
        avg_rating = sum_rating / element.reviews.length;
        products.push({
            id: element.product_id,
            image: asset('backend-assets/uploads/product_thumbs/' + element.product_thumb),
            name: element.product_title, price: element.product_price,
            category: element.category_slug,
            stage: element.category_slug,
            rating: isNaN(avg_rating) ? 0 : avg_rating
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
                                    <Link
                                        href="/product/addtocart"
                                        method="post"
                                        data={{
                                            product_id: product.id,
                                            product_type: "simple",
                                            product_variant_id: null,
                                            quantity: 1,
                                            _token: document
                                                .querySelector(
                                                    'meta[name="csrf-token"]'
                                                )
                                                .getAttribute("content"),
                                            sweetnesslevel: null,
                                            ingrediantaddons: null,
                                            exclusions: null,
                                        }}
                                    >
                                        <i className="fal fa-shopping-basket"></i>
                                    </Link>
                                    <Link
                                        type="button"
                                        href={route("wishlist.add")}
                                        method="post"
                                        as="button"
                                        className="gray"
                                        data={{ product_id: product.id }}
                                    >
                                        <i className="fal fa-heart heart"></i>
                                    </Link>
                                </div>

                                <img src={product.image} alt={product.name} />
                                <div className="features-content">
                                    <p>{product.stage}</p>
                                    <h5>{product.name}</h5>
                                    <h6>₹{product.price}</h6>
                                    {product.rating > 0 &&
                                        <div className="star">
                                            {[...Array(product.rating)].map((_, i) => (
                                                <img key={i} src='/assets/images/star.png' alt="" className="object-contain shrink-0 aspect-[1.12] w-[18px]" />
                                            ))}

                                            {[...Array(5 - product.rating)].map((_, i) => (
                                                <img key={i} src='/assets/images/star1.png' alt="" className="object-contain shrink-0 aspect-[1.12] w-[18px]" />
                                            ))}

                                            <span>( {product.rating} reviews )</span>
                                        </div>
                                    }
                                </div>
                            </div>
                        </Link>
                    ))}
                    <div className="col-sm-12 m-auto text-center mt-5">
                        <Link as="button" href="/products" className="button">
                            See All
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    );
}
