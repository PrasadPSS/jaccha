import React from "react";


const CategoriesContent = ({ categoriescontent }) => {
  return (
    
            <div
              dangerouslySetInnerHTML={{ __html: categoriescontent.contents }}
              className="container"
            ></div>
        

         

          
       
  );
};

export default CategoriesContent;
