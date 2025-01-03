import React, { useEffect, useLayoutEffect, useRef, useState } from "react";

// Importing styles
import "../../../public/assets/css/libraries/aos.css";
import "../../../public/assets/css/libraries/fancybox.css";
import "../../../public/assets/css/libraries/bootstrap.min.css";
import "../../../public/assets/css/libraries/sweetalert.css";
import "../../../public/assets/css/custom/style.css";
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

// Importing scripts
import "../../../public/assets/js/libraries/bootstrap.bundle.min.js";
import "../../../public/assets/js/custom/app.js";
import "../../../public/assets/js/libraries/sweetalert.js";

import Header from "@/Pages/Frontend/Includes/Header";
import Footer from "@/Pages/Frontend/Includes/Footer";
import { usePage } from "@inertiajs/react";

const HomeLayout = ({ children, auth }) => {
  let flash = usePage().props.flash;

  useEffect(()=>{
    if (flash.success ) {
      toast.success(flash.success);

    }
    if (flash.error) {
      toast.warning(flash.error);

    }
  },[flash.success, flash.error])
    

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
      <ToastContainer />
      <Header auth={auth} />
      <main>{children}</main>
      <Footer />
    </div>
  );
};

export default HomeLayout;
