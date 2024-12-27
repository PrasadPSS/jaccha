import{j as s,a as r}from"./app-87c5ad4f.js";import"./Dropdown-9e976269.js";import{H as t}from"./HomeLayout-2f87d1a5.js";import"./Header-02df6ecb.js";import"./Footer-3bfd1141.js";function m({auth:c,orders:a}){return console.log(a),s.jsx(t,{auth:c,children:s.jsxs("div",{className:"container mt-5",children:[s.jsx("h1",{className:"mb-4",children:"My Orders"}),a.length===0?s.jsx("div",{className:"alert alert-warning",children:"No orders found!"}):s.jsx("div",{className:"accordion",id:"ordersAccordion",children:a.map((e,i)=>s.jsxs("div",{className:"accordion-item",children:[s.jsx("h2",{className:"accordion-header",id:`heading-${i}`,children:s.jsxs("button",{className:`accordion-button ${i!==0?"collapsed":""}`,type:"button","data-bs-toggle":"collapse","data-bs-target":`#collapse-${i}`,"aria-expanded":i===0?"true":"false","aria-controls":`collapse-${i}`,children:["Order #",e.orders_counter_id," - ",e.orderproducts.length," ","Product(s)"]})}),s.jsxs("div",{id:`collapse-${i}`,className:`accordion-collapse collapse ${i===0?"show":""}`,"aria-labelledby":`heading-${i}`,"data-bs-parent":"#ordersAccordion",children:[s.jsx("div",{children:s.jsx(r,{href:"/orders/viewinvoice/"+e.order_id,children:"View Invoice"})}),s.jsxs("div",{className:"accordion-body",children:[s.jsx("h5",{children:"Order Details"}),s.jsxs("ul",{className:"list-group mb-3",children:[s.jsxs("li",{className:"list-group-item",children:[s.jsx("strong",{children:"Order ID:"})," ",e.orders_counter_id]}),s.jsxs("li",{className:"list-group-item",children:[s.jsx("strong",{children:"Total:"})," ₹",e.total]}),s.jsxs("li",{className:"list-group-item",children:[s.jsx("strong",{children:"Payment Mode:"})," ",e.payment_mode.toUpperCase()]}),s.jsxs("li",{className:"list-group-item",children:[s.jsx("strong",{children:"Status:"})," ",e.delivered_stage?"Delivered":e.out_of_delivery_stage?"Out for Delivery":e.shipped_stage?"Shipped":e.preparing_order_stage?"Preparing Order":e.confirmed_stage?"Confirmed":"Pending"]}),s.jsxs("li",{className:"list-group-item",children:[s.jsx("strong",{children:"Confirmed Date:"})," ",e.confirmed_date?e.confirmed_date:"Not yet confirmed"]})]}),s.jsx("h5",{children:"Shipping Details"}),s.jsxs("ul",{className:"list-group mb-3",children:[s.jsxs("li",{className:"list-group-item",children:[s.jsx("strong",{children:"Name:"})," ",e.shipping_full_name]}),s.jsxs("li",{className:"list-group-item",children:[s.jsx("strong",{children:"Mobile:"})," ",e.shipping_mobile_no]}),s.jsxs("li",{className:"list-group-item",children:[s.jsx("strong",{children:"Address:"})," ",`${e.shipping_address_line1}, ${e.shipping_address_line2}, ${e.shipping_city}, ${e.shipping_state}, ${e.shipping_pincode}`]})]}),s.jsx("h5",{children:"Product Details"}),s.jsxs("table",{className:"table table-striped",children:[s.jsx("thead",{children:s.jsxs("tr",{children:[s.jsx("th",{scope:"col",children:"Product"}),s.jsx("th",{scope:"col",children:"Price"}),s.jsx("th",{scope:"col",children:"Quantity"}),s.jsx("th",{scope:"col",children:"Total"})]})}),s.jsx("tbody",{children:e.orderproducts.map(l=>s.jsxs("tr",{children:[s.jsx("td",{children:l.product_title}),s.jsxs("td",{children:["₹",l.product_price]}),s.jsx("td",{children:l.qty}),s.jsxs("td",{children:["₹",l.product_price*l.qty]})]},l.orders_product_details_id))})]})]})]})]},e.order_id))})]})})}export{m as default};