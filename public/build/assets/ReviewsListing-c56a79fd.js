import{r as f,j as e}from"./app-e4f223b6.js";const u=({product_reviews:l})=>{const[t,g]=f.useState(1),n=5;let o=l.filter(s=>s.approval==1);const r=Math.ceil(l.length/n),m=t*n,x=m-n,p=l.slice(x,m),c=s=>{s>0&&s<=r&&g(s)},j=s=>{if(!s)return"1 day ago";const a=new Date(s),i=new Date-a,d=Math.floor(i/(1e3*60*60*24));return d===0?"Today":d===1?"1 day ago":`${d} days ago`};return e.jsxs("div",{className:"col-sm-12",children:[p.map((s,a)=>{if(s.approval==1)return e.jsx("div",{className:"reviews-listing",children:e.jsxs("div",{className:"row align-items-center",children:[e.jsx("div",{className:"col-sm-2",children:e.jsxs("div",{className:"person-name",children:[e.jsx("h4",{children:s.username}),[...Array(Math.floor(s.rating))].map((h,i)=>e.jsx("img",{src:"/assets/images/product-details/star1.png",alt:"Full star"},`full-${i}`)),s.rating%1>=.5&&e.jsx("img",{src:"/assets/images/product-details/star2.png",alt:"Half star"}),[...Array(5-Math.ceil(s.rating))].map((h,i)=>e.jsx("img",{src:"/assets/images/product-details/star3.png",alt:"Empty star"},`empty-${i}`))]})}),e.jsx("div",{className:"col-sm-9",children:e.jsxs("div",{className:"review-content",children:[e.jsx("p",{children:e.jsx("b",{children:s.headline})}),e.jsx("p",{children:s.comment})]})}),e.jsx("div",{className:"col-sm-1",children:e.jsx("div",{className:"last-day-review",children:e.jsx("p",{children:j(s.created_at)||"1 day ago"})})})]},a)},a)}),o.length==0&&e.jsx("div",{className:"text-center mt-2",children:"No Reviews Yet"}),o.length>0&&e.jsx("div",{className:"Page navigation review-pagination mt-5",children:e.jsxs("ul",{className:"pagination",children:[e.jsx("li",{className:`page-item ${t===1?"disabled":""}`,onClick:()=>c(t-1),children:e.jsx("a",{className:"page-link",href:"#",children:"Previous"})}),Array.from({length:r},(s,a)=>e.jsx("li",{className:`page-item ${t===a+1?"active":""}`,onClick:()=>c(a+1),children:e.jsx("a",{className:"page-link",href:"#",children:a+1})},a)),e.jsx("li",{className:`page-item ${t===r?"disabled":""}`,onClick:()=>c(t+1),children:e.jsx("a",{className:"page-link",href:"#",children:"Next"})})]})})]})};export{u as default};
