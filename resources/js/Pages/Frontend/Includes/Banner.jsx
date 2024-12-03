import { asset } from "@/Helpers/asset";
import React from "react";


export default function Banner({ title, subTitle, sectionChildren, paddingTop, paddingBottom }) {

    return (
        <section className="section banner">
            <div className="container pb-5">
                <div className="row align-items-center">
                    <div className="col-sm-8">
                        <div className="banner-content">
                            <p className="banner-sub-heading" data-aos="fade-right" data-aos-delay="4000">
                                {sectionChildren[0].home_page_section_child_title}
                            </p>
                            <h1 className="heading" data-aos="fade-right" data-aos-delay="800">
                                {sectionChildren[1].home_page_section_child_sub_title}
                            </h1>
                        </div>
                    </div>
                    <div className="col-sm-4">
                        <div className="banner-image text-end" data-aos="zoom-in-left" data-aos-delay="1200">
                            <img src={asset('backend-assets/uploads/home_page_section_child_images/' + sectionChildren[2].home_page_section_child_images)} />
                        </div>
                    </div>
                </div>
            </div>
            <div className="container pt-5">
                <div className="row">
                    <div className="col-sm-5 pe-0">
                        <div className="about-us-image">
                            <img src={asset('backend-assets/uploads/home_page_section_child_images/' + sectionChildren[3].home_page_section_child_images)} alt="about image" data-aos="fade-right" />

                            <h6 className="mt-3 mb-2" data-aos="fade-right">{sectionChildren[4].home_page_section_child_title}</h6>
                            <p data-aos="fade-right">
                                Certified Nutritionist &<br />
                                Maternal Wellness Expert
                            </p>
                            <div className="pink-box" data-aos="fade-right" data-aos-delay="800">
                                <i className="fal fa-long-arrow-right"></i><span>{sectionChildren[8].home_page_section_child_title}</span>
                            </div>
                        </div>
                    </div>
                    <div className="col-sm-7 ps-0">
                        <div className="about_content">
                            <div className="about-us-content" data-aos="fade-right" data-aos-delay="1200">
                                <h4 className="sub-heading mb-3">About Us</h4>
                                <p
                                    dangerouslySetInnerHTML={{
                                        __html: sectionChildren[5].home_page_section_child_sub_title,
                                    }}
                                ></p>
                            </div>
                            <div className="buy-now-box" data-aos="fade-right" data-aos-delay="1200">
                                <div className="buynow-image">
                                    <img src={asset("backend-assets/uploads/home_page_section_child_images/" + sectionChildren[7].home_page_section_child_images)} alt="about image" />
                                </div>
                                <div className="buynow-content">
                                    <h3 className="mb-2">Gond Laddoo For Post</h3>
                                    <h3 className="mb-2">₹550.00</h3>
                                    <button className="button">BUY NOW</button>
                                </div>
                            </div>
                            <div className="about-right">
                                <img src={asset("backend-assets/uploads/home_page_section_child_images/" + sectionChildren[6].home_page_section_child_images)} alt="about image" data-aos="fade-right" data-aos-delay="1600" />
                            </div>
                            <div className="dot-bg">
                                <img src="./assets/images/dot.png" alt="about image" data-aos="fade-right" data-aos-delay="1600" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
};

