import React from "react";
import HomeLayout from "@/Layouts/HomeLayout";
import Banner from "@/Pages/Frontend/Includes/Banner";
import Highlights from "@/Pages/Frontend/Includes/Highlights";
import Benefits from "@/Pages/Frontend/Includes/Benefits";
import Featured from "@/Pages/Frontend/Includes/Featured";
import About from "@/Pages/Frontend/Includes/About";
import Testimonials from "@/Pages/Frontend/Includes/Testimonials";

const componentMap = {
  Banner: Banner,
  Highlights: Highlights,
  Benefits: Benefits,
  Featured: Featured,
  About: About,
  Testimonials: Testimonials,
};

export default function ProductPage({ auth, laravelVersion, phpVersion, homepagesections, data }) {
  return (
    <HomeLayout auth={auth}>
      {homepagesections.map((section) => {
        const SectionComponent = componentMap[section.home_page_section_name];

        // Pass relevant data from the section object to the components
        if (SectionComponent) {
          return (
            <SectionComponent
              key={section.home_page_section_id}
              title={section.home_page_section_title}
              subTitle={section.home_page_section_sub_title}
              sectionChildren={section.section_childs}
              paddingTop={section.padding_top}
              paddingBottom={section.padding_bottom}
              data={data}
            />
          );
        } else {
          return null;
        }
      })}
    </HomeLayout>
  );
}
