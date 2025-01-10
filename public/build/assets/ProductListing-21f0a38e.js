import{q as S,r as a,j as e}from"./app-22d750b0.js";import k from"./ProductList-80694817.js";import"./getCsrfToken-7f0f8407.js";function T({products:x}){let j=S().props.auth;const[o,r]=a.useState([]),[n,d]=a.useState([]),[i,h]=a.useState(""),[m,g]=a.useState("low-to-high"),[N,p]=a.useState(1),b=s=>{r(c=>c.includes(s)?c.filter(l=>l!==s):[...c,s])},f=s=>{d(c=>c.includes(s)?c.filter(l=>l!==s):[...c,s])},v=s=>{h(s)},y=()=>{g(s=>s=="low-to-high"?"high-to-low":"low-to-high")},t=x.filter(s=>{const c=o.length===0||o.includes(s.category),l=n.length===0||n.includes(s.size),w=!i||s.price>=i.min&&s.price<=i.max;return c&&l&&w});a.useEffect(()=>p(1),[o,n,i]),console.log(t),t.sort(function(s,c){if(s.price-s.discount>c.price-c.discount)return m=="low-to-high"?1:-1;if(s.price-s.discount==c.price-c.discount)return 0;if(s.price-s.discount<c.price-c.discount)return m=="high-to-low"?1:-1});const u=()=>{r([]),h(null),d([]),document.querySelectorAll(".product-accordian input").forEach(c=>{c.type==="checkbox"||c.type==="radio"?c.checked=!1:c.value=""})};return e.jsx("section",{className:"section product_listing",children:e.jsx("div",{className:"container",children:e.jsxs("div",{className:"row",children:[e.jsx("div",{className:"col-sm-3",children:e.jsxs("div",{className:"product-accordian","data-aos":"fade-up","data-aos-delay":"200",children:[e.jsxs("div",{className:"product-filter",children:[e.jsx("h2",{className:"",children:"Filters"}),e.jsx("button",{onClick:u,className:"btn btn-primary filter-reset",children:"Reset All"})]}),e.jsxs("div",{className:"accordion",id:"accordionExample",children:[e.jsxs("div",{className:"accordion-item",children:[e.jsx("h2",{className:"accordion-header",children:e.jsx("button",{className:"accordion-button",type:"button","data-bs-toggle":"collapse","data-bs-target":"#collapseOne","aria-expanded":"true","aria-controls":"collapseOne",children:"Category"})}),e.jsx("div",{id:"collapseOne",className:"accordion-collapse collapse show","data-bs-parent":"#accordionExample",children:e.jsx("div",{className:"accordion-body",children:e.jsx("ul",{children:j.categories.map(s=>e.jsx("li",{children:e.jsxs("div",{className:"form-check",children:[e.jsx("input",{className:"form-check-input",type:"checkbox",value:s.category_slug,onChange:()=>b(s.category_slug)}),e.jsx("label",{className:"form-check-label",children:s.category_name})]})},s.category_id))})})})]}),e.jsxs("div",{className:"accordion-item",children:[e.jsx("h2",{className:"accordion-header",children:e.jsx("button",{className:"accordion-button collapsed",type:"button","data-bs-toggle":"collapse","data-bs-target":"#collapseTwo","aria-expanded":"false","aria-controls":"collapseTwo",children:"Price"})}),e.jsx("div",{id:"collapseTwo",className:"accordion-collapse collapse","data-bs-parent":"#accordionExample",children:e.jsx("div",{className:"accordion-body",children:e.jsx("ul",{children:[{label:"₹ 0 to ₹ 500",min:0,max:500},{label:"₹ 500 to ₹ 1000",min:500,max:1e3},{label:"Above ₹ 1000",min:1e3,max:1/0}].map(s=>e.jsx("li",{children:e.jsxs("div",{className:"form-check",children:[e.jsx("input",{className:"form-check-input",type:"radio",name:"priceFilter",value:s.label,onChange:()=>v(s)}),e.jsx("label",{className:"form-check-label",children:s.label})]})},s.label))})})})]}),e.jsxs("div",{className:"accordion-item",children:[e.jsx("h2",{className:"accordion-header",children:e.jsx("button",{className:"accordion-button collapsed",type:"button","data-bs-toggle":"collapse","data-bs-target":"#collapseThree","aria-expanded":"false","aria-controls":"collapseThree",children:"Size"})}),e.jsx("div",{id:"collapseThree",className:"accordion-collapse collapse","data-bs-parent":"#accordionExample",children:e.jsx("div",{className:"accordion-body",children:e.jsx("ul",{children:["Small","Medium","Large"].map(s=>e.jsx("li",{children:e.jsxs("div",{className:"form-check",children:[e.jsx("input",{className:"form-check-input",type:"checkbox",value:s,onChange:()=>f(s)}),e.jsx("label",{className:"form-check-label",children:s})]})},s))})})})]})]})]})}),e.jsx("div",{className:"col-sm-9",children:e.jsxs("div",{className:"row","data-aos":"fade-up",children:[e.jsx("div",{className:"col-sm-12 text-right",children:e.jsx("div",{className:"product-select mb-4",children:e.jsxs("select",{onChange:y,className:"form-select","aria-label":"Default select example",children:[e.jsx("option",{selected:!0,disabled:!0,value:"",children:"Sort By"}),e.jsx("option",{value:"low-to-high",children:"Price low to high"}),e.jsx("option",{value:"high-to-low",children:"Price high to low"})]})})}),t.length==0&&e.jsx("div",{className:"container",children:e.jsxs("div",{className:"row align-items-center empty-product",children:[e.jsx("div",{className:"col-md-8",children:e.jsxs("div",{className:"empty-wishlist-content",children:[e.jsx("h2",{children:"Oops! No products found."}),e.jsx("p",{children:"It seems like we couldn't find any products matching your filters."}),e.jsx("button",{onClick:u,className:"btn btn-primary",children:"Reset All"})]})}),e.jsx("div",{className:"col-md-4",children:e.jsx("div",{className:"empty-wishlist-image",children:e.jsx("img",{src:"/assets/images/empty-wishlist.png",alt:"Empty Wishlist Illustration",className:"img-fluid"})})})]})}),e.jsx(k,{filteredProducts:t,setCurrentPage:p,currentPage:N})]})})]})})})}export{T as default};
