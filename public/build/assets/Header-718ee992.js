import{r as c,j as a,a as s}from"./app-ec13efaf.js";const o=({auth:e})=>{const[l,i]=c.useState(e.querys!=null?e.querys:"");return a.jsxs("header",{children:[a.jsx("nav",{className:"navbar navbar-expand-lg first-navbar",children:a.jsxs("div",{className:"container",children:[a.jsx(s,{className:"navbar-brand",href:route("home"),children:a.jsx("img",{className:"logo",src:"/assets/images/"+e.logo_path,alt:"Logo"})}),a.jsx("button",{className:"navbar-toggler navbarNav-first",type:"button","data-bs-toggle":"collapse","data-bs-target":"#navbarNav","aria-controls":"navbarNav","aria-expanded":"false","aria-label":"Toggle navigation",children:a.jsx("span",{className:"",children:a.jsx("i",{className:"far fa-ellipsis-v"})})}),a.jsx("button",{className:"navbar-toggler navbarNav-second",type:"button","data-bs-toggle":"collapse","data-bs-target":"#navbarNav1","aria-controls":"navbarNav1","aria-expanded":"false","aria-label":"Toggle navigation",children:a.jsx("span",{className:"",children:a.jsx("i",{className:"fal fa-bars"})})}),a.jsxs("div",{className:"search",children:[a.jsx("span",{className:"input-group-text bg-transparent border-end-0",children:a.jsx("i",{className:"far fa-search"})}),a.jsx("form",{action:"/products",method:"get",children:a.jsx("input",{id:"querys",value:l,onChange:r=>{i(r.target.value)},name:"querys",type:"text",className:"form-control border-start-0",placeholder:"Search for an item..."})})]}),a.jsx("div",{className:"collapse navbar-collapse",id:"navbarNav",children:a.jsxs("ul",{className:"navbar-nav ms-auto gap-4",children:[a.jsxs("div",{className:"search search-new",children:[a.jsx("span",{className:"input-group-text bg-transparent border-end-0",children:a.jsx("i",{className:"far fa-search"})}),a.jsx("form",{action:"/products",method:"get",children:a.jsx("input",{id:"querys",value:l,onChange:r=>{i(r.target.value)},name:"querys",type:"text",className:"form-control border-start-0",placeholder:"Search for an item..."})})]}),a.jsx("li",{className:"nav-item",children:a.jsx(s,{className:route().current("product.index")?"nav-link active":"nav-link","aria-current":"page",href:route("product.index"),children:"Shop"})}),a.jsxs("li",{className:"nav-item",children:[e&&e.user&&a.jsxs(s,{className:route().current("profile.view")?"nav-link active":"nav-link",href:route("profile.view"),children:[" ","Account"]}),!e.user&&a.jsxs(s,{className:route().current("login")?"nav-link active":"nav-link",href:route("login"),children:[" ","Log in"]})]}),a.jsx("li",{className:"nav-item",children:a.jsxs(s,{className:route().current("wishlist.index")?"nav-link active":"nav-link",href:route("wishlist.index"),children:["Wish List"," ",e.wishlist_count!=0?"("+e.wishlist_count+")":""]})}),a.jsx("li",{className:"nav-item",children:a.jsxs(s,{className:route().current("cart.index")?"nav-link active":"nav-link",href:route("cart.index"),children:["Basket",a.jsx("i",{className:"far fa-shopping-basket"})," ",e.cart_count!=0?"("+e.cart_count+")":""]})})]})})]})}),a.jsx("nav",{className:"navbar navbar-expand-lg second-navbar",children:a.jsx("div",{className:"container",children:a.jsx("div",{className:"collapse navbar-collapse justify-content-center",id:"navbarNav1",children:a.jsxs("ul",{className:"navbar-nav",children:[a.jsx("li",{className:"nav-item",children:a.jsxs(s,{className:"nav-link","aria-current":"page",href:"/products/new-arrival",children:["New Arrivals",a.jsx("span",{children:"# Fresh"})]})}),a.jsx("li",{className:"nav-item",children:a.jsx(s,{className:"nav-link","aria-current":"page",href:"/view-page/about-us",children:"About Us"})}),a.jsxs("li",{className:"nav-item dropdown position-static",children:[a.jsx("a",{className:"nav-link dropdown-toggle",href:"/products",id:"productsDropdown",role:"button","aria-expanded":"true",children:"Our Products"}),a.jsx("div",{className:"dropdown-menu mega-menu","aria-labelledby":"productsDropdown",children:a.jsx("div",{className:"container",children:a.jsxs("div",{className:"row",children:[e.categories.map(r=>a.jsxs("div",{className:"col-md-2",children:[a.jsx("h6",{className:"dropdown-header",children:a.jsx("a",{className:"dropdown-header",href:"/products/"+r.category_slug,children:r.category_name})}),a.jsx("ul",{className:"list-unstyled",children:r.subcategories.map(n=>a.jsx("li",{children:a.jsx("a",{className:"dropdown-item",href:"/products/item/"+n.sub_category_slug,children:n.subcategory_name})},n.sub_category_slug))})]},r.category_slug)),a.jsx("div",{className:"col-md-4",children:a.jsx("img",{className:"menu-image",src:"/assets/images/menu-image.jpg",alt:""})})]})})})]}),a.jsx("li",{className:"nav-item",children:a.jsx(s,{className:"nav-link","aria-current":"page",href:"/view-page/our-publications",children:"Our Publications"})})]})})})})]})};export{o as default};
