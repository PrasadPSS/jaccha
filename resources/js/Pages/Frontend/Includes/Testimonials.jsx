import { asset } from "@/Helpers/asset";
import React from "react";


export default function Testimonials({ title, subTitle, sectionChildren, paddingTop, paddingBottom }) {
  const testimonials = [];
  sectionChildren.forEach(element => {
    if(element.home_page_section_child_title != 'NA')
      {
        testimonials.push({
          image: asset('backend-assets/uploads/home_page_section_child_images/' + element.home_page_section_child_images), name: element.home_page_section_child_sub_title, comments: element.home_page_section_child_title
          , rating: parseInt(element.home_page_section_child_footer_title, 10)
        });
      }
    
  });
  return (
    <section className="section testimonials pt-3">
      <div className="container">
        <div className="row mb-5">
          <div className="col-sm-12 text-center" data-aos="fade-up">
            <h2 className="mini-heading">Hear from Our Nourished Moms</h2>
          </div>
        </div>
        <div className="row pt-4">
          <div className="col-sm-10 pe-0">
            <div id="carouselExampleFade" className="carousel slide testimonial-carousel" data-aos="fade-up">
              <div className="carousel-inner">
                {testimonials.map((testimonial, key) => (
                  <div key={key} className={`carousel-item ${key === 0 ? 'active' : ''}`}>
                    <div className="row">
                      <div className="col-sm-4">
                        <div className="testimonial-image">
                          <img className="test-img" src={testimonial.image} />
                          <div className="dot-bg">
                            <img src="./assets/images/dot.png" alt="about image" />
                          </div>
                          <h4>{testimonial.name}</h4>
                        </div>
                      </div>
                      <div className="col-sm-8">
                        <div className="testimonial-content">
                          <div className="star">
                          {[...Array(testimonial.rating)].map((_, i) => (
                                            <img key={i} src='./assets/images/star.png' alt="" className="object-contain shrink-0 aspect-[1.12] w-[18px]" />
                                        ))}
                          </div>
                          <p>
                            {testimonial.comments}
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                ))}
              </div>
              <button className="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                data-bs-slide="prev">
                <span className="carousel-control-prev-icon" aria-hidden="true"></span>
                <span className="visually-hidden">Previous</span>
              </button>
              <button className="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                data-bs-slide="next">
                <span className="carousel-control-next-icon" aria-hidden="true"></span>
                <span className="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          <div className="col-sm-2 ps-0">
            <div className="testimonial-right text-end" data-aos="zoom-in-up">
              <img className="testimonial-img" src={asset('backend-assets/uploads/home_page_section_child_images/' + sectionChildren[2].home_page_section_child_images)} />
              <div className="dot-bg">
                <img src={asset('backend-assets/uploads/home_page_section_child_images/' + sectionChildren[3].home_page_section_child_images)} alt="about image" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

