import{q as ee,r as a,j as e,Y as se,b as ae,y as ie}from"./app-35b7e9e3.js";import{H as ne}from"./HomeLayout-ecd99da4.js";import te from"./DiscountCode-5629622a.js";import"./react-toastify.esm-3b10c93f.js";import{I as l}from"./InputError-d8b59aaa.js";import"./Header-9757cea0.js";import"./Footer-3326279c.js";function je({auth:g,data:S,districts:b}){let F=ee().props.auth.csrf_token;const D=b.filter((s,i,u)=>i===u.findIndex(v=>v.state_name===s.state_name)),[n,A]=a.useState({shipping_full_name:"",shipping_mobile_no:"",shipping_address_line1:"",shipping_address_line2:"",shipping_landmark:"",shipping_city:"",shipping_pincode:"",shipping_district:"",shipping_state:"",shipping_address_type:"",shipping_email:"",default_address_flag:!1}),[d,O]=a.useState(""),[j,w]=a.useState(""),[E,de]=a.useState(D),[I,M]=a.useState([]),{cart:R,user:le,shipping_address:T,shipping_addresses:G,cart_amounts:p,shipping_amount:L,payment_mode:P,order_delivery:ce,increment_id:H,shipping_charges:q,grand_total:re,cod_rmk:W,cod_response:Y,cod_charges:m}=S,[f,oe]=a.useState(m),[c,J]=a.useState(L),[y,V]=a.useState(Y=="Y"?1:0),[C,z]=a.useState(T.shipping_address_id),[r,B]=a.useState("");let o;r=="Cash On Delivery"?o=parseFloat(p.cart.cart_discounted_total+c+Number(m)).toFixed(2):o=parseFloat(p.cart.cart_discounted_total+c).toFixed(2);const h=parseFloat(p.total_gst).toFixed(2);parseFloat(p.cart.cart_discounted_total-h+p.product_discount-o).toFixed(2);const K=s=>{ae.get("/orders/calculaterate/"+s).then(i=>{_((Number(x)-Number(c)+Number(i.data.shipping_amount)).toFixed(2)),J(i.data.shipping_amount),V(i.data.cod_response)})},t=s=>{const{name:i,value:u,type:v,checked:Z}=s.target;A({...n,[i]:v==="checkbox"?Z:u}),i=="shipping_state"&&w(u),i=="shipping_district"&&setSelectedDistrict(u)};a.useEffect(()=>M(b.filter(s=>s.state_name==j)),[j]),a.useEffect(()=>{r=="Cash On Delivery"&&_(s=>(Number(s)+Number(f)).toFixed(2)),r=="Online Payment"&&_(s=>(Number(s)-Number(m)).toFixed(2))},[r]);const Q=s=>{s.preventDefault(),ie.post(route("address.store"),n,{onSuccess:()=>{console.log("Address submitted successfully"),$("#exampleModal").modal("hide")},onError:i=>(O(i),!1)})},[x,_]=a.useState(o),[k,U]=a.useState(""),[N,X]=a.useState(0);return e.jsxs(ne,{auth:g,children:[e.jsx(se,{title:"Place Order"}),e.jsx("div",{className:"sub-banner bg-light pb-0",children:e.jsx("div",{className:"container",children:e.jsx("div",{className:"row",children:e.jsx("div",{className:"col-sm-12",children:e.jsxs("div",{className:"banner_heading pb-4",children:[e.jsx("h2",{children:"Checkout"}),e.jsxs("p",{children:[g.cart_count," Items"]})]})})})})}),e.jsx("section",{className:"checkout bg-light",children:e.jsx("div",{className:"container",children:e.jsx("form",{action:"",children:e.jsxs("div",{className:"row",children:[e.jsxs("div",{className:"col-sm-7",children:[e.jsxs("div",{className:"checkout-form pt-5 d-flex align-items-center",children:[e.jsx("h4",{className:"mb-0",children:"Address Details"}),e.jsxs("button",{type:"button",className:"btn add-new-address-btn","data-bs-toggle":"modal","data-bs-target":"#exampleModal",children:[e.jsx("i",{className:"fas fa-plus-circle"})," Add New Address"]})]}),e.jsxs("div",{className:"checkout-form mt-4 payment-details",children:[e.jsx("h4",{className:"",children:"Select Address"}),e.jsx("div",{className:"row",children:G.map(s=>e.jsx("div",{className:"col-sm-12",children:e.jsxs("div",{className:"form-check payment-radio-btn",children:[e.jsx("input",{onClick:()=>{z(s.shipping_address_id),K(s.shipping_address_id)},checked:s.shipping_address_id==C,className:"form-check-input",type:"radio",name:"flexRadioDefault",id:"flexRadioDefault2"+s.shipping_address_id}),e.jsx("label",{className:"form-check-label",htmlFor:"flexRadioDefault2"+s.shipping_address_id,children:`${s.shipping_address_line1}, ${s.shipping_address_line2}, ${s.shipping_city}, ${s.shipping_state}, ${s.shipping_pincode}`})]})},s.shipping_address_id))})]}),e.jsxs("div",{className:"checkout-form mt-4 payment-details",children:[e.jsx("h4",{className:"",children:"Payment"}),e.jsx("p",{className:"mb-4",children:"All transactions are secure and encrypted."}),e.jsx("div",{className:"row",children:P.map((s,i)=>e.jsx("div",{className:"col-sm-12",children:e.jsxs("div",{className:"form-check payment-radio-btn",children:[e.jsx("input",{className:"form-check-input",type:"radio",name:"paymentRadioDefault",id:`paymentMode${s.payment_mode_id}`,disabled:s.payment_mode_name=="Cash On Delivery"&&y==0,onClick:()=>B(s.payment_mode_name),defaultChecked:s.default_selected===1}),e.jsxs("div",{className:"d-flex payment-btn-img",children:[e.jsx("label",{className:"form-check-label",htmlFor:"flexRadioDefault"+i,children:s.payment_mode_name=="Cash On Delivery"&&y==0?W:s.payment_mode_name}),s.payment_mode_name!="Cash On Delivery"&&e.jsxs("div",{children:[e.jsx("img",{src:"/assets/images/payment/visa.png"}),e.jsx("img",{src:"/assets/images/payment/maestro.png"}),e.jsx("img",{src:"/assets/images/payment/mastercard.png"}),e.jsx("img",{src:"/assets/images/payment/amex.png"}),e.jsx("button",{type:"button",children:"+4"})]})]})]})}))})]})]}),e.jsx("div",{className:"col-sm-5",children:e.jsxs("div",{className:"checkout-right",children:[R.map((s,i)=>e.jsxs("div",{className:"checkout-product mb-3",children:[e.jsxs("div",{className:"checkout-product_img position-relative",children:[e.jsx("img",{src:"/backend-assets/uploads/product_thumbs/"+s.products.product_thumb,alt:""}),e.jsx("p",{children:s.qty})]}),e.jsxs("div",{className:"checkout-product_content",children:[e.jsx("h5",{children:s.product_variant_id==null?s.products.product_title:s.product_variant.product_title}),e.jsx("p",{})]}),e.jsx("div",{className:"checkout-product_price",children:e.jsxs("p",{children:["₹",s.product_variant_id?s.product_variant.product_price:s.products.product_price,".00"]})})]})),e.jsx(te,{couponCode1:k,setCouponCode1:U,setCouponDiscount:X,paymentMode:r,gstCharges:h,shippingAmount:c,codCharges:Number(m).toFixed(2),finalGrandTotal:x,setFinalGrandTotal:_}),e.jsxs("div",{className:"payment-history mt-5",children:[e.jsxs("div",{className:"payment-display mb-2",children:[e.jsxs("p",{children:["Subtotal . ",g.cart_count," Items"]}),e.jsxs("p",{children:["₹",r=="Cash On Delivery"?(o-parseFloat(c).toFixed(2)-Number(m)-Number(h)).toFixed(2):(o-parseFloat(c).toFixed(2)-Number(h)).toFixed(2)]})]}),e.jsxs("div",{className:"payment-display mb-2",children:[e.jsx("p",{children:"Gst Charges"}),e.jsxs("p",{children:["₹",h]})]}),e.jsxs("div",{className:"payment-display mb-3",children:[e.jsx("p",{children:"Shipping"}),e.jsxs("p",{children:["₹",parseFloat(c).toFixed(2)]})]}),e.jsxs("div",{className:"payment-display mb-3",children:[e.jsx("p",{children:"COD Charges"}),e.jsxs("p",{children:["₹",r=="Cash On Delivery"?Number(f).toFixed(2):0 .toFixed(2)]})]}),N!=0&&e.jsxs("div",{className:"payment-display mb-3",children:[e.jsx("p",{children:"Coupon Discount"}),e.jsxs("p",{children:["- ₹",Number(N).toFixed(2)]})]}),e.jsxs("div",{className:"payment-display",children:[e.jsx("p",{children:e.jsx("b",{children:"Total"})}),e.jsx("p",{children:e.jsxs("b",{children:["₹",x]})})]})]}),e.jsxs("form",{action:"/order/place",method:"POST",children:[e.jsx("input",{type:"hidden",name:"_token",value:F}),e.jsx("input",{type:"hidden",name:"amount",value:x}),e.jsx("input",{type:"hidden",name:"shipping_amount",value:c}),e.jsx("input",{type:"hidden",name:"txnid",value:H||""}),e.jsx("input",{type:"hidden",name:"shipping_charges",value:JSON.stringify(q||{})}),e.jsx("input",{type:"hidden",name:"shipping_id",value:C}),e.jsx("input",{type:"hidden",name:"paymentmode",value:r}),e.jsx("input",{type:"hidden",name:"couponcode",value:k}),e.jsx("input",{type:"hidden",name:"coupondiscount",value:N}),e.jsx("div",{className:"pay-now-button",children:e.jsx("button",{type:"submit",children:"Pay now & Confirm Order"})})]})]})})]})})})}),e.jsx("div",{className:"modal fade address-modal",id:"exampleModal",tabindex:"-1","aria-labelledby":"exampleModalLabel","aria-hidden":"true",children:e.jsx("form",{onSubmit:Q,className:"modal-dialog add-address-form",children:e.jsxs("div",{className:"modal-content bg-light py-2",children:[e.jsxs("div",{className:"modal-header",children:[e.jsx("h5",{className:"modal-title text-center m-auto",id:"exampleModalLabel",children:"Add Shipping Address"}),e.jsx("button",{type:"button",className:"btn-close","data-bs-dismiss":"modal","aria-label":"Close",children:e.jsx("i",{className:"far fa-times"})})]}),e.jsx("div",{className:"modal-body",children:e.jsxs("div",{className:"row",children:[e.jsx("div",{className:"col-sm-6",children:e.jsxs("div",{className:"form-inputs mb-3",children:[e.jsx("input",{type:"text",className:"form-control",placeholder:"Full Name",id:"shipping_full_name",name:"shipping_full_name",value:n.shipping_full_name,onChange:t}),e.jsx(l,{message:d.shipping_full_name,className:"mt-2"})]})}),e.jsx("div",{className:"col-sm-6",children:e.jsxs("div",{className:"form-inputs mb-3",children:[e.jsx("input",{type:"number",className:"form-control",placeholder:"Contact Number",id:"shipping_mobile_no",name:"shipping_mobile_no",value:n.shipping_mobile_no,onChange:t}),e.jsx(l,{message:d.shipping_mobile_no,className:"mt-2"})]})}),e.jsx("div",{className:"col-sm-6",children:e.jsxs("div",{className:"form-inputs mb-3",children:[e.jsx("input",{type:"text",className:"form-control",placeholder:"Address Line 1",id:"shipping_address_line1",name:"shipping_address_line1",value:n.shipping_address_line1,onChange:t}),e.jsx(l,{message:d.shipping_address_line1,className:"mt-2"})]})}),e.jsx("div",{className:"col-sm-6",children:e.jsxs("div",{className:"form-inputs mb-3",children:[e.jsx("input",{type:"text",className:"form-control",placeholder:"Address Line 2",id:"shipping_address_line2",name:"shipping_address_line2",value:n.shipping_address_line2,onChange:t}),e.jsx(l,{message:d.shipping_address_line2,className:"mt-2"})]})}),e.jsx("div",{className:"col-sm-4",children:e.jsxs("div",{className:"form-inputs mb-3",children:[e.jsx("input",{type:"text",className:"form-control",placeholder:"Landmark",id:"shipping_landmark",name:"shipping_landmark",value:n.shipping_landmark,onChange:t}),e.jsx(l,{message:d.shipping_landmark,className:"mt-2"})]})}),e.jsx("div",{className:"col-sm-4",children:e.jsxs("div",{className:"form-inputs mb-3",children:[e.jsx("input",{type:"text",className:"form-control",placeholder:"City",id:"shipping_city",name:"shipping_city",value:n.shipping_city,onChange:t}),e.jsx(l,{message:d.shipping_city,className:"mt-2"})]})}),e.jsx("div",{className:"col-sm-4",children:e.jsxs("div",{className:"form-inputs mb-3",children:[e.jsx("input",{type:"number",className:"form-control",placeholder:"Pincode",id:"shipping_pincode",name:"shipping_pincode",value:n.shipping_pincode,onChange:t}),e.jsx(l,{message:d.shipping_pincode,className:"mt-2"})]})}),e.jsx("div",{className:"col-sm-4",children:e.jsxs("div",{className:"form-inputs mb-3",children:[e.jsxs("select",{className:"form-control",id:"shipping_state",name:"shipping_state",value:j,onChange:t,children:[e.jsx("option",{value:"",selected:!0,disabled:!0,children:"Select State"}),E.map(s=>e.jsx("option",{value:s.state_name,children:s.state_name}))]}),e.jsx(l,{message:d.shipping_state,className:"mt-2"})]})}),e.jsx("div",{className:"col-sm-4",children:e.jsxs("div",{className:"form-inputs mb-3",children:[e.jsxs("select",{className:"form-control",id:"shipping_district",name:"shipping_district",value:n.shipping_district,onChange:t,children:[e.jsx("option",{value:"",selected:!0,disabled:!0,children:"Select District"}),I.map(s=>e.jsx("option",{value:s.name,children:s.name}))]}),e.jsx(l,{message:d.shipping_district,className:"mt-2"})]})}),e.jsx("div",{className:"col-sm-4",children:e.jsxs("div",{className:"form-inputs mb-3",children:[e.jsx("input",{type:"text",className:"form-control",placeholder:"E-mail Address",id:"shipping_email",name:"shipping_email",value:n.shipping_email,onChange:t}),e.jsx(l,{message:d.shipping_email,className:"mt-2"})]})}),e.jsx("div",{className:"col-sm-6",children:e.jsxs("div",{className:"form-inputs mb-3",children:[e.jsxs("select",{className:"form-control",id:"shipping_address_type",name:"shipping_address_type",value:n.shipping_address_type,onChange:t,children:[e.jsx("option",{value:"",children:"Select Address Type"}),e.jsx("option",{value:"Home",children:"Home"}),e.jsx("option",{value:"Work",children:"Work"}),e.jsx("option",{value:"Other",children:"Other"})]}),e.jsx(l,{message:d.shipping_address_type,className:"mt-2"})]})}),e.jsx("div",{className:"col-sm-4",children:e.jsx("div",{className:"form-inputs mb-3",children:e.jsxs("label",{for:"defaultAddress",children:[e.jsx("input",{type:"checkbox",id:"default_address_flag",name:"default_address_flag",value:n.default_address_flag,onChange:t})," Set as Default Address"]})})})]})}),e.jsxs("div",{className:"modal-footer m-auto border-0",children:[e.jsx("button",{type:"submit",className:"btn button black",children:"Add Address"}),e.jsx("button",{type:"button",className:"button cancel_btn black","data-bs-dismiss":"modal",children:"Cancel"})]})]})})})]})}export{je as default};
