import{r as e,j as r,Y as S}from"./app-422c2137.js";import"./Dropdown-bd61ab26.js";import{H as v}from"./HomeLayout-81fdb6ae.js";import w from"./ProductListing-c7c16ab0.js";import L from"./FirstOrder-2e474209.js";import b from"./Testimonials-2c0c5267.js";import C from"./CategoriesContent-f89a3055.js";import"./react-toastify.esm-07e16aaa.js";import"./Header-72610feb.js";import"./Footer-50e07701.js";import"./InputError-f0d9cca6.js";import"./ProductList-92d7f1b6.js";import"./asset-cfb426c9.js";function I({auth:m,products:i,homepagesections:o,sizes:l,prices:g,categorycontent:a}){let c=[];i.map(t=>{c.push({id:t.product_id,name:t.product_title,category:t.category_slug,price:t.product_price,image:"/backend-assets/uploads/product_thumbs/"+t.product_thumb,description:"Sample 1",reviews:t.reviews!=null?t.reviews.length:0,rating:t.reviews_avg_rating!=null?Number(t.reviews_avg_rating):0,size:"Small",updatedAt:new Date(t.updated_at).getTime()})});const[x,F]=e.useState(""),[n,M]=e.useState(""),[p,y]=e.useState(""),[h,N]=e.useState(1),s=10,d=i.filter(t=>{const _=t.product_title.toLowerCase().includes(x.toLowerCase()),f=!n||parseFloat(t.product_price)>=parseFloat(n),j=!p||parseFloat(t.product_price)<=parseFloat(p);return _&&f&&j}),u=h*s,P=u-s;return d.slice(P,u),Math.ceil(d.length/s),r.jsxs(v,{auth:m,header:r.jsx("h2",{className:"text-xl font-semibold leading-tight text-gray-800",children:"Product Listing"}),children:[r.jsx(S,{title:"Product Listing"}),r.jsx(w,{products:c,sizes1:l,prices:g}),a&&r.jsx(C,{categoriescontent:a}),r.jsx(L,{}),r.jsx("div",{className:"pt-4 mb-4"}),r.jsx(b,{sectionChildren:o[5].section_childs,section:o[5]})]})}export{I as default};
