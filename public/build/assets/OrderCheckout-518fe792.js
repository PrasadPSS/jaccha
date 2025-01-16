import{q as $,r,j as e,Y as E,b as T,y as G}from"./app-cd7254cd.js";import{H}from"./HomeLayout-cf4ecd77.js";import"./Header-0858a810.js";import"./Footer-f827f8c5.js";import"./InputError-0f04a3f1.js";function Q({auth:t,data:_}){let j=$().props.auth.csrf_token;const[i,g]=r.useState({shipping_full_name:t.user.name,shipping_mobile_no:t.user.mobile_no,shipping_address_line1:"",shipping_address_line2:"",shipping_landmark:"NA",shipping_city:"",shipping_pincode:"",shipping_district:"Thane",shipping_state:"",shipping_address_type:"Home",shipping_email:t.user.email,default_address_flag:!1}),{cart:y,user:L,shipping_address:b,shipping_addresses:N,cart_amounts:l,shipping_amount:v,payment_mode:f,order_delivery:q,increment_id:k,shipping_charges:C,grand_total:Y,cod_rmk:m,cod_response:A,cod_charges:p}=_;console.log("rmk",m);const[d,F]=r.useState(v),[h,D]=r.useState(A=="Y"?1:0),[x,S]=r.useState(b.shipping_address_id),[o,O]=r.useState("");let n;o=="Cash On Delivery"?n=parseFloat(l.cart.cart_discounted_total+d+Number(p)).toFixed(2):n=parseFloat(l.cart.cart_discounted_total+d).toFixed(2);const u=parseFloat(l.total_gst).toFixed(2);parseFloat(l.cart.cart_discounted_total-u+l.product_discount-n).toFixed(2);const w=s=>{console.log("cod_response_null"),T.get("/orders/calculaterate/"+s).then(a=>{F(a.data.shipping_amount),D(a.data.cod_response),console.log("cod_response",a)})},c=s=>{const{name:a,value:M,type:I,checked:P}=s.target;g({...i,[a]:I==="checkbox"?P:M})},R=s=>{s.preventDefault(),G.post(route("address.store"),i,{onSuccess:()=>{console.log("Address submitted successfully")},onError:a=>{console.error("Validation Errors: ",a)}})};return e.jsxs(H,{auth:t,children:[e.jsx(E,{title:"Place Order"}),e.jsx("div",{className:"sub-banner bg-light pb-0",children:e.jsx("div",{className:"container",children:e.jsx("div",{className:"row",children:e.jsx("div",{className:"col-sm-12",children:e.jsxs("div",{className:"banner_heading pb-4",children:[e.jsx("h2",{children:"Checkout"}),e.jsxs("p",{children:[t.cart_count," Items"]})]})})})})}),e.jsx("section",{className:"checkout bg-light",children:e.jsx("div",{className:"container",children:e.jsx("form",{action:"",children:e.jsxs("div",{className:"row",children:[e.jsxs("div",{className:"col-sm-7",children:[e.jsxs("div",{className:"checkout-form pt-5 d-flex align-items-center",children:[e.jsx("h4",{className:"mb-0",children:"Address Details"}),e.jsxs("button",{type:"button",className:"btn add-new-address-btn","data-bs-toggle":"modal","data-bs-target":"#exampleModal",children:[e.jsx("i",{className:"fas fa-plus-circle"})," Add New Address"]})]}),e.jsxs("div",{className:"checkout-form mt-4 payment-details",children:[e.jsx("h4",{className:"",children:"Select Address"}),e.jsx("div",{className:"row",children:N.map(s=>e.jsx("div",{className:"col-sm-12",children:e.jsxs("div",{className:"form-check payment-radio-btn",children:[e.jsx("input",{onClick:()=>{S(s.shipping_address_id),w(s.shipping_address_id)},checked:s.shipping_address_id==x,className:"form-check-input",type:"radio",name:"flexRadioDefault",id:"flexRadioDefault2"+s.shipping_address_id}),e.jsx("label",{className:"form-check-label",htmlFor:"flexRadioDefault2"+s.shipping_address_id,children:`${s.shipping_address_line1}, ${s.shipping_address_line2}, ${s.shipping_city}, ${s.shipping_state}, ${s.shipping_pincode}`})]})},s.shipping_address_id))})]}),e.jsxs("div",{className:"checkout-form mt-4 payment-details",children:[e.jsx("h4",{className:"",children:"Payment"}),e.jsx("p",{className:"mb-4",children:"All transactions are secure and encrypted."}),e.jsx("div",{className:"row",children:f.map((s,a)=>e.jsx("div",{className:"col-sm-12",children:e.jsxs("div",{className:"form-check payment-radio-btn",children:[e.jsx("input",{className:"form-check-input",type:"radio",name:"paymentRadioDefault",id:`paymentMode${s.payment_mode_id}`,disabled:s.payment_mode_name=="Cash On Delivery"&&h==0,onClick:()=>O(s.payment_mode_name),defaultChecked:s.default_selected===1}),e.jsxs("div",{className:"d-flex payment-btn-img",children:[e.jsx("label",{className:"form-check-label",htmlFor:"flexRadioDefault"+a,children:s.payment_mode_name=="Cash On Delivery"&&h==0?m:s.payment_mode_name}),s.payment_mode_name!="Cash On Delivery"&&e.jsxs("div",{children:[e.jsx("img",{src:"/assets/images/payment/visa.png"}),e.jsx("img",{src:"/assets/images/payment/maestro.png"}),e.jsx("img",{src:"/assets/images/payment/mastercard.png"}),e.jsx("img",{src:"/assets/images/payment/amex.png"}),e.jsx("button",{type:"button",children:"+4"})]})]})]})}))})]})]}),e.jsx("div",{className:"col-sm-5",children:e.jsxs("div",{className:"checkout-right",children:[y.map((s,a)=>e.jsxs("div",{className:"checkout-product mb-3",children:[e.jsxs("div",{className:"checkout-product_img position-relative",children:[e.jsx("img",{src:"/backend-assets/uploads/product_thumbs/"+s.products.product_thumb,alt:""}),e.jsx("p",{children:s.qty})]}),e.jsxs("div",{className:"checkout-product_content",children:[e.jsx("h5",{children:s.products.product_title}),e.jsx("p",{})]}),e.jsx("div",{className:"checkout-product_price",children:e.jsxs("p",{children:["₹",s.product_variant_id?s.product_variant.product_price:s.products.product_price,".00"]})})]})),e.jsxs("div",{className:"payment-history mt-5",children:[e.jsxs("div",{className:"payment-display mb-2",children:[e.jsxs("p",{children:["Subtotal . ",t.cart_count," Items"]}),e.jsxs("p",{children:["₹",o=="Cash On Delivery"?n-parseFloat(d).toFixed(2)-Number(p):n-parseFloat(d).toFixed(2)]})]}),e.jsxs("div",{className:"payment-display mb-2",children:[e.jsx("p",{children:"Gst Charges"}),e.jsxs("p",{children:["₹",u]})]}),e.jsxs("div",{className:"payment-display mb-3",children:[e.jsx("p",{children:"Shipping"}),e.jsxs("p",{children:["₹",parseFloat(d).toFixed(2)]})]}),e.jsxs("div",{className:"payment-display mb-3",children:[e.jsx("p",{children:"COD Charges"}),e.jsxs("p",{children:["₹",o=="Cash On Delivery"?Number(p).toFixed(2):0]})]}),e.jsxs("div",{className:"payment-display",children:[e.jsx("p",{children:e.jsx("b",{children:"Total"})}),e.jsx("p",{children:e.jsxs("b",{children:["₹",n]})})]})]}),e.jsxs("form",{action:"/order/place",method:"POST",children:[e.jsx("input",{type:"hidden",name:"_token",value:j}),e.jsx("input",{type:"hidden",name:"amount",value:n}),e.jsx("input",{type:"hidden",name:"shipping_amount",value:d}),e.jsx("input",{type:"hidden",name:"txnid",value:k||""}),e.jsx("input",{type:"hidden",name:"shipping_charges",value:JSON.stringify(C||{})}),e.jsx("input",{type:"hidden",name:"shipping_id",value:x}),e.jsx("input",{type:"hidden",name:"paymentmode",value:o}),e.jsx("div",{className:"pay-now-button",children:e.jsx("button",{type:"submit",children:"Pay now & Confirm Order"})})]})]})})]})})})}),e.jsx("div",{className:"modal fade",id:"exampleModal",tabIndex:"-1","aria-labelledby":"exampleModalLabel","aria-hidden":"true",children:e.jsx("div",{className:"modal-dialog add-address-form",children:e.jsxs("div",{className:"modal-content bg-light py-2",children:[e.jsxs("div",{className:"modal-header",children:[e.jsx("h5",{className:"modal-title text-center m-auto",id:"exampleModalLabel",children:"Add new Address"}),e.jsx("button",{type:"button",className:"btn-close","data-bs-dismiss":"modal","aria-label":"Close",children:e.jsx("i",{className:"far fa-times"})})]}),e.jsxs("form",{action:"",onSubmit:R,children:[e.jsx("div",{className:"modal-body",children:e.jsxs("div",{className:"row",action:"",children:[e.jsx("div",{className:"col-sm-12",children:e.jsx("div",{className:"form-inputs mb-3",children:e.jsx("input",{type:"text",className:"form-control",placeholder:"Address",id:"shipping_address_line1",name:"shipping_address_line1",value:i.shipping_address_line1,onChange:c})})}),e.jsx("div",{className:"col-sm-12",children:e.jsx("div",{className:"form-inputs mb-3",children:e.jsx("input",{type:"text",className:"form-control",placeholder:"Apartment (Optional)",id:"shipping_address_line2",name:"shipping_address_line2",value:i.shipping_address_line2,onChange:c})})}),e.jsx("div",{className:"col-sm-6",children:e.jsx("div",{className:"form-inputs mb-3",children:e.jsx("input",{type:"text",className:"form-control",placeholder:"City",id:"shipping_city",name:"shipping_city",value:i.shipping_city,onChange:c})})}),e.jsx("div",{className:"col-sm-6",children:e.jsx("div",{className:"form-inputs mb-3",children:e.jsx("input",{type:"number",className:"form-control",placeholder:"Post Code",id:"shipping_pincode",name:"shipping_pincode",value:i.shipping_pincode,onChange:c})})}),e.jsx("div",{className:"col-sm-6",children:e.jsx("div",{className:"form-inputs",children:e.jsx("input",{type:"text",className:"form-control",placeholder:"Country/Region",id:"shipping_state",name:"shipping_state",value:i.shipping_state,onChange:c})})}),e.jsx("div",{className:"col-sm-6",children:e.jsx("div",{className:"form-inputs",children:e.jsx("input",{type:"number",className:"form-control",placeholder:"Alternate Contact Number",id:"exampleAddress"})})})]})}),e.jsxs("div",{className:"modal-footer m-auto border-0",children:[e.jsx("button",{type:"submit",className:"btn button black",children:"Add Address"}),e.jsx("button",{type:"button",className:"button cancel_btn black","data-bs-dismiss":"modal",children:"Cancel"})]})]})]})})})]})}export{Q as default};
