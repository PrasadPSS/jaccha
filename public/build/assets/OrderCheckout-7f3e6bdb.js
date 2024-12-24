import{r as g,j as e,Y as N}from"./app-48c342ba.js";import{a as v}from"./asset-5a6f21ef.js";import{H as b}from"./HomeLayout-829407ee.js";import"./Header-f8138978.js";import"./Footer-ebdd2a38.js";function M({auth:o,data:p}){const{cart:h,user:f,shipping_address:d,cart_amounts:t,shipping_amount:r,payment_mode:m,order_delivery:F,increment_id:u,shipping_charges:x,grand_total:k,cod_rmk:O,cod_response:j,cod_charges:a}=p,[i,_]=g.useState("");let c;i=="Cash On Delivery"?c=parseFloat(t.cart.cart_discounted_total+r+Number(a)).toFixed(2):c=parseFloat(t.cart.cart_discounted_total+r).toFixed(2);const l=parseFloat(t.total_gst).toFixed(2),y=parseFloat(t.cart.cart_discounted_total-l+t.product_discount-c).toFixed(2);return e.jsxs(b,{auth:o,children:[e.jsx(N,{title:"Place Order"}),e.jsxs("div",{className:"container my-4",children:[e.jsx("h1",{className:"text-center mb-4",children:"Place Your Order"}),e.jsxs("div",{className:"card mb-4",children:[e.jsx("div",{className:"card-header",children:e.jsx("h4",{children:"Cart Summary"})}),e.jsxs("div",{className:"card-body",children:[h.map((s,n)=>e.jsxs("div",{className:"row mb-3",children:[e.jsx("div",{className:"col-md-3",children:e.jsx("img",{src:v("backend-assets/uploads/product_thumbs/"+s.products.product_thumb),alt:s.products.product_title,className:"img-fluid"})}),e.jsxs("div",{className:"col-md-6",children:[e.jsx("h5",{children:s.products.product_title}),e.jsx("p",{children:s.products.product_sub_title}),e.jsxs("p",{children:["Price: ₹",s.products.product_price," | Quantity: ",s.qty]})]}),e.jsxs("div",{className:"col-md-3 text-end",children:[s.products.product_price>s.products.product_discounted_price&&e.jsxs(e.Fragment,{children:[e.jsxs("h5",{className:"text-muted text-decoration-line-through d-inline me-2",children:["₹",s.products.product_price]}),e.jsxs("h5",{className:"d-inline text-danger",children:["₹",s.products.product_discounted_price]}),e.jsxs("span",{className:"badge bg-success ms-2",children:["-₹",s.products.product_price-s.products.product_discounted_price]})]}),s.products.product_price<=s.products.product_discounted_price&&e.jsxs("h5",{children:["₹",s.products.product_price]})]})]},n)),e.jsx("hr",{}),e.jsxs("div",{className:"d-flex justify-content-between",children:[e.jsx("h5",{children:"Total MRP:"}),e.jsxs("h5",{children:["₹",t.cart.cart_mrp_total]})]}),e.jsxs("div",{className:"d-flex justify-content-between",children:[e.jsx("h5",{children:"Discount:"}),e.jsxs("h5",{children:["- ₹",t.product_discount]})]}),j=="Y"&&i=="Cash On Delivery"&&e.jsxs("div",{className:"d-flex justify-content-between",children:[e.jsx("h5",{children:"Cod Charges:"}),e.jsxs("h5",{children:["₹",a]})]}),e.jsxs("div",{className:"d-flex justify-content-between",children:[e.jsx("h5",{children:"Shipping:"}),e.jsxs("h5",{children:["₹",parseFloat(r).toFixed(2)]})]}),e.jsxs("div",{className:"d-flex justify-content-between",children:[e.jsx("h5",{children:"Gst:"}),e.jsxs("h5",{children:["₹",l]})]}),e.jsxs("div",{className:"d-flex justify-content-between",children:[e.jsx("h5",{className:"text-success",children:"Total Savings:"}),e.jsxs("h5",{className:"text-success",children:["₹",y]})]}),e.jsx("hr",{}),e.jsxs("div",{className:"d-flex justify-content-between",children:[e.jsx("h4",{children:"Total Amount:"}),e.jsxs("h4",{children:["₹",c]})]})]})]}),e.jsxs("form",{action:"/order/place",method:"POST",children:[e.jsx("input",{type:"hidden",name:"_token",value:document.querySelector('meta[name="csrf-token"]').getAttribute("content")}),e.jsx("input",{type:"hidden",name:"amount",value:c}),e.jsx("input",{type:"hidden",name:"shipping_amount",value:r}),e.jsx("input",{type:"hidden",name:"txnid",value:u||""}),e.jsx("input",{type:"hidden",name:"shipping_charges",value:JSON.stringify(x||{})}),e.jsx("input",{type:"hidden",name:"shipping_id",value:d.shipping_address_id}),e.jsxs("div",{className:"card mb-4",children:[e.jsx("div",{className:"card-header",children:e.jsx("h4",{children:"Shipping Details"})}),e.jsxs("div",{className:"card-body",children:[e.jsxs("p",{children:[e.jsx("strong",{children:"Name:"})," ",d.shipping_full_name]}),e.jsxs("p",{children:[e.jsx("strong",{children:"Mobile:"})," ",d.shipping_mobile_no]}),e.jsxs("p",{children:[e.jsx("strong",{children:"Address:"})," ",`${d.shipping_address_line1}, ${d.shipping_address_line2}, ${d.shipping_city}, ${d.shipping_state}, ${d.shipping_pincode}`]})]})]}),e.jsxs("div",{className:"card mb-4",children:[e.jsx("div",{className:"card-header",children:e.jsx("h4",{children:"Payment Options"})}),e.jsx("div",{className:"card-body",children:m.map((s,n)=>e.jsxs("div",{className:"form-check mb-2",children:[e.jsx("input",{className:"form-check-input",type:"radio",name:"paymentmode",id:`paymentMode${s.payment_mode_id}`,value:s.payment_mode_name,defaultChecked:s.default_selected===1,onClick:()=>_(s.payment_mode_name)}),e.jsx("label",{className:"form-check-label",htmlFor:`paymentMode${s.payment_mode_id}`,children:s.payment_mode_name})]},n))})]}),e.jsx("div",{className:"text-center",children:e.jsx("button",{type:"submit",className:"btn btn-primary btn-lg",children:"Place Order"})})]})]})]})}export{M as default};
