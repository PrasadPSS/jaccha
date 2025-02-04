import { asset } from "@/Helpers/asset";
import React from "react";

export default function Highlights({
    title,
    subTitle,
    sectionChildren,
    paddingTop,
    paddingBottom,
    section
}) {
    
    return (
        <section className="section highlights">
            <div className="container">
                <div className="row">
                    <div className="col-sm-12 text-center">
                        <h2 className="mini-heading">
                            {
                                title
                            }
                        </h2>
                    </div>
                </div>
                <div className="row mt-5">
                    <a href={'/products/new-arrival'} className="col-sm-12 col-md-7">
                        <div
                            className="highlight_box"
                            data-aos="zoom-in-up"
                            data-aos-delay="400"
                        >
                            <img
                                src={asset(
                                                                    "backend-assets/uploads/home_page_section_images/" +
                                                                    section.home_page_section_images1
                                                                )}
                                alt="hightlight image"
                            />
                            <div className="highlight-heading">
                                <h2>{section.home_page_section_text1}</h2>
                            </div>
                            <div className="highlight_box-content">
                                <h6>{section.home_page_section_text1}</h6>
                                <span>{section.home_page_section_text6}</span>
                                <p className="mt-2">{section.home_page_section_text2}</p>
                            </div>
                        </div>
                    </a>
                    <a  href="/products/exclusive" className="col-sm-12 col-md-5">
                        <div
                            className="highlight_box"
                            data-aos="zoom-in-up"
                            data-aos-delay="1200"
                        >
                            <img
                                src={asset(
                                                                    "backend-assets/uploads/home_page_section_images/" +
                                                                    section.home_page_section_images2
                                                                )}
                                alt="hightlight image"
                            />
                            <div className="highlight-heading">
                                <h2>{section.home_page_section_text3}</h2>
                            </div>
                            <div className="highlight_box-content">
                                <h6>{section.home_page_section_text3}</h6>
                                <span>{section.home_page_section_text7}</span>
                                <p className="mt-2">{section.home_page_section_text4}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div className="row">
                    <div className="col-sm-12">
                        <div className="highlight-text" data-aos="fade-up">
                            <p
                                dangerouslySetInnerHTML={{
                                    __html: section.home_page_section_text5,
                                }}
                            ></p>
                        </div>
                        <div className="hightlight-icon-box">
                            <div
                                className="highlight_icon"
                                data-aos="fade-right"
                                data-aos-delay="400"
                            >
                                <img
                                    src={asset(
                                        "backend-assets/uploads/home_page_section_child_images/" +
                                            sectionChildren[0]
                                                .home_page_section_child_images
                                    )}
                                />
                                <p
                                    dangerouslySetInnerHTML={{
                                        __html: sectionChildren[0]
                                            .home_page_section_child_sub_title,
                                    }}
                                ></p>
                            </div>
                            <div
                                className="highlight_icon"
                                data-aos="fade-right"
                                data-aos-delay="600"
                            >
                                <img
                                    src={asset(
                                        "backend-assets/uploads/home_page_section_child_images/" +
                                            sectionChildren[1]
                                                .home_page_section_child_images
                                    )}
                                />
                                <p
                                    dangerouslySetInnerHTML={{
                                        __html: sectionChildren[1]
                                            .home_page_section_child_sub_title,
                                    }}
                                ></p>
                            </div>
                            <div
                                className="highlight_icon"
                                data-aos="fade-right"
                                data-aos-delay="800"
                            >
                                <img
                                    src={asset(
                                        "backend-assets/uploads/home_page_section_child_images/" +
                                            sectionChildren[2]
                                                .home_page_section_child_images
                                    )}
                                    alt="highlight icon"
                                />
                                <p
                                    dangerouslySetInnerHTML={{
                                        __html: sectionChildren[2]
                                            .home_page_section_child_sub_title,
                                    }}
                                ></p>
                            </div>
                            <div
                                className="highlight_icon"
                                data-aos="fade-right"
                                data-aos-delay="1000"
                            >
                                <img
                                    src={asset(
                                        "backend-assets/uploads/home_page_section_child_images/" +
                                            sectionChildren[3]
                                                .home_page_section_child_images
                                    )}
                                    alt="highlight icon"
                                />
                                <p
                                    dangerouslySetInnerHTML={{
                                        __html: sectionChildren[3]
                                            .home_page_section_child_sub_title,
                                    }}
                                ></p>
                            </div>
                            <div
                                className="highlight_icon"
                                data-aos="fade-right"
                                data-aos-delay="1200"
                            >
                                <img
                                    src={asset(
                                        "backend-assets/uploads/home_page_section_child_images/" +
                                            sectionChildren[4]
                                                .home_page_section_child_images
                                    )}
                                    alt="highlight icon"
                                />
                                <p
                                    dangerouslySetInnerHTML={{
                                        __html: sectionChildren[4]
                                            .home_page_section_child_sub_title,
                                    }}
                                ></p>
                            </div>
                            <div
                                className="highlight_icon"
                                data-aos="fade-right"
                                data-aos-delay="1400"
                            >
                                <img
                                    src={asset(
                                        "backend-assets/uploads/home_page_section_child_images/" +
                                            sectionChildren[5]
                                                .home_page_section_child_images
                                    )}
                                    alt="highlight icon"
                                />
                                <p
                                    dangerouslySetInnerHTML={{
                                        __html: sectionChildren[5]
                                            .home_page_section_child_sub_title,
                                    }}
                                ></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div className="half-circle">
                <img src="./assets/images/Subtract.png" />
            </div>
        </section>
    );
}
