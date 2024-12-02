import { asset } from "@/Helpers/asset";
import React from "react";


export default function Featured({ title, subTitle, sectionChildren, paddingTop, paddingBottom }) {
    const products = [];
    sectionChildren.forEach(element => {
        products.push({
            image: asset('backend-assets/uploads/home_page_section_child_images/' + element.home_page_section_child_images), name: element.home_page_section_child_sub_title, price: element.home_page_section_child_url
            , category: "Pregnancy Care", stage: "1st Month of Pregnan", rating: parseInt(element.home_page_section_child_footer_title, 10)
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
                        <div key={index} className="col-sm-3">
                        <div className="feature-box">
                            <div className="basket-box">
                                <i className="fal fa-shopping-basket"></i>
                            </div>
                            <i className="fal fa-heart heart"></i>
                            <img src={product.image} alt={product.name} />
                            <div className="features-content">
                                <p>{product.stage}</p>
                                <h5>{product.name}</h5>
                                <h6>₹{product.price}</h6>
                                <div className="star">
                                {[...Array(product.rating)].map((_, i) => (
                                            <img key={i} src='./assets/images/star.png' alt="" className="object-contain shrink-0 aspect-[1.12] w-[18px]" />
                                        ))}
                    
                                    <span>( {product.rating} reviews )</span>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    ))}

                </div>
            </div>
        </section>
    );
};

