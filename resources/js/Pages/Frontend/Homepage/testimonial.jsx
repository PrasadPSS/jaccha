import React, { useState } from "react";
import { asset } from '../../../Helpers/asset';

function Testimonial({data}) {
  const testimonials = [];
  data.section_childs.forEach(element => {
    testimonials.push({
      name: element.home_page_section_child_sub_title,
      comment:
        element.home_page_section_child_title,
      profileImage:
        asset('backend-assets/uploads/home_page_section_child_images/'+ element.home_page_section_child_images),
      ratingImage:
        "https://cdn.builder.io/api/v1/image/assets/TEMP/f4d19abfd5ff3f4b21addef2724b35bd0faf72c1c125d695948636f7fd4587ff?placeholderIfAbsent=true&apiKey=13ac881fd2134f72b1dc131d381f5f3b",
      productImage:
        "",});
  });

  // State for the active testimonial
  const [currentIndex, setCurrentIndex] = useState(0);

  // Function to move to the next testimonial
  const nextSlide = () => {
    setCurrentIndex((prev) => (prev + 1) % testimonials.length);
  };

  // Function to move to the previous testimonial
  const prevSlide = () => {
    setCurrentIndex((prev) => (prev - 1 + testimonials.length) % testimonials.length);
  };

  // Current testimonial data
  const currentTestimonial = testimonials[currentIndex];

  return (
    <section className="mt-36 w-full max-w-[1457px] max-md:mt-10 max-md:max-w-full">
      <h2 className="text-center text-3xl font-bold tracking-wide text-gray-700 capitalize mb-20">
        Hear from Our Nourished Moms
      </h2>
      <div className="flex gap-5 max-md:flex-col">
        {/* Left Arrow */}
        <button
          onClick={prevSlide}
          className="text-xl font-bold text-gray-600 bg-gray-200 rounded-full px-3 py-2 hover:bg-gray-300"
        >
          &larr;
        </button>

        {/* Main Content */}
        <div className="flex flex-col w-[32%] max-md:w-full">
          <div className="flex flex-col w-full max-md:mt-6 max-md:max-w-full">
            <div className="flex gap-10 max-md:max-w-full">
              <img
                loading="lazy"
                src={currentTestimonial.profileImage}
                alt="Testimonial"
                className="object-contain grow shrink-0 aspect-[1.21] basis-0 w-fit"
              />
              <img
                loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/fc19aee096fb47e5e6f678a1ef0169c11971f7eeace3b7a79557688a02583c37?placeholderIfAbsent=true&apiKey=13ac881fd2134f72b1dc131d381f5f3b"
                alt=""
                className="object-contain shrink-0 self-start w-px aspect-[0.03]"
              />
            </div>
            <div className="self-start max-md:max-w-full">
              <div className="flex gap-5 max-md:flex-col">
                <div className="flex flex-col w-6/12 max-md:w-full">
                  <h3 className="mt-2 text-2xl font-semibold tracking-wide leading-normal text-zinc-700">
                    {currentTestimonial.name}
                  </h3>
                </div>
                <div className="flex flex-col ml-5 w-6/12 max-md:ml-0 max-md:w-full">
                  <img
                    loading="lazy"
                    src={currentTestimonial.ratingImage}
                    alt="Rating"
                    className="object-contain shrink-0 max-w-full rounded-sm bg-blend-normal aspect-[1.47] w-[115px] max-md:mt-10"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div className="flex flex-col ml-5 w-[68%] max-md:ml-0 max-md:w-full">
          <div className="max-md:mt-5 max-md:max-w-full">
            <div className="flex gap-5 max-md:flex-col">
              <div className="flex flex-col w-[79%] max-md:w-full">
                <div className="flex flex-col items-start w-full max-md:max-w-full">
                  <p className="mt-3.5 text-base tracking-wide leading-8 bg-blend-normal text-zinc-700 max-md:max-w-full">
                    {currentTestimonial.comment}
                  </p>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Right Arrow */}
        <button
          onClick={nextSlide}
          className="text-xl font-bold text-gray-600 bg-gray-200 rounded-full px-3 py-2 hover:bg-gray-300"
        >
          &rarr;
        </button>
      </div>
    </section>
  );
};

export default Testimonial;