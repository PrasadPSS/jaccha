import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import HomeLayout from '@/Layouts/HomeLayout';
import { Head } from '@inertiajs/react';

export default function ProductBanner() {
  return (
    <section className="section banner product_banner">
      <div className="product-listing_banner-bg" data-aos="fade-right" data-aos-delay="1400"></div>
      <div className="container pb-5">
        <div className="row align-items-center">
          <div className="col-sm-6">
            <div className="banner-content">
              <p className="banner-sub-heading" data-aos="fade-right" data-aos-delay="400">
                Pure. Natural. Delicious.
              </p>
              <h1 className="heading" data-aos="fade-right" data-aos-delay="400">
                Nourish Your<br />
                Journey with<br />
                Every Bite
              </h1>
            </div>
          </div>
          <div className="col-sm-6">
            <div className="product-listing-banner">
              <div className="about_content product_content">
                <div className="about-right" data-aos="fade-right" data-aos-delay="800">
                  <img src="/assets/images/about.png" alt="about image" />
                </div>
                <div className="dot-bg" data-aos="fade-right" data-aos-delay="800">
                  <img src="/assets/images/dot.png" alt="about image" />
                </div>
              </div>
              <div className="about-us-image product-us-image" data-aos="fade-right" data-aos-delay="1200">
                <div className="about-us-content">
                  <h4 className="sub-heading mb-3">Shop Now</h4>
                  <p>
                    Explore our curated selection of homemade, nutritional
                    delights crafted for moms-to-be, new moms, and wellness
                    enthusiasts.
                  </p>
                </div>
              </div>
            </div>
            <div className="about-us-image p-about-us-image">
              <div className="pink-box" data-aos="fade-right" data-aos-delay="1000">
                <i className="fal fa-long-arrow-right"></i><span>Explore Collection Now</span>
              </div>
              <div className="dot-bg" data-aos="fade-right" data-aos-delay="1000">
                <img src="/assets/images/dot.png" alt="about image" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
