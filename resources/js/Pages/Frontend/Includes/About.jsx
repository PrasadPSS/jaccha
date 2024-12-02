import { asset } from "@/Helpers/asset";
import React from "react";


export default function About({ title, subTitle, sectionChildren, paddingTop, paddingBottom }) {
    return (
        <section className="section pt-0 pb-0 px-3">
            <div className="container-fluid">
                <div className="row">
                    <div className="col-sm-4">
                        <div className="about-what-image" data-aos="fade-left" data-aos-delay="1200">
                            <img className="about-image-1" src={asset('backend-assets/uploads/home_page_section_child_images/'+ sectionChildren[0].home_page_section_child_images)} alt="about image" />
                            <img
                                className="about-image-2"
                                src={asset('backend-assets/uploads/home_page_section_child_images/'+ sectionChildren[1].home_page_section_child_images)}
                                alt="about image"
                            />
                        </div>
                    </div>
                    <div className="col-sm-8">
                        <div className="about-what-content" data-aos="fade-left" data-aos-delay="1400">
                            <h2>{sectionChildren[2].home_page_section_child_title}</h2>
                            <p>
                            {sectionChildren[3].home_page_section_child_title}
                            </p>
                            <button className="button">{sectionChildren[4].home_page_section_child_title}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div className="about-gradient-bg"></div>
        </section>
    );
};

