import{r as o,j as r,Y as v}from"./app-ec13efaf.js";import"./Dropdown-4c02419f.js";import{H as w}from"./HomeLayout-ea000adf.js";import S from"./ProductListing-82684b1c.js";import L from"./FirstOrder-cfe387d2.js";import b from"./Testimonials-14b89c21.js";import"./react-toastify.esm-fae324c5.js";import"./Header-718ee992.js";import"./Footer-1723fd28.js";import"./InputError-c91c38f2.js";import"./ProductList-5b3f9736.js";import"./asset-cfb426c9.js";function B({auth:s,products:e,homepagesections:a,sizes:m,prices:_}){let g=a.filter(t=>t.home_page_section_name=="Testimonials")[0],d=[];console.log(e),e.map(t=>{d.push({id:t.product_id,product_slug:t.product_slug,name:t.product_title,added:s.user!=null?s.wishlist.some(i=>i.user_id==s.user.id&&i.product_id==t.product_id):!1,category:t.category_slug,price:t.product_price!=null?t.product_price:t.variants[0].product_price,image:"/backend-assets/uploads/product_thumbs/"+t.product_thumb,description:"Sample 1",reviews:t.reviews!=null?t.reviews.length:0,rating:t.reviews_avg_rating!=null?Number(t.reviews_avg_rating):0,size:t.product_weight,updatedAt:new Date(t.updated_at).getTime(),discount:t.product_discounted_amount})});const[x,F]=o.useState(""),[u,M]=o.useState(""),[p,y]=o.useState(""),[h,C]=o.useState(1),c=10,n=e.filter(t=>{const i=t.product_title.toLowerCase().includes(x.toLowerCase()),f=!u||parseFloat(t.product_price)>=parseFloat(u),j=!p||parseFloat(t.product_price)<=parseFloat(p);return i&&f&&j}),l=h*c,P=l-c;return n.slice(P,l),Math.ceil(n.length/c),r.jsxs(w,{auth:s,header:r.jsx("h2",{className:"text-xl font-semibold leading-tight text-gray-800",children:"Product Listing"}),children:[r.jsx(v,{title:"Product Listing"}),r.jsx(S,{products:d,sizes1:m,prices:_}),r.jsx(L,{}),r.jsx("div",{className:"pt-4 mb-4"}),r.jsx(b,{sectionChildren:g.section_childs,section:a[5]})]})}export{B as default};
