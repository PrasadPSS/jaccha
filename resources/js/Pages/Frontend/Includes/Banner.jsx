import { asset } from "@/Helpers/asset";
import { Link } from "@inertiajs/react";
import React from "react";

export default function Banner({
    title,
    subTitle,
    sectionChildren,
    paddingTop,
    paddingBottom,
    product,
    section,
    data
}) {
    console.log('section', product);
    return (
        <section className="section banner">
            <div className="container pb-lg-5">
                <div className="row align-items-center">
                    <div className="col-sm-12 col-md-12 col-lg-8">
                        <div className="banner-content">
                            <p
                                className="banner-sub-heading"
                                data-aos="fade-right"
                                data-aos-delay="4000"
                            >
                                {
                                    title
                                }
                            </p>
                            <h1
                                className="heading"
                                data-aos="fade-right"
                                data-aos-delay="800"
                            >
                                {
                                    subTitle
                                }
                            </h1>
                        </div>
                    </div>
                    <div className="col-sm-12 col-md-12 col-lg-4">
                        <div
                            className="banner-image text-end"
                            data-aos="zoom-in-left"
                            data-aos-delay="1200"
                        >
                            <img
                                src={asset(
                                    "assets/images/banner.png" 
                                        
                                )}
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div className="container pt-5">
                <div className="row">
                    <div className="col-sm-12 col-md-12 col-lg-5 pe-lg-0">
                        <div className="about-us-image">
                            <img
                                src={asset(
                                    "backend-assets/uploads/home_page_section_images/" +
                                    section.home_page_section_images1
                                )}
                                alt="about image"
                                data-aos="fade-right"
                            />

                            <h6 className="mt-3 mb-2" data-aos="fade-right">
                                {
                                    section.home_page_section_text1
                                }
                            </h6>
                            <p data-aos="fade-right">
                                {
                                    section.home_page_section_text2
                                }
                            </p>
                            <a href={section.home_page_section_text6}
                                className="pink-box"
                                data-aos="fade-right"
                                data-aos-delay="800"
                            >
                                <i className="fal fa-long-arrow-right"></i>
                                <span>
                                    {
                                        section.home_page_section_text5
                                    }
                                </span>
                            </a>
                        </div>
                    </div>
                    <div className="col-sm-12 col-md-12 col-lg-7 ps-lg-0">
                        <div className="about_content">
                            <div
                                className="about-us-content"
                                data-aos="fade-right"
                                data-aos-delay="1200"
                            >
                                <h4 className="sub-heading mb-3">{section.home_page_section_text3}</h4>
                                <p
                                    dangerouslySetInnerHTML={{
                                        __html: section.home_page_section_text4,
                                    }}
                                ></p>
                            </div>
                            <div
                                className="buy-now-box"
                                data-aos="fade-right"
                                data-aos-delay="1200"
                            >
                                <div className="buynow-image">
                                    <img
                                        src={asset(
                                            "backend-assets/uploads/product_thumbs//" +
                                                product.product_thumb
                                        )}
                                        alt="about image"
                                    />
                                </div>
                                <div className="buynow-content">
                                    <h3 className="mb-2">
                                        {
                                            product.product_title
                                        }
                                    </h3>
                                    <h3 className="mb-2">
                                        ₹
                                        {
                                           product.product_price != null ? product.product_price : product.variants[0].product_price
                                        }
                                        .00
                                    </h3>
                                    <Link
                                        href={
                                            '/product/view/'+ product.product_slug
                                        }
                                        className="button"
                                    >
                                        BUY NOW
                                    </Link>
                                </div>
                            </div>
                            <div className="about-right">
                                <img
                                    src={asset(
                                        "backend-assets/uploads/home_page_section_images/" +
                                        section.home_page_section_images2
                                    )}
                                    alt="about image"
                                    data-aos="fade-right"
                                    data-aos-delay="1600"
                                />
                            </div>
                            <div className="dot-bg">
                                <img
                                    src="/assets/images/dot.png"
                                    alt="about image"
                                    data-aos="fade-right"
                                    data-aos-delay="1600"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
