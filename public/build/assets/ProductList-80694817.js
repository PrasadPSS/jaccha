import{j as s,a as r}from"./app-22d750b0.js";import{g as j}from"./getCsrfToken-7f0f8407.js";const p=({filteredProducts:l,setCurrentPage:h,currentPage:e})=>{console.log("sadsadsa",l);const c=e*6,o=c-6,m=l.slice(o,c),d=Math.ceil(l.length/6),n=a=>{h(a)};let x=j();return s.jsxs("div",{className:"row",children:[m.map((a,i)=>s.jsx("a",{href:"/product/view/"+a.id,className:i>2?"col-sm-4 mt-5":"col-sm-4",children:s.jsxs("div",{className:"feature-box",children:[s.jsx(r,{as:"a",method:"post",href:"/product/addtocart",data:{product_id:a.id,product_type:"simple",product_variant_id:null,quantity:1,_token:x,sweetnesslevel:null,ingrediantaddons:null,exclusions:null},children:s.jsx("div",{className:"basket-box",children:s.jsx("i",{className:"fal fa-shopping-basket"})})}),a.added&&s.jsx(r,{method:"post",href:route("wishlist.delete"),data:{product_id:a.id},children:s.jsx("i",{className:"fas fa-heart heart",style:{color:"red"}})}),!a.added&&s.jsx(r,{method:"post",href:route("wishlist.add"),as:"a",data:{product_id:a.id},children:s.jsx("i",{className:"fal fa-heart heart"})}),s.jsx("img",{src:a.image,alt:a.name}),s.jsxs("div",{className:"features-content",children:[s.jsx("p",{children:a.category}),s.jsx("h5",{children:a.name}),a.price-a.discount<a.price&&s.jsx("div",{class:"feature-box",children:s.jsxs("h6",{children:["₹",a.price-a.discount,".00",s.jsxs("span",{children:["₹",a.price,".00"]})]})}),a.discount==0&&s.jsxs("h6",{children:["₹",a.price]}),a.rating!=0&&s.jsxs("div",{className:"star",children:[Array(a.rating).fill().map((g,t)=>s.jsx("img",{src:"/assets/images/star.png",alt:"star"},t)),Array(5-a.rating).fill().map((g,t)=>s.jsx("img",{src:"/assets/images/star2.png",alt:"star"},t)),s.jsxs("span",{children:["( ",a.reviews," reviews )"]})]})]})]})},a.id)),l.length!=0&&s.jsx("div",{className:"Page navigation review-pagination mt-5",children:s.jsxs("ul",{className:"pagination",children:[s.jsx("li",{className:"page-item",children:s.jsx("button",{href:"#",className:"page-link",disabled:e==1,onClick:()=>n(e-1),children:"Previous"})}),Array.from({length:d},(a,i)=>s.jsx("li",{className:"page-item",children:s.jsx("a",{className:e===i+1?"page-link active":"page-link",onClick:()=>n(i+1),href:"#",children:i+1},i)})),s.jsx("li",{className:"page-item",children:s.jsx("button",{className:"page-link",href:"#",disabled:e===d,onClick:()=>n(e+1),children:"Next"})})]})})]})},k=p;export{k as default};
