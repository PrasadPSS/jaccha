import React from "react";
import { asset } from '../../../Helpers/asset';

function FeaturedProducts({data}) {
  const products = [];
  data.section_childs.forEach(element => {
    products.push({image: asset('backend-assets/uploads/home_page_section_child_images/'+element.home_page_section_child_images), name: element.home_page_section_child_sub_title, price: element.home_page_section_child_url
      , category: "Pregnancy Care", stage: "1st Month of Pregnan"});
  });

  return (
    <section className="mt-24 w-full max-w-[1497px] max-md:mt-10 max-md:max-w-full">
      <h2 className="text-center text-3xl font-bold tracking-wide text-gray-700 capitalize mb-8">Our Featured Products</h2>
      <div className="flex flex-wrap justify-between">
        {products.map((product, index) => (
          <div key={index} className="w-1/4 px-2 mb-8 max-md:w-full">
            <div className="flex flex-col">
              <img loading="lazy" src={product.image} alt={product.name} className="object-contain w-full aspect-[0.83]" />
              <div className="mt-4">
                <div className="flex gap-4 text-sm leading-none uppercase text-stone-500">
                  <div>{product.category}</div>
                  <div>{product.stage}</div>
                </div>
                <h3 className="mt-2 text-2xl font-semibold leading-none text-neutral-800">{product.name}</h3>
                <p className="mt-2 text-xl font-semibold leading-loose text-neutral-800">{product.price}</p>
                <div className="flex items-start mt-2">
                  {[...Array(5)].map((_, i) => (
                    <img key={i} src={asset('frontend/images/star.png')} alt="" className="object-contain shrink-0 aspect-[1.12] w-[18px]" />
                  ))}
                  <span className="ml-2 text-base leading-none text-neutral-400">( 6 reviews )</span>
                </div>
              </div>
            </div>
          </div>
        ))}
      </div>
      <button className="px-11 py-3 mt-8 mx-auto block text-xl font-bold text-white rounded-lg bg-zinc-800 shadow-[0px_10px_20px_rgba(0,0,0,0.15)] max-md:px-5">
        See All
      </button>

      

    </section>
  );
}

export default FeaturedProducts;