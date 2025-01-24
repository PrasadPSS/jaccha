import { asset } from "@/Helpers/asset";
import { Link } from "@inertiajs/react";
import React from "react";

export default function About({
    title,
    subTitle,
    sectionChildren,
    paddingTop,
    paddingBottom,
    section
}) {
    return (
        <section className="section pt-0 pb-0 px-3">
            <div className="container-fluid">
                <div className="row">
                    <div className="col-sm-12 col-md-12 col-lg-4">
                        <div
                            className="about-what-image"
                            data-aos="fade-left"
                            data-aos-delay="1200"
                        >
                            <img
                                className="about-image-1"
                               src={asset(
                                                                   "backend-assets/uploads/home_page_section_images/" +
                                                                   section.home_page_section_images1
                                                               )}
                                alt="about image"
                            />
                        </div>
                    </div>
                    <div className="col-sm-12 col-md-12 col-lg-8">
                        <div
                            className="about-what-content"
                            data-aos="fade-left"
                            data-aos-delay="1400"
                        >
                            <h2>
                                {
                                    title
                                }
                            </h2>
                            <p>
                                {
                                    subTitle
                                }
                            </p>
                            <Link as="button" 
                            href={sectionChildren[0].home_page_section_child_url} 
                            className="button">{sectionChildren[0].home_page_section_child_title}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
            <div className="about-gradient-bg"></div>
        </section>
    );
}
