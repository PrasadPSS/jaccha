import{r as i,j as a,a as s}from"./app-e30e0a77.js";const t=({auth:e})=>{const[n,l]=i.useState(e.querys!=null?e.querys:"");return a.jsxs("header",{children:[a.jsx("nav",{className:"navbar navbar-expand-lg first-navbar",children:a.jsxs("div",{className:"container",children:[a.jsx(s,{className:"navbar-brand",href:route("home"),children:a.jsx("img",{className:"logo",src:"/assets/images/logo.png",alt:"Logo"})}),a.jsx("button",{className:"navbar-toggler",type:"button","data-bs-toggle":"collapse","data-bs-target":"#navbarNav","aria-controls":"navbarNav","aria-expanded":"false","aria-label":"Toggle navigation",children:a.jsx("span",{className:"navbar-toggler-icon"})}),a.jsxs("div",{className:"search",children:[a.jsx("span",{className:"input-group-text bg-transparent border-end-0",children:a.jsx("i",{className:"far fa-search"})}),a.jsx("form",{action:"/products",method:"get",children:a.jsx("input",{id:"querys",value:n,onChange:r=>{l(r.target.value)},name:"querys",type:"text",className:"form-control border-start-0",placeholder:"Search for an item..."})})]}),a.jsx("div",{className:"collapse navbar-collapse",id:"navbarNav",children:a.jsxs("ul",{className:"navbar-nav ms-auto gap-4",children:[a.jsx("li",{className:"nav-item",children:a.jsx(s,{className:route().current("product.index")?"nav-link active":"nav-link","aria-current":"page",href:route("product.index"),children:"Shop"})}),a.jsxs("li",{className:"nav-item",children:[e&&e.user&&a.jsx(s,{className:route().current("profile.edit")?"nav-link active":"nav-link",href:route("profile.edit"),children:" Account"}),!e.user&&a.jsx(s,{className:route().current("login")?"nav-link active":"nav-link",href:route("login"),children:" Log in"})]}),a.jsx("li",{className:"nav-item",children:a.jsxs(s,{className:route().current("wishlist.index")?"nav-link active":"nav-link",href:route("wishlist.index"),children:["Wish List ",e.wishlist_count!=0?"("+e.wishlist_count+")":""]})}),a.jsx("li",{className:"nav-item",children:a.jsxs(s,{className:route().current("cart.index")?"nav-link active":"nav-link",href:route("cart.index"),children:["Basket",a.jsx("i",{className:"far fa-shopping-basket"})," ",e.cart_count!=0?"("+e.cart_count+")":""]})})]})})]})}),a.jsx("nav",{className:"navbar navbar-expand-lg second-navbar",children:a.jsxs("div",{className:"container",children:[a.jsx("button",{className:"navbar-toggler",type:"button","data-bs-toggle":"collapse","data-bs-target":"#navbarNav","aria-controls":"navbarNav","aria-expanded":"false","aria-label":"Toggle navigation",children:a.jsx("span",{className:"navbar-toggler-icon"})}),a.jsx("div",{className:"collapse navbar-collapse justify-content-center",id:"navbarNav",children:a.jsxs("ul",{className:"navbar-nav",children:[a.jsx("li",{className:"nav-item",children:a.jsxs(s,{className:"nav-link","aria-current":"page",href:"/products/new-arrival",children:["New Arrivals ",a.jsx("span",{children:"# Fresh"})]})}),e.categories.map(r=>a.jsx("li",{className:"nav-item",children:a.jsx(s,{className:"nav-link","aria-current":"page",href:"/products/"+r.category_id,children:r.category_name})},r.category_name))]})})]})})]})};export{t as default};
