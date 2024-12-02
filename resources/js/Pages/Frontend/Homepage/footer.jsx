import React from 'react';
import { asset } from '../../../Helpers/asset';

const Footer = () => {
  return (
    <footer className="bg-pink-100 py-8 px-6 mt-2">
      <div className="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        {/* Logo and Main Text */}
        <div className="flex flex-col items-center md:items-start text-center md:text-left">
          <div className="ml-2 flex flex-wrap gap-5 items-center self-stretch min-w-[240px] w-[511px] max-md:max-w-full">
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/d081467a8fa775aeca610d01fe4ec5616d9943331ff93177e3212ddafe84306a?placeholderIfAbsent=true&apiKey=13ac881fd2134f72b1dc131d381f5f3b" alt="" className="object-contain shrink-0 self-stretch my-auto aspect-[0.93] w-[67px]" />
            <div className="flex flex-col justify-center self-stretch my-auto w-[162px]">
              <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/9acecab8f590153f0712a4e341b19acd6dde7f202e4e5ae11ae6757c34f1fa69?placeholderIfAbsent=true&apiKey=13ac881fd2134f72b1dc131d381f5f3b" alt="Company logo" className="object-contain w-32 max-w-full aspect-[7.09]" />
              <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/f1d5d5b32ed74c1d8f0ec8db526fbb912dc744e2a8f752dab70ddaaaa47592f6?placeholderIfAbsent=true&apiKey=13ac881fd2134f72b1dc131d381f5f3b" alt="Company slogan" className="object-contain  max-w-full aspect-[14.71] w-[162px]" />
            </div>
          </div>
          <h2 className="ml-2 mt-5 text-2xl font-extrabold text-black w-[50%]">Handmade nutritional laddoos delivered with love.</h2>
        </div>

        {/* Quick Links */}
        <div className="flex flex-col items-start md:items-start">
          <h3 className="text-lg font-bold text-black mb-2 ">Quick Links</h3>
          <ul className="space-y-1">
            <li><a href="#home" className="text-black hover:text-pink-600">Home</a></li>
            <li><a href="#about" className="text-black hover:text-pink-600">About Us</a></li>
            <li><a href="#products" className="text-black hover:text-pink-600">Products</a></li>
            <li><a href="#contact" className="text-black hover:text-pink-600">Contact Us</a></li>
            <li><a href="#privacy" className="text-black hover:text-pink-600">Privacy Policy</a></li>
            <li><a href="#terms" className="text-black hover:text-pink-600">Terms & Condition</a></li>
          </ul>
        </div>

        {/* Contact Info and Newsletter */}
        <div className="flex flex-col items-center md:items-start text-center md:text-left">
          <h3 className="text-lg font-bold text-black mb-2">Get In Touch</h3>
          <p className="text-black">Email: Care@Jaccha.Com</p>
          <p className="text-black">Phone: +91 9876543210</p>
          <p className="text-black">Address: Mumbai, Maharashtra, India</p>

          <h3 className="text-lg font-bold text-black mt-4 mb-2">Subscribe To Our Newsletter</h3>
          <div className="flex">
            <input
              type="email"
              placeholder="Email address here..."
              className="px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none"
            />
            <button className="bg-pink-600 text-white px-4 rounded-r-md hover:bg-pink-700">SUBSCRIBE</button>
          </div>
        </div>
      </div>

      {/* Footer Bottom Text */}
      <div className="border-t border-gray-300 mt-8 pt-4 text-center text-black text-sm">
        <p>&copy; 2024 Jaccha. All Rights Reserved.</p>
        <div className="flex justify-center space-x-4 mt-2">
          <a href="#facebook" className="hover:text-pink-600">Facebook</a>
          <a href="#instagram" className="hover:text-pink-600">Instagram</a>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
