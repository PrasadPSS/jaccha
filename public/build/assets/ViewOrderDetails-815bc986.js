import{j as e,a as r}from"./app-387e1406.js";import"./Dropdown-949fe089.js";import"./HomeLayout-73fd3202.js";import{U as l}from"./UserMenu-8a937260.js";import"./Header-7bb4570d.js";import"./Footer-967a417c.js";import"./InputError-19e85c0c.js";function o({auth:d,orders:s}){return console.log("sadsa",s),e.jsx(l,{auth:d,activeTab:"orders",children:e.jsx("div",{class:"tab-pane fade show active",id:"pills-third",role:"tabpanel","aria-labelledby":"pills-third-tab",children:e.jsxs("div",{class:"account-right-content",children:[e.jsx("div",{class:"details-heading px-4 py-3",children:e.jsxs("h3",{children:["My Orders",">>"," Order Id : #",s.orders_counter_id]})}),e.jsxs("div",{class:"order_boxes",children:[e.jsxs("div",{class:"order_heading",children:[e.jsxs("p",{children:["Ordered Id : ",e.jsxs("b",{children:["#",s.orders_counter_id]})]}),e.jsxs("p",{children:["Ordered Placed Date : ",e.jsx("b",{children:new Date(s.created_at).getDate()+"-"+new Date(s.created_at).getMonth()+"-"+new Date(s.created_at).getFullYear()})]}),e.jsx("p",{children:e.jsxs("span",{className:s.delivered_stage?"sts_delivered":"sts_confirmed",children:["Order Status : ",s.delivered_stage?s.delivered_stage:s.out_of_delivery_stage?"Out for Delivery":s.shipped_stage?"Shipped":s.preparing_order_stage?"Preparing Order":s.confirmed_stage?"Confirmed":"Pending"]})}),e.jsx(r,{as:"button",className:"black button",href:"/orders/viewinvoice/"+s.order_id,children:"View Invoice"})]}),e.jsx("div",{class:"track-order-box d-flex order_heading",children:s.delivered_stage==1&&e.jsxs("p",{children:["Delivered Date: ",s.delivered_date]})}),e.jsxs("div",{class:"order_content",children:[s.orderproducts.map((i,c)=>e.jsxs("div",{class:"checkout-product mt-3",children:[e.jsxs("div",{class:"checkout-product_details d-flex",children:[e.jsxs("div",{class:"checkout-product_img position-relative",children:[e.jsx("img",{src:"/backend-assets/uploads/product_thumbs/"+i.products.product_thumb,alt:""}),e.jsx("p",{children:i.qty})]}),e.jsx("div",{class:"checkout-product_content",children:e.jsx("h5",{children:i.product_title})})]}),e.jsx("div",{class:"view-order-price",children:e.jsxs("p",{children:["₹",i.product_price,".00"]})})]},c)),e.jsxs("div",{class:"view-order-payment",children:[e.jsxs("div",{class:"contact_details",children:[e.jsx("h3",{children:"Payment"}),e.jsx("p",{children:s.payment_mode})]}),e.jsxs("div",{class:"contact_details",children:[e.jsx("h3",{children:"Delivery Address"}),e.jsxs("p",{children:[s.shipping_full_name,e.jsx("br",{}),s.shipping_city,s.shipping_pincode,e.jsx("br",{}),s.shipping_state,", ",s.shipping_address_line1,", ",s.shipping_address_line2]})]})]}),e.jsxs("div",{class:"view-order-payment",children:[e.jsxs("div",{class:"contact_details",children:[e.jsx("h3",{children:"Need Help"}),e.jsx("p",{children:"Order Issues"}),e.jsx("p",{children:"Returns"})]}),e.jsxs("div",{class:"contact_details",children:[e.jsx("h3",{children:"Order Summary"}),e.jsxs("div",{class:"view-order-summary",children:[e.jsx("p",{children:"Shipping"}),e.jsxs("p",{children:["₹",s.shipping_amount]})]}),e.jsxs("div",{class:"view-order-summary",children:[e.jsx("p",{children:"Tax"}),e.jsxs("p",{children:["+₹",-Number(s.total_mrp_dicount).toFixed(2)]})]}),e.jsxs("div",{class:"view-order-summary",children:[e.jsx("p",{children:e.jsx("b",{children:"Total"})}),e.jsx("p",{children:e.jsxs("b",{children:["₹",Number(s.total).toFixed(2)]})})]})]})]})]})]})]})})})}export{o as default};
