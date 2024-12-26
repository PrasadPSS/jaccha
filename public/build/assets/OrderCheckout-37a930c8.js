import{r as a,j as e,Y as O,a as A,b as w}from"./app-87c5ad4f.js";import{a as P}from"./asset-ac1dadd9.js";import{H as D}from"./HomeLayout-2f87d1a5.js";import"./Header-02df6ecb.js";import"./Footer-3bfd1141.js";function I({auth:h,data:m}){const{cart:u,user:$,shipping_address:x,shipping_addresses:_,cart_amounts:t,shipping_amount:j,payment_mode:g,order_delivery:M,increment_id:y,shipping_charges:v,grand_total:T,cod_rmk:R,cod_response:b,cod_charges:r}=m,[i,N]=a.useState(j),[c,f]=a.useState(b=="Y"?1:0);console.log(c);const[l,C]=a.useState(x.shipping_address_id),[o,S]=a.useState("");let n;o=="Cash On Delivery"?n=parseFloat(t.cart.cart_discounted_total+i+Number(r)).toFixed(2):n=parseFloat(t.cart.cart_discounted_total+i).toFixed(2);const p=parseFloat(t.total_gst).toFixed(2),k=parseFloat(t.cart.cart_discounted_total-p+t.product_discount-n).toFixed(2),F=s=>{w.get("/orders/calculaterate/"+s).then(d=>{N(d.data.shipping_amount),f(d.data.cod_response)})};return e.jsxs(D,{auth:h,children:[e.jsx(O,{title:"Place Order"}),e.jsxs("div",{className:"container my-4",children:[e.jsx("h1",{className:"text-center mb-4",children:"Place Your Order"}),e.jsxs("div",{className:"card mb-4",children:[e.jsx("div",{className:"card-header",children:e.jsx("h4",{children:"Cart Summary"})}),e.jsxs("div",{className:"card-body",children:[u.map((s,d)=>e.jsxs("div",{className:"row mb-3",children:[e.jsx("div",{className:"col-md-3",children:e.jsx("img",{src:P("backend-assets/uploads/product_thumbs/"+s.products.product_thumb),alt:s.products.product_title,className:"img-fluid"})}),e.jsxs("div",{className:"col-md-6",children:[e.jsx("h5",{children:s.products.product_title}),e.jsx("p",{children:s.products.product_sub_title}),e.jsxs("p",{children:["Price: ₹",s.products.product_price," | Quantity: ",s.qty]})]}),e.jsxs("div",{className:"col-md-3 text-end",children:[s.products.product_price>s.products.product_discounted_price&&e.jsxs(e.Fragment,{children:[e.jsxs("h5",{className:"text-muted text-decoration-line-through d-inline me-2",children:["₹",s.products.product_price]}),e.jsxs("h5",{className:"d-inline text-danger",children:["₹",s.products.product_discounted_price]}),e.jsxs("span",{className:"badge bg-success ms-2",children:["-₹",s.products.product_price-s.products.product_discounted_price]})]}),s.products.product_price<=s.products.product_discounted_price&&e.jsxs("h5",{children:["₹",s.products.product_price]})]})]},d)),e.jsx("hr",{}),e.jsxs("div",{className:"d-flex justify-content-between",children:[e.jsx("h5",{children:"Total MRP:"}),e.jsxs("h5",{children:["₹",t.cart.cart_mrp_total]})]}),e.jsxs("div",{className:"d-flex justify-content-between",children:[e.jsx("h5",{children:"Discount:"}),e.jsxs("h5",{children:["- ₹",t.product_discount]})]}),c==1&&o=="Cash On Delivery"&&e.jsxs("div",{className:"d-flex justify-content-between",children:[e.jsx("h5",{children:"Cod Charges:"}),e.jsxs("h5",{children:["₹",r]})]}),e.jsxs("div",{className:"d-flex justify-content-between",children:[e.jsx("h5",{children:"Shipping:"}),e.jsxs("h5",{children:["₹",parseFloat(i).toFixed(2)]})]}),e.jsxs("div",{className:"d-flex justify-content-between",children:[e.jsx("h5",{children:"Gst:"}),e.jsxs("h5",{children:["₹",p]})]}),e.jsxs("div",{className:"d-flex justify-content-between",children:[e.jsx("h5",{className:"text-success",children:"Total Savings:"}),e.jsxs("h5",{className:"text-success",children:["₹",k]})]}),e.jsx("hr",{}),e.jsxs("div",{className:"d-flex justify-content-between",children:[e.jsx("h4",{children:"Total Amount:"}),e.jsxs("h4",{children:["₹",n]})]})]})]}),e.jsxs("form",{action:"/order/place",method:"POST",children:[e.jsx("input",{type:"hidden",name:"_token",value:document.querySelector('meta[name="csrf-token"]').getAttribute("content")}),e.jsx("input",{type:"hidden",name:"amount",value:n}),e.jsx("input",{type:"hidden",name:"shipping_amount",value:i}),e.jsx("input",{type:"hidden",name:"txnid",value:y||""}),e.jsx("input",{type:"hidden",name:"shipping_charges",value:JSON.stringify(v||{})}),e.jsx("input",{type:"hidden",name:"shipping_id",value:l}),e.jsxs("div",{className:"card mb-4",children:[e.jsx("div",{className:"card-header",children:e.jsxs("h4",{children:["Shipping Details                                                                                                ",e.jsx(A,{href:"/shippingaddress/index",method:"get",as:"button",className:"btn btn-outline-info",children:"Edit / Add Shipping Address"})]})}),e.jsx("div",{className:"card-body",children:_.map(s=>e.jsxs("div",{style:{display:"flex",flexDirection:"row"},children:[e.jsx("input",{onClick:()=>{C(s.shipping_address_id),F(s.shipping_address_id)},type:"radio",className:"me-4",name:"shipping_address",checked:s.shipping_address_id==l}),e.jsxs("div",{children:[e.jsxs("p",{children:[e.jsx("strong",{children:"Name:"})," ",s.shipping_full_name]}),e.jsxs("p",{children:[e.jsx("strong",{children:"Mobile:"})," ",s.shipping_mobile_no]}),e.jsxs("p",{children:[e.jsx("strong",{children:"Address:"})," ",`${s.shipping_address_line1}, ${s.shipping_address_line2}, ${s.shipping_city}, ${s.shipping_state}, ${s.shipping_pincode}`]})]})]}))})]}),e.jsxs("div",{className:"card mb-4",children:[e.jsx("div",{className:"card-header",children:e.jsx("h4",{children:"Payment Options"})}),e.jsx("div",{className:"card-body",children:g.map((s,d)=>e.jsxs("div",{className:"form-check mb-2",children:[e.jsx("input",{disabled:s.payment_mode_name=="Cash On Delivery"&&c==0,className:"form-check-input",type:"radio",name:"paymentmode",id:`paymentMode${s.payment_mode_id}`,value:s.payment_mode_name,defaultChecked:s.default_selected===1,onClick:()=>S(s.payment_mode_name)}),e.jsx("label",{className:"form-check-label",htmlFor:`paymentMode${s.payment_mode_id}`,children:s.payment_mode_name=="Cash On Delivery"&&c==0?"Cod not available":s.payment_mode_name})]},d))})]}),e.jsx("div",{className:"text-center",children:e.jsx("button",{type:"submit",className:"btn btn-primary btn-lg",children:"Place Order"})})]})]})]})}export{I as default};
