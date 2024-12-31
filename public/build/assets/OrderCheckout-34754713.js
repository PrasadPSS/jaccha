import{r,j as e,Y as I,b as P,y as $}from"./app-e30e0a77.js";import{H as E}from"./HomeLayout-703d7e30.js";import"./Header-1f3944ae.js";import"./Footer-f5d6e188.js";function z({auth:n,data:h}){const[i,u]=r.useState({shipping_full_name:n.user.name,shipping_mobile_no:n.user.mobile_no,shipping_address_line1:"",shipping_address_line2:"",shipping_landmark:"NA",shipping_city:"",shipping_pincode:"",shipping_district:"Thane",shipping_state:"",shipping_address_type:"Home",shipping_email:n.user.email,default_address_flag:!1}),{cart:x,user:T,shipping_address:_,shipping_addresses:j,cart_amounts:d,shipping_amount:g,payment_mode:b,order_delivery:H,increment_id:y,shipping_charges:N,grand_total:L,cod_rmk:q,cod_response:v,cod_charges:f}=h,[l,k]=r.useState(g),[o,C]=r.useState(v=="Y"?1:0),[p,A]=r.useState(_.shipping_address_id),[m,S]=r.useState("");let t;m=="Cash On Delivery"?t=parseFloat(d.cart.cart_discounted_total+l+Number(f)).toFixed(2):t=parseFloat(d.cart.cart_discounted_total+l).toFixed(2);const F=parseFloat(d.total_gst).toFixed(2);parseFloat(d.cart.cart_discounted_total-F+d.product_discount-t).toFixed(2);const w=s=>{P.get("/orders/calculaterate/"+s).then(a=>{k(a.data.shipping_amount),C(a.data.cod_response)})},c=s=>{const{name:a,value:O,type:R,checked:M}=s.target;u({...i,[a]:R==="checkbox"?M:O})},D=s=>{s.preventDefault(),$.post(route("address.store"),i,{onSuccess:()=>{console.log("Address submitted successfully")},onError:a=>{console.error("Validation Errors: ",a)}})};return e.jsxs(E,{auth:n,children:[e.jsx(I,{title:"Place Order"}),e.jsx("div",{className:"sub-banner bg-light pb-0",children:e.jsx("div",{className:"container",children:e.jsx("div",{className:"row",children:e.jsx("div",{className:"col-sm-12",children:e.jsxs("div",{className:"banner_heading pb-4",children:[e.jsx("h2",{children:"Checkout"}),e.jsxs("p",{children:[n.cart_count," Items"]})]})})})})}),e.jsx("section",{className:"checkout bg-light",children:e.jsx("div",{className:"container",children:e.jsx("form",{action:"",children:e.jsxs("div",{className:"row",children:[e.jsxs("div",{className:"col-sm-7",children:[e.jsxs("div",{className:"checkout-form pt-5 d-flex align-items-center",children:[e.jsx("h4",{className:"mb-0",children:"Address Details"}),e.jsxs("button",{type:"button",className:"btn add-new-address-btn","data-bs-toggle":"modal","data-bs-target":"#exampleModal",children:[e.jsx("i",{className:"fas fa-plus-circle"})," Add New Address"]})]}),e.jsxs("div",{className:"checkout-form mt-4 payment-details",children:[e.jsx("h4",{className:"",children:"Select Address"}),e.jsx("div",{className:"row",children:j.map(s=>e.jsx("div",{className:"col-sm-12",children:e.jsxs("div",{className:"form-check payment-radio-btn",children:[e.jsx("input",{onClick:()=>{A(s.shipping_address_id),w(s.shipping_address_id)},checked:s.shipping_address_id==p,className:"form-check-input",type:"radio",name:"flexRadioDefault",id:"flexRadioDefault1"}),e.jsx("label",{className:"form-check-label",htmlFor:"flexRadioDefault1",children:`${s.shipping_address_line1}, ${s.shipping_address_line2}, ${s.shipping_city}, ${s.shipping_state}, ${s.shipping_pincode}`})]})},s.shipping_address_id))})]}),e.jsxs("div",{className:"checkout-form mt-4 payment-details",children:[e.jsx("h4",{className:"",children:"Payment"}),e.jsx("p",{className:"mb-4",children:"All transactions are secure and encrypted."}),e.jsx("div",{className:"row",children:b.map((s,a)=>e.jsx("div",{className:"col-sm-12",children:e.jsxs("div",{className:"form-check payment-radio-btn",children:[e.jsx("input",{className:"form-check-input",type:"radio",name:"paymentRadioDefault",id:`paymentMode${s.payment_mode_id}`,disabled:s.payment_mode_name=="Cash On Delivery"&&o==0,onClick:()=>S(s.payment_mode_name),defaultChecked:s.default_selected===1}),e.jsxs("div",{className:"d-flex payment-btn-img",children:[e.jsx("label",{className:"form-check-label",htmlFor:"flexRadioDefault1",children:s.payment_mode_name=="Cash On Delivery"&&o==0?"Cod not available":s.payment_mode_name}),s.payment_mode_name!="Cash On Delivery"&&e.jsxs("div",{children:[e.jsx("img",{src:"/assets/images/payment/visa.png"}),e.jsx("img",{src:"/assets/images/payment/maestro.png"}),e.jsx("img",{src:"/assets/images/payment/mastercard.png"}),e.jsx("img",{src:"/assets/images/payment/amex.png"}),e.jsx("button",{children:"+4"})]})]})]})}))})]})]}),e.jsx("div",{className:"col-sm-5",children:e.jsxs("div",{className:"checkout-right",children:[x.map((s,a)=>e.jsxs("div",{className:"checkout-product mb-3",children:[e.jsxs("div",{className:"checkout-product_img position-relative",children:[e.jsx("img",{src:"/backend-assets/uploads/product_thumbs/"+s.products.product_thumb,alt:""}),e.jsx("p",{children:s.qty})]}),e.jsxs("div",{className:"checkout-product_content",children:[e.jsx("h5",{children:s.products.product_title}),e.jsxs("p",{children:[s.products.product_weight,"gm | ",s.sweetness_level," Sweetness | ",s.ingredient_addons," | No ",s.ingredient_exclusions]})]}),e.jsx("div",{className:"checkout-product_price",children:e.jsxs("p",{children:["₹",s.product_variant_id?s.product_variant.product_price:s.products.product_price,".00"]})})]})),e.jsxs("div",{className:"payment-history mt-5",children:[e.jsxs("div",{className:"payment-display mb-2",children:[e.jsxs("p",{children:["Subtotal . ",n.cart_count," Items"]}),e.jsxs("p",{children:["₹",t-parseFloat(l).toFixed(2)," "]})]}),e.jsxs("div",{className:"payment-display mb-3",children:[e.jsx("p",{children:"Shipping"}),e.jsxs("p",{children:["₹",parseFloat(l).toFixed(2)]})]}),e.jsxs("div",{className:"payment-display",children:[e.jsx("p",{children:e.jsx("b",{children:"Total"})}),e.jsx("p",{children:e.jsxs("b",{children:["₹",t]})})]})]}),e.jsxs("form",{action:"/order/place",method:"POST",children:[e.jsx("input",{type:"hidden",name:"_token",value:document.querySelector('meta[name="csrf-token"]').getAttribute("content")}),e.jsx("input",{type:"hidden",name:"amount",value:t}),e.jsx("input",{type:"hidden",name:"shipping_amount",value:l}),e.jsx("input",{type:"hidden",name:"txnid",value:y||""}),e.jsx("input",{type:"hidden",name:"shipping_charges",value:JSON.stringify(N||{})}),e.jsx("input",{type:"hidden",name:"shipping_id",value:p}),e.jsx("input",{type:"hidden",name:"paymentmode",value:m}),e.jsx("div",{className:"pay-now-button",children:e.jsx("button",{type:"submit",children:"Pay now & Confirm Order"})})]})]})})]})})})}),e.jsx("div",{className:"modal fade",id:"exampleModal",tabIndex:"-1","aria-labelledby":"exampleModalLabel","aria-hidden":"true",children:e.jsx("div",{className:"modal-dialog add-address-form",children:e.jsxs("div",{className:"modal-content bg-light py-2",children:[e.jsxs("div",{className:"modal-header",children:[e.jsx("h5",{className:"modal-title text-center m-auto",id:"exampleModalLabel",children:"Add new Address"}),e.jsx("button",{type:"button",className:"btn-close","data-bs-dismiss":"modal","aria-label":"Close",children:e.jsx("i",{className:"far fa-times"})})]}),e.jsxs("form",{action:"",onSubmit:D,children:[e.jsx("div",{className:"modal-body",children:e.jsxs("div",{className:"row",action:"",children:[e.jsx("div",{className:"col-sm-12",children:e.jsx("div",{className:"form-inputs mb-3",children:e.jsx("input",{type:"text",className:"form-control",placeholder:"Address",id:"shipping_address_line1",name:"shipping_address_line1",value:i.shipping_address_line1,onChange:c})})}),e.jsx("div",{className:"col-sm-12",children:e.jsx("div",{className:"form-inputs mb-3",children:e.jsx("input",{type:"text",className:"form-control",placeholder:"Apartment (Optional)",id:"shipping_address_line2",name:"shipping_address_line2",value:i.shipping_address_line2,onChange:c})})}),e.jsx("div",{className:"col-sm-6",children:e.jsx("div",{className:"form-inputs mb-3",children:e.jsx("input",{type:"text",className:"form-control",placeholder:"City",id:"shipping_city",name:"shipping_city",value:i.shipping_city,onChange:c})})}),e.jsx("div",{className:"col-sm-6",children:e.jsx("div",{className:"form-inputs mb-3",children:e.jsx("input",{type:"number",className:"form-control",placeholder:"Post Code",id:"shipping_pincode",name:"shipping_pincode",value:i.shipping_pincode,onChange:c})})}),e.jsx("div",{className:"col-sm-6",children:e.jsx("div",{className:"form-inputs",children:e.jsx("input",{type:"text",className:"form-control",placeholder:"Country/Region",id:"shipping_state",name:"shipping_state",value:i.shipping_state,onChange:c})})}),e.jsx("div",{className:"col-sm-6",children:e.jsx("div",{className:"form-inputs",children:e.jsx("input",{type:"number",className:"form-control",placeholder:"Alternate Contact Number",id:"exampleAddress"})})})]})}),e.jsxs("div",{className:"modal-footer m-auto border-0",children:[e.jsx("button",{type:"submit",className:"btn button black",children:"Add Address"}),e.jsx("button",{type:"button",className:"button cancel_btn black","data-bs-dismiss":"modal",children:"Cancel"})]})]})]})})})]})}export{z as default};