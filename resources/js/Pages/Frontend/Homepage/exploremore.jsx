



import React from "react";
import { asset } from '../../../Helpers/asset';

function ExploreMore({data}) {
  const products = [
    { image: "https://cdn.builder.io/api/v1/image/assets/TEMP/35208943e4c34295b8764c421e7b8c85f57c00715af8b4a3eccd6f39203a26d6?placeholderIfAbsent=true&apiKey=13ac881fd2134f72b1dc131d381f5f3b", name: "Baby Ubtan", price: "₹310.00", category: "Pregnancy Care", stage: "1st Month of Pregnan" },
    { image: "https://cdn.builder.io/api/v1/image/assets/TEMP/e7f91388e54ba5afe60037232c6e9925c6944393453ce7646bf06d3cb1fc7458?placeholderIfAbsent=true&apiKey=13ac881fd2134f72b1dc131d381f5f3b", name: "Haldi Laddoo", price: "₹310.00", category: "Pregnancy Care", stage: "1st Month of Pregnan" },
    { image: "https://cdn.builder.io/api/v1/image/assets/TEMP/f35fc91216c65b1a5bbe621f9b2635204c15e15369ac23588ca27476768d408b?placeholderIfAbsent=true&apiKey=13ac881fd2134f72b1dc131d381f5f3b", name: "Baby Ubtan", price: "₹310.00", category: "Pregnancy Care", stage: "1st Month of Pregnan" },
    { image: "https://cdn.builder.io/api/v1/image/assets/TEMP/e385f162667f665281837e642b38af7653a21e483666b4e66657fcbbbd90720f?placeholderIfAbsent=true&apiKey=13ac881fd2134f72b1dc131d381f5f3b", name: "Healthy Food", price: "₹310.00", category: "Pregnancy Care", stage: "1st Month of Pregnan" },
  ];
  let bgImagePath = asset('backend-assets/uploads/home_page_section_child_images/'+ data.section_childs[0].home_page_section_child_images);
  console.log(bgImagePath); 
  return (
   
    <div
    className="w-full h-[400px] bg-cover mt-11 pb-20 flex items-end justify-center"
    style={{ backgroundImage: `url(${bgImagePath})` }}
  >
        <button className="px-11 py-3 text-xl font-bold text-white rounded-lg bg-zinc-800 shadow-[0px_10px_20px_rgba(0,0,0,0.15)] max-md:px-5 mb-5">
          {data.section_childs[1].home_page_section_child_url}
        </button>
      </div>

  );
}

export default ExploreMore;
