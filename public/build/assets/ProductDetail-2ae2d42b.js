import{r as i,q as R,j as e,a as k,y}from"./app-7b200f12.js";import{H as W}from"./HomeLayout-4b32994c.js";import O from"./ReviewsListing-8585d942.js";import V from"./ReviewForm-747d96fe.js";import"./Header-81d36cd9.js";import"./Footer-95724ac6.js";const X=({auth:u,product:t,product_reviews:o,product_images:g,average_rating:x,related_product_list:p})=>{const[w,C]=i.useState(""),[H,S]=i.useState(""),[q,B]=i.useState(""),A=()=>{p.forEach(s=>{const{product:a}=s,c={product_id:a.product_id,product_type:"simple",product_variant_id:null,quantity:1,_token:document.querySelector('meta[name="csrf-token"]').getAttribute("content")};y.post("/product/addtocart",c,{onSuccess:()=>{console.log(`Added ${a.product_title} to cart`)},onError:l=>{console.error(`Failed to add ${a.product_title}:`,l)}})})},[j,G]=i.useState(t.product_variants),[F,L]=i.useState(""),[d,M]=i.useState(""),b=Math.floor(x),D=x%1>=.1,I=5-b;new URLSearchParams,R().props;function P(s){return u.orders.some(c=>c.orderproducts.some(l=>l.product_id===s))}i.useState({pincode:""}),i.useState({courier:null,fastest_etd:""}),i.useState(""),$(document).ready(function(){$("#fixedBox").removeClass("visible").addClass("hidden"),$(window).on("scroll",function(){var s=$("#fixedBox"),a=$("#section2"),c=a.offset().top;c+a.outerHeight();var l=$(window).scrollTop()+$(window).height()/2;l>=c?s.removeClass("hidden").addClass("visible"):s.removeClass("visible").addClass("hidden")}),$("#addtoBasketButton").on("click",function(){$("#addBasketModal").modal("toggle"),swal({title:"",text:t.product_title+" Added to Your Basket!",timer:2e3})})});const[r,f]=i.useState(1),[m,E]=i.useState(t.product_discounted_price*r);i.useEffect(()=>{if(d!=""){const s=j.filter(a=>a.product_title==d);E(s[0].product_price),L(s[0].product_variant_id)}},[d]);const N=s=>{const{checked:a,value:c}=s.target;C(l=>a?l?`${l},${c}`:c:l.split(",").filter(n=>n!==c).join(","))},h=s=>{const{checked:a,value:c}=s.target;S(l=>a?l?`${l},${c}`:c:l.split(",").filter(n=>n!==c).join(","))},v=s=>{const{checked:a,value:c}=s.target;B(l=>a?l?`${l},${c}`:c:l.split(",").filter(n=>n!==c).join(","))},_=s=>u.wishlist.some(a=>a.product_id==s),T=(s=1)=>{y.post("/wishlist/delete",{product_id:t.product_id},{onSuccess:()=>"",onError:a=>console.error(a)})};return e.jsxs(W,{auth:u,children:[e.jsx("section",{className:"section pt-5 products-details bg_light",children:e.jsx("div",{className:"container",children:e.jsxs("div",{className:"row g-5",children:[e.jsx("div",{className:"col-sm-6",children:e.jsxs("div",{className:"main-image-box",children:[e.jsxs("h2",{className:"product-details-heading mb-4",children:["All Products ",">>","  ",e.jsx("span",{children:t.product_title})]}),e.jsxs("div",{className:"images-box",children:[e.jsx("div",{className:"image-b-box",children:e.jsx("img",{src:"/backend-assets/uploads/product_thumbs/"+t.product_thumb,alt:"product details image"})}),e.jsx("div",{className:"image-s-boxes",children:g.length>1&&g.map((s,a)=>e.jsx("img",{src:`/backend-assets/uploads/product_images/${s.image_name}`,alt:`Product Image ${a+1}`},a))})]})]})}),e.jsx("div",{className:"col-sm-6",children:e.jsxs("div",{className:"content-box",children:[e.jsx("h2",{className:"product-details-heading",children:e.jsx("span",{children:t.product_title})}),e.jsxs("div",{className:"content-price",children:[t.product_discounted_price==t.product_price&&e.jsxs("h4",{children:["₹",t.product_discounted_price,".00"]}),t.product_discounted_price!=t.product_price&&e.jsxs("h4",{children:[e.jsxs("span",{children:["₹",t.product_price,".00"]}),"₹",t.product_discounted_price,".00"]}),t.product_price-t.product_discounted_price>0&&e.jsxs("p",{className:"content-offer",children:["- ",t.product_price-t.product_discounted_price," Off"]})]}),e.jsxs("div",{className:"content-star star",children:[[...Array(b)].map((s,a)=>e.jsx("img",{src:"/assets/images/product-details/star1.png",alt:"Full star"},`full-${a}`)),D&&e.jsx("img",{src:"/assets/images/product-details/star2.png",alt:"Half star"}),[...Array(I)].map((s,a)=>e.jsx("img",{src:"/assets/images/product-details/star3.png",alt:"Full star"},`full-${a}`)),o.length>0&&e.jsxs("span",{children:[" (",o.length," Reviews)"]})]}),e.jsxs("div",{className:"main-content",children:[e.jsx("h6",{children:t.product_sub_title}),e.jsx("div",{dangerouslySetInnerHTML:{__html:t.product_specification}}),e.jsx("ul",{className:"icon-list mt-3",children:e.jsx("div",{dangerouslySetInnerHTML:{__html:t.product_desc}})})]}),j.length>0&&e.jsxs("div",{className:"kg-box position-relative",children:[e.jsxs("p",{children:["Choose Weight: ",d]}),j.map(s=>e.jsx("button",{onClick:()=>M(s.product_title),className:d==s.product_title?"button gram-button active":"button gram-button",children:s.product_title},s.product_variant_id)),e.jsxs("p",{className:"get-offer",children:[e.jsx("img",{src:"/assets/images/product-details/SVG.png"}),e.jsx("br",{}),"Get Offer"]})]}),e.jsxs("div",{className:"black-button mt-5 d-flex",children:[e.jsxs("div",{className:"add-to-card-btn",children:["₹",m,".00",e.jsx("button",{className:"btn plus_button plus",id:"plus-btn",onClick:()=>f(s=>s+1),children:"|   +   |"}),e.jsx("div",{className:"number",children:e.jsxs("button",{type:"button",className:"btn btn-primary black","data-bs-toggle":"modal","data-bs-target":"#addBasketModal","data-price":m,"data-quantity":r,children:["Add",e.jsxs("span",{id:"count",children:[" ",r," "]}),"to basket"]})}),e.jsx("button",{onClick:()=>f(s=>s!=0?s-1:0),className:"btn minus_button",id:"minus-btn",children:"|   -   |"})]}),!_(t.product_id)&&e.jsx(k,{type:"button",href:route("wishlist.add"),method:"post",as:"button",className:"gray",data:{product_id:t.product_id},children:e.jsx("img",{src:"/assets/images/product-details/empty-heart.png"})}),_(t.product_id)&&e.jsx("button",{type:"button",onClick:T,className:"gray",children:e.jsx("img",{src:"/assets/images/product-details/heart.png"})})]}),e.jsxs("div",{className:"black-button mt-5",children:[e.jsxs("p",{className:"free-delivery text-center",children:[e.jsx("img",{src:"/assets/images/product-details/delivery-truck.png"}),"Free delivery over ₹500"]}),e.jsx("div",{className:"accordion product-ingredients mt-3",id:"accordionExample",children:e.jsxs("div",{className:"accordion-item",children:[e.jsx("h2",{className:"accordion-header",children:e.jsx("button",{className:"accordion-button",type:"button","data-bs-toggle":"collapse","data-bs-target":"#collapseOne","aria-expanded":"true","aria-controls":"collapseOne",children:"Ingredients"})}),e.jsx("div",{id:"collapseOne",className:"accordion-collapse collapse","data-bs-parent":"#accordionExample",children:e.jsx("div",{className:"accordion-body pt-0 ms-3",dangerouslySetInnerHTML:{__html:t.ingredients}})})]})})]})]})})]})})}),e.jsx("section",{className:"section bg_light pt-4",children:e.jsxs("div",{className:"marquee",children:[e.jsxs("div",{className:"marquee__item",children:["No preservatives. 100% natural. Handcrafted with love.",e.jsx("span",{className:"marquee__seperator"}),"No preservatives. 100% natural. Handcrafted with love.",e.jsx("span",{className:"marquee__seperator"}),"No preservatives. 100% natural. Handcrafted with love.",e.jsx("span",{className:"marquee__seperator"}),"No preservatives. 100% natural. Handcrafted with love.",e.jsx("span",{className:"marquee__seperator"}),"No preservatives. 100% natural. Handcrafted with love.",e.jsx("span",{className:"marquee__seperator"}),"No preservatives. 100% natural. Handcrafted with love.",e.jsx("span",{className:"marquee__seperator"}),"No preservatives. 100% natural. Handcrafted with love.",e.jsx("span",{className:"marquee__seperator"})]}),e.jsxs("div",{className:"marquee__item",children:["No preservatives. 100% natural. Handcrafted with love.",e.jsx("span",{className:"marquee__seperator"}),"No preservatives. 100% natural. Handcrafted with love.",e.jsx("span",{className:"marquee__seperator"}),"No preservatives. 100% natural. Handcrafted with love.",e.jsx("span",{className:"marquee__seperator"}),"No preservatives. 100% natural. Handcrafted with love.",e.jsx("span",{className:"marquee__seperator"}),"No preservatives. 100% natural. Handcrafted with love.",e.jsx("span",{className:"marquee__seperator"}),"No preservatives. 100% natural. Handcrafted with love.",e.jsx("span",{className:"marquee__seperator"}),"No preservatives. 100% natural. Handcrafted with love.",e.jsx("span",{className:"marquee__seperator"})]})]})}),e.jsxs("section",{className:"section usage-instructions bg_light pt-4",id:"section2",children:[e.jsx("div",{className:"container",children:e.jsxs("div",{className:"row g-5",children:[e.jsx("div",{className:"col-sm-6",children:e.jsx("div",{className:"instruction-image",children:e.jsx("img",{src:"/backend-assets/uploads/product_thumbs/"+t.product_thumb,alt:""})})}),e.jsx("div",{className:"col-sm-6",children:e.jsxs("div",{className:"instruction-content",children:[e.jsx("h2",{className:"product-details-heading mb-4",children:"Usage Instructions"}),e.jsxs("p",{children:[e.jsx("img",{src:"./assets/images/product-details/consumed-hours.png",alt:""}),"When to Consume"]}),e.jsxs("ul",{children:[e.jsx("li",{children:"Postpartum: Consume 1 laddoo daily for lactation and recovery."}),e.jsx("li",{children:"General Health: Ideal for adults as a nutritious snack."})]}),e.jsxs("p",{children:[e.jsx("img",{src:"./assets/images/product-details/basket.png",alt:""}),"How to Store"]}),e.jsxs("ul",{children:[e.jsx("li",{children:"Keep in an airtight container."}),e.jsx("li",{children:"Store in a cool, dry place."})]}),e.jsxs("p",{children:[e.jsx("img",{src:"./assets/images/product-details/milk.png",alt:""}),"Shelf Life"]}),e.jsx("ul",{children:e.jsx("li",{children:"Best before 30 days from the date of preparation."})})]})})]})}),e.jsx("div",{className:"half-circle",children:e.jsx("img",{src:"./assets/images/half-circle.png"})})]}),e.jsx("section",{className:"why-choose",children:e.jsx("div",{className:"container",children:e.jsx("div",{className:"row",children:e.jsx("div",{className:"col-sm-6",children:e.jsxs("div",{className:"why-choose-content",children:[e.jsx("h3",{className:"common-heading",children:"Why Choose Jaccha Dana Methi Laddoos?"}),e.jsx("ul",{className:"ms-4",dangerouslySetInnerHTML:{__html:t.product_disclaimer}})]})})})})}),e.jsx("section",{className:"section reviews",children:e.jsx("div",{className:"container",children:e.jsxs("div",{className:"row",children:[e.jsx("div",{className:"col-sm-12",children:e.jsxs("div",{className:"reviews-heading",children:[e.jsxs("h3",{children:[Number(x).toFixed(1),e.jsxs("span",{children:["Based on ",o.length," reviews"]})]}),P(t.product_id)&&e.jsxs("button",{type:"button",className:"btn btn-primary","data-bs-toggle":"modal","data-bs-target":"#exampleModal",children:["Write a Review ",e.jsx("i",{className:"fal fa-angle-right ms-3"})]})]})}),e.jsx(O,{product_reviews:o})]})})}),e.jsx("section",{className:"section product_listing",children:e.jsx("div",{className:"container",children:e.jsxs("div",{className:"row align-items-center",children:[e.jsx("div",{className:"col-sm-3",children:e.jsxs("div",{className:"product-accordian product-listing-heading","data-aos":"fade-up","data-aos-delay":"200",children:[e.jsx("h3",{className:"common-heading",children:"You may also like"}),e.jsx("p",{children:"Handpicked treats to complement your wellness journey."}),e.jsxs("div",{className:"product-details-listing",children:[e.jsxs("p",{children:["Total",e.jsx("br",{}),e.jsxs("span",{children:["₹",p.reduce((s,a)=>s+(a.product.product_discounted_price||0),0)]})]}),e.jsx("a",{className:"product-details-listing",id:"addAllToBasketButton",onClick:()=>A(),children:"Add all to basket"})]})]})}),e.jsx("div",{className:"col-sm-9",children:e.jsx("div",{className:"row","data-aos":"fade-up",children:p.map(s=>{const{product:a}=s;return e.jsx("div",{className:"col-sm-4",children:e.jsxs("div",{className:"feature-box",children:[e.jsx("div",{className:"basket-box",children:e.jsx("i",{className:"fal fa-shopping-basket"})}),e.jsx("i",{className:"fal fa-heart heart"}),e.jsx("img",{src:`/backend-assets/uploads/product_thumbs/${a.product_thumb}`,alt:a.product_title}),e.jsxs("div",{className:"features-content",children:[e.jsx("p",{children:a.product_sub_title}),e.jsx("h5",{children:a.product_title}),e.jsxs("h6",{children:["₹",a.product_discounted_price," ",e.jsxs("del",{children:["₹",a.product_price]})]}),e.jsxs("div",{className:"star",children:[e.jsx("img",{src:"/assets/images/star.png",alt:"star"}),e.jsx("img",{src:"/assets/images/star.png",alt:"star"}),e.jsx("img",{src:"/assets/images/star.png",alt:"star"}),e.jsx("img",{src:"/assets/images/star.png",alt:"star"}),e.jsx("img",{src:"/assets/images/star.png",alt:"star"}),e.jsx("span",{children:"( 6 reviews )"})]})]})]})},a.product_id)})})})]})})}),e.jsx("section",{className:"sticky-div",id:"fixedBox",children:e.jsx("div",{className:"container",children:e.jsxs("div",{className:"sticky-product",children:[e.jsxs("div",{className:"sticky-product-img",children:[e.jsx("img",{src:"/backend-assets/uploads/product_thumbs/"+t.product_thumb,alt:""}),e.jsxs("p",{children:[t.product_title," ",e.jsx("br",{}),e.jsxs("span",{children:[" ₹",t.product_discounted_price,".00 "]})]})]}),e.jsxs("div",{className:"sticky-product-button",children:[e.jsxs("p",{children:["₹",m,".00"]}),e.jsx("div",{className:"add-to-card-btn",children:e.jsx("div",{className:"number",children:e.jsxs("button",{type:"button",className:"btn black","data-bs-toggle":"modal","data-bs-target":"#addBasketModal",children:["Add",e.jsx("span",{id:"count1",children:r}),"to basket"]})})})]})]})})}),e.jsx("div",{className:"modal fade addBasket-modal review-modal",id:"addBasketModal",tabIndex:"-1","aria-labelledby":"addBasketModalLabel","aria-hidden":"true",children:e.jsx("div",{className:"modal-dialog",children:e.jsx("div",{className:"modal-content",children:e.jsxs("div",{className:"modal-body",children:[e.jsx("button",{type:"button",className:"btn-close","data-bs-dismiss":"modal","aria-label":"Close",children:e.jsx("i",{className:"fal fa-times"})}),e.jsx("div",{className:"row",children:e.jsx("div",{className:"col-sm-12",children:e.jsxs("div",{className:"add-modal",children:[e.jsx("div",{className:"modal_header",children:e.jsx("h2",{children:"Customize Your Laddoo!"})}),e.jsxs("div",{className:"modal_in px-5 pt-4",children:[e.jsx("h5",{className:"mb-3",children:"Sweetness Level:"}),e.jsxs("div",{className:"checkboxes",children:[e.jsxs("div",{className:"form-check",children:[e.jsx("input",{className:"form-check-input",type:"checkbox",value:"low",id:"flexCheckDefault",onChange:N}),e.jsx("label",{className:"form-check-label",htmlFor:"low",children:"Low"})]}),e.jsxs("div",{className:"form-check",children:[e.jsx("input",{className:"form-check-input",type:"checkbox",value:"medium",id:"flexCheckDefault",onChange:N}),e.jsx("label",{className:"form-check-label",htmlFor:"medium",children:"Medium"})]}),e.jsxs("div",{className:"form-check",children:[e.jsx("input",{className:"form-check-input",type:"checkbox",value:"high",id:"flexCheckDefault",onChange:N}),e.jsx("label",{className:"form-check-label",htmlFor:"high",children:"High"})]})]})]}),e.jsxs("div",{className:"modal_in px-5 pt-4",children:[e.jsx("h5",{className:"mb-3",children:"Ingredient Add-ons:"}),e.jsxs("div",{className:"checkboxes",children:[e.jsxs("div",{className:"form-check",children:[e.jsx("input",{className:"form-check-input",type:"checkbox",value:"almonds",id:"flexCheckDefault",onChange:h}),e.jsx("label",{className:"form-check-label",htmlFor:"almonds",children:"Almonds"})]}),e.jsxs("div",{className:"form-check",children:[e.jsx("input",{className:"form-check-input",type:"checkbox",value:"cashews",id:"flexCheckDefault",onChange:h}),e.jsx("label",{className:"form-check-label",htmlFor:"cashews",children:"Cashews"})]}),e.jsxs("div",{className:"form-check",children:[e.jsx("input",{className:"form-check-input",type:"checkbox",value:"walnuts",id:"flexCheckDefault",onChange:h}),e.jsx("label",{className:"form-check-label",htmlFor:"walnuts",children:"Walnuts"})]}),e.jsxs("div",{className:"form-check",children:[e.jsx("input",{className:"form-check-input",type:"checkbox",value:"dates",id:"flexCheckDefault",onChange:h}),e.jsx("label",{className:"form-check-label",htmlFor:"dates",children:"Dates"})]})]})]}),e.jsxs("div",{className:"modal_in px-5 py-4",children:[e.jsx("h5",{className:"mb-3",children:"Ingredient Exclusions:"}),e.jsxs("div",{className:"checkboxes",children:[e.jsxs("div",{className:"form-check",children:[e.jsx("input",{className:"form-check-input",type:"checkbox",value:"jaggery",id:"flexCheckDefault",onChange:v}),e.jsx("label",{className:"form-check-label",htmlFor:"jaggery",children:"No Jaggery"})]}),e.jsxs("div",{className:"form-check",children:[e.jsx("input",{className:"form-check-input",type:"checkbox",value:"ghee",id:"flexCheckDefault",onChange:v}),e.jsx("label",{className:"form-check-label",htmlFor:"ghee",children:"No Ghee"})]}),e.jsxs("div",{className:"form-check",children:[e.jsx("input",{className:"form-check-input",type:"checkbox",value:"sugar",id:"flexCheckDefault",onChange:v}),e.jsx("label",{className:"form-check-label",htmlFor:"sugar",children:"No Sugar"})]})]})]}),e.jsx("div",{className:"modal-button black-button pt-3 pb-5 m-auto text-center",children:e.jsxs(k,{href:"/product/addtocart",as:"button",method:"post",className:"black px-3 py-2",id:"addtoBasketButton",data:{product_id:t.product_id,product_type:d!==""?"configurable":"simple",product_variant_id:F,quantity:r,_token:document.querySelector('meta[name="csrf-token"]').getAttribute("content"),sweetnesslevel:w,ingrediantaddons:H,exclusions:q},children:["₹",m,".00 ",e.jsx("span",{children:"|"})," Add ",r," to basket",e.jsx("i",{className:"fal fa-angle-right"})]})})]})})})]})})})}),e.jsx("div",{className:"modal fade review-modal",id:"exampleModal",tabIndex:"-1","aria-labelledby":"exampleModalLabel","aria-hidden":"true",children:e.jsx("div",{className:"modal-dialog",children:e.jsx("div",{className:"modal-content",children:e.jsxs("div",{className:"modal-body",children:[e.jsx("button",{type:"button",className:"btn-close","data-bs-dismiss":"modal","aria-label":"Close",children:e.jsx("i",{className:"fal fa-times"})}),e.jsxs("div",{className:"row",children:[e.jsx("div",{className:"col-sm-6",children:e.jsxs("div",{className:"review-popup-content",children:[e.jsx("h2",{className:"modal-heading",children:"Write A Review"}),e.jsx(V,{productId:t.product_id})]})}),e.jsx("div",{className:"col-sm-6",children:e.jsx("div",{className:"review-popup-image",children:e.jsx("img",{src:"/assets/images/product-details/why-choose.jpg",alt:""})})})]})]})})})})]})};export{X as default};
