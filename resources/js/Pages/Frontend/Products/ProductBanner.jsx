import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import HomeLayout from '@/Layouts/HomeLayout';
import { Head } from '@inertiajs/react';

export default function ProductBanner() {
  return (
    <section class="section banner product_banner">
      <div class="product-listing_banner-bg" data-aos="fade-right" data-aos-delay="1400"></div>
      <div class="container pb-5">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <div class="banner-content">
              <p class="banner-sub-heading" data-aos="fade-right" data-aos-delay="400">
                Pure. Natural. Delicious.
              </p>
              <h1 class="heading" data-aos="fade-right" data-aos-delay="400">
                Nourish Your<br />
                Journey with<br />
                Every Bite
              </h1>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="product-listing-banner">
              <div class="about_content product_content">
                <div class="about-right" data-aos="fade-right" data-aos-delay="800">
                  <img src="./assets/images/about.png" alt="about image" />
                </div>
                <div class="dot-bg" data-aos="fade-right" data-aos-delay="800">
                  <img src="./assets/images/dot.png" alt="about image" />
                </div>
              </div>
              <div class="about-us-image product-us-image" data-aos="fade-right" data-aos-delay="1200">
                <div class="about-us-content">
                  <h4 class="sub-heading mb-3">Shop Now</h4>
                  <p>
                    Explore our curated selection of homemade, nutritional
                    delights crafted for moms-to-be, new moms, and wellness
                    enthusiasts.
                  </p>
                </div>
              </div>
            </div>
            <div class="about-us-image p-about-us-image">
              <div class="pink-box" data-aos="fade-right" data-aos-delay="1000">
                <i class="fal fa-long-arrow-right"></i><span>Explore Collection Now</span>
              </div>
              <div class="dot-bg" data-aos="fade-right" data-aos-delay="1000">
                <img src="./assets/images/dot.png" alt="about image" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
