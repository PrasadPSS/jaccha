import{q as o,j as a,a as r}from"./app-40acd811.js";import{a as h}from"./asset-cfb426c9.js";function _({title:n,subTitle:m,sectionChildren:p,paddingTop:u,paddingBottom:x,data:d}){const c=[];d.products.forEach(s=>{let e=0,i=0;s.reviews.map(t=>{i=i+t.rating}),e=i/s.reviews.length,c.push({id:s.product_id,product_slug:s.product_slug,image:h("backend-assets/uploads/product_thumbs/"+s.product_thumb),name:s.product_title,price:s.product_price,category:s.category_slug,stage:s.category_slug,rating:isNaN(e)?0:e,discount:s.product_discounted_amount})});let l=o().props.auth.csrf_token;return a.jsx("section",{className:"section pt-2",children:a.jsxs("div",{className:"container",children:[a.jsx("div",{className:"row",children:a.jsx("div",{className:"col-sm-12 text-center","data-aos":"fade-up",children:a.jsx("h2",{className:"mini-heading",children:n})})}),a.jsxs("div",{className:"row mt-5","data-aos":"fade-up",children:[c.map((s,e)=>a.jsx(r,{href:"/product/view/"+s.product_slug,className:"col-sm-3",children:a.jsxs("div",{className:"feature-box",children:[a.jsx("div",{className:"basket-box",children:a.jsx(r,{href:"/product/addtocart",method:"post",data:{product_id:s.id,product_type:"simple",product_variant_id:null,quantity:1,_token:l,sweetnesslevel:null,ingrediantaddons:null,exclusions:null},children:a.jsx("i",{className:"fal fa-shopping-basket"})})}),a.jsx(r,{href:route("wishlist.add"),method:"post",className:"gray",data:{product_id:s.id},children:a.jsx("i",{className:"fal fa-heart heart"})}),a.jsx("img",{src:s.image,alt:s.name}),a.jsxs("div",{className:"features-content",children:[a.jsx("p",{children:s.stage}),a.jsx("h5",{children:s.name}),s.price-s.discount<s.price&&a.jsx("div",{class:"feature-box",children:a.jsxs("h6",{children:["₹",s.price-s.discount,".00",a.jsxs("span",{children:["₹",s.price,".00"]})]})}),s.discount==0&&a.jsxs("h6",{children:["₹",s.price]}),s.rating>0&&a.jsxs("div",{className:"star",children:[[...Array(s.rating)].map((i,t)=>a.jsx("img",{src:"/assets/images/star.png",alt:"",className:"object-contain shrink-0 aspect-[1.12] w-[18px]"},t)),[...Array(5-s.rating)].map((i,t)=>a.jsx("img",{src:"/assets/images/star1.png",alt:"",className:"object-contain shrink-0 aspect-[1.12] w-[18px]"},t)),a.jsxs("span",{children:["( ",s.rating," reviews )"]})]})]})]})},e)),a.jsx("div",{className:"col-sm-12 m-auto text-center mt-5",children:a.jsx(r,{as:"button",href:"/products/featured-products",className:"button",children:"See All"})})]})]})})}export{_ as default};
