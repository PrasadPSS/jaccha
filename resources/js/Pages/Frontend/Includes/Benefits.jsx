import { asset } from "@/Helpers/asset";
import { Link } from "@inertiajs/react";
import React from "react";

export default function Benefits({
    title,
    subTitle,
    sectionChildren,
    paddingTop,
    paddingBottom,
    section
}) {
    return (
        <div className="section pt-4 px-3">
            <div className="container-fluid">
                <div className="benefits-gradient-bg"></div>
                <div className="row">
                    <div className="col-sm-12 col-md-12 col-lg-5 ps-0">
                        <div
                            className="benefits-image"
                            data-aos="fade-right"
                            data-aos-delay="200"
                        >
                            <img
                                src={asset(
                                                                    "backend-assets/uploads/home_page_section_images/" +
                                                                    section.home_page_section_images1
                                                                )}
                            />
                        </div>
                    </div>
                    <div className="col-sm-12 col-md-12 col-lg-7">
                        <div
                            className="benefits-content"
                            data-aos="fade-left"
                            data-aos-delay="800"
                        >
                            <h2
                                className="mb-4"
                                dangerouslySetInnerHTML={{
                                    __html: title,
                                }}
                            ></h2>
                            <ul>
                                <li>
                                    <img
                                        src="./assets/images/tickmark.png"
                                        alt="tickmark"
                                    />
                                    {
                                        sectionChildren[0]
                                            .home_page_section_child_title
                                    }
                                </li>
                                <li>
                                    <img
                                        src="./assets/images/tickmark.png"
                                        alt="tickmark"
                                    />
                                    {
                                        sectionChildren[1]
                                            .home_page_section_child_title
                                    }
                                </li>
                                <li>
                                    <img
                                        src="./assets/images/tickmark.png"
                                        alt="tickmark"
                                    />
                                    {
                                        sectionChildren[2]
                                            .home_page_section_child_title
                                    }
                                </li>
                                <li>
                                    <img
                                        src="./assets/images/tickmark.png"
                                        alt="tickmark"
                                    />
                                    {
                                        sectionChildren[3]
                                            .home_page_section_child_title
                                    }
                                </li>
                                <li>
                                    <img
                                        src="./assets/images/tickmark.png"
                                        alt="tickmark"
                                    />
                                    {
                                        sectionChildren[4]
                                            .home_page_section_child_title
                                    }
                                </li>
                                
                                
                                
                            </ul>
                            <Link as="button" 
                            href={sectionChildren[5].home_page_section_child_url} 
                            className="button mt-4">
                            {sectionChildren[5].home_page_section_child_title}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
