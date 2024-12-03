import React, { useEffect } from "react";

// Importing styles
import "../../../public/assets/css/libraries/aos.css";
import "../../../public/assets/css/libraries/fancybox.css";
import "../../../public/assets/css/libraries/bootstrap.min.css";
import "../../../public/assets/css/custom/style.css";

// Importing scripts
import "../../../public/assets/js/libraries/bootstrap.bundle.min.js";
import "../../../public/assets/js/custom/app.js";

import Header from "@/Pages/Frontend/Includes/Header";
import Footer from "@/Pages/Frontend/Includes/Footer";

const HomeLayout = ({ children, auth }) => {
  // Initialize AOS
  useEffect(() => {
    if (window.AOS) {
      window.AOS.init({
        duration: 1000,
        delay: 400,
        easing: "ease",
        once: true,
        disable: "mobile",
      });
    }
  }, []);

  return (
    <div>
      <Header auth={auth}/>
      <main>{children}</main>
      <Footer />
    </div>
  );
};

export default HomeLayout;
