import{j as s,Y as l}from"./app-35b7e9e3.js";import{H as n}from"./HomeLayout-ecd99da4.js";import"./react-toastify.esm-3b10c93f.js";import"./Header-9757cea0.js";import"./Footer-3326279c.js";import"./InputError-d8b59aaa.js";function j({auth:c,orders:e,estimatedtime:a}){console.log("orders",e);const r=new Date;return new Date().setDate(r.getDate()+5),s.jsxs(n,{auth:c,children:[s.jsx(l,{title:"Order Success"}),s.jsx("div",{className:"sub-banner  pb-0",children:s.jsx("div",{className:"container",children:s.jsx("div",{className:"row",children:s.jsx("div",{className:"col-sm-12",children:s.jsxs("div",{className:"banner_heading pb-4 thank_heading",children:[s.jsxs("div",{children:[s.jsxs("h2",{children:[s.jsx("img",{src:"/assets/images/congrats.png",alt:"Jaccha Website Icon",className:"img-fluid congrats-icon mb-2"})," Thank You for Your Order!"]}),s.jsx("p",{children:"Your journey to wellness begins here. We’re excited to serve you!"})]}),s.jsx("div",{children:s.jsxs("p",{children:["Order Id : ",s.jsxs("span",{children:["#",e.orders_counter_id]})]})})]})})})})}),s.jsx("section",{className:"checkout thankYou",children:s.jsx("div",{className:"container pt-4",children:s.jsx("form",{action:"",children:s.jsxs("div",{className:"row pt-2 g-5",children:[s.jsx("div",{className:"col-sm-5",children:s.jsxs("div",{className:"checkout-right-wrap",children:[s.jsx("h2",{className:"pb-4 order-title",children:"Order Summary"}),s.jsxs("div",{className:"checkout-right position-static",children:[e.orderproducts.map(i=>s.jsxs("div",{className:"checkout-product mb-3",children:[s.jsxs("div",{className:"checkout-product_img position-relative",children:[s.jsx("img",{src:"/backend-assets/uploads/product_thumbs/"+i.products.product_thumb,alt:""}),s.jsx("p",{children:i.qty})]}),s.jsx("div",{className:"checkout-product_content",children:s.jsx("h5",{children:i.product_title})}),s.jsx("div",{className:"checkout-product_price",children:s.jsxs("p",{children:["₹",i.product_price,".00"]})})]})),s.jsxs("div",{className:"payment-history mt-5",children:[s.jsxs("div",{className:"payment-display mb-2",children:[s.jsxs("p",{children:["Subtotal . ",e.orderproducts.length," Items"]}),s.jsxs("p",{children:["₹",Number(e.total_mrp).toFixed(2)]})]}),s.jsxs("div",{className:"payment-display mb-3",children:[s.jsx("p",{children:"Gst Charges"}),s.jsxs("p",{children:["₹",Math.sign(Number(e.total_mrp_dicount))*Number(e.total_mrp_dicount),".00"]})]}),e.cod_collection_charge!==null?s.jsxs("div",{className:"payment-display mb-3",children:[s.jsx("p",{children:"COD Charges"}),s.jsxs("p",{children:["₹",e.cod_collection_charge]})]}):"",e.coupon_discount!=null&&s.jsxs("div",{className:"payment-display mb-3",children:[s.jsx("p",{children:"Coupon Discount"}),s.jsxs("p",{children:["- ₹",e.coupon_discount]})]}),s.jsxs("div",{className:"payment-display mb-3",children:[s.jsx("p",{children:"Shipping"}),s.jsxs("p",{children:["₹",e.shipping_amount,".00"]})]}),s.jsxs("div",{className:"payment-display",children:[s.jsx("p",{children:s.jsx("b",{children:"Total"})}),s.jsx("p",{children:s.jsxs("b",{children:["₹",e.total,".00"]})})]})]})]}),s.jsxs("div",{className:"what-next mt-5 pt-2 ",children:[s.jsx("h2",{className:"pb-4 order-title",children:"What Next?"}),s.jsxs("ul",{className:"mb-4 pb-2",children:[s.jsx("li",{children:" Processing Your Order"}),s.jsx("li",{children:" Track Your Order"}),s.jsx("li",{children:s.jsx("a",{href:"/faq/view",children:"Need Help?"})})]}),s.jsx("a",{href:"/orders/view",id:"trackMyorder",className:"track-order-btn me-3",children:"Track My Order"}),s.jsx("a",{href:"/products",id:"continueShopping",className:"track-order-btn",children:"Continue Shopping"})]})]})}),s.jsx("div",{className:"col-sm-7",children:s.jsxs("div",{className:"delivery-details",children:[s.jsx("h2",{className:"pb-4 pt-2 order-title",children:"Delivery Details"}),s.jsxs("p",{children:[s.jsx("strong",{children:"Estimated Delivery: "}),a]}),s.jsx("p",{id:"shipStatus",className:"pt-2 pb-4",children:"🚚 Shipping Status: Processing"}),s.jsx("h4",{children:"Your order is on its way to you! ✨ We’ll notify you as soon as it’s shipped."}),s.jsx("div",{className:"thankYouImg",children:s.jsx("img",{src:"/assets/images/thankYouLaddo.png",alt:"Jaccha Website Element",className:"img-fluid"})})]})})]})})})})]})}export{j as default};
