import React from "react";
import { asset } from '../../../Helpers/asset';

function Navigation() {
  const navItems = [
    { label: "New Arrivals", isFresh: true },
    "Vitamins & Supplements",
    "Healthy Snacks",
    "Organic",
    "Gluten-Free",
    "Vegan",
    "Smoothies",
    "Subscription Boxes",
    "Energy-Boosting Foods"
  ];

  return (
    <nav className="flex z-10 justify-center items-center self-stretch px-20 py-6 -mt-5 w-full bg-white max-md:px-5 max-md:max-w-full">
      {navItems.map((item, index) => (
        <div key={index} className={`mx-2 tracking-wide hover:bg-rose-100 py-2 px-1 rounded text-noraml font-bold text-gray-900 ${index === 0 ? 'flex gap-2.5 items-center' : ''}`}>
          {typeof item === 'object' ? (
            <>
              <div>{item.label}</div>
              {item.isFresh && (
                <div className="gap-3 self-stretch text-base py-1.5 font-normal pr-2.5 pl-2.5 my-auto tracking-wide text-white whitespace-nowrap bg-rose-500 rounded-sm">
                  #Fresh
                </div>
              )}
            </>
          ) : (
            item
          )}
        </div>
      ))}
    </nav>
  );
}

export default Navigation;