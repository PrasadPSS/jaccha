import{r as m,j as s,Y as j,b as l,y}from"./app-e30e0a77.js";import"./Dropdown-39d9006d.js";import{H as b,B as N}from"./HomeLayout-703d7e30.js";import"./Header-1f3944ae.js";import"./Footer-f5d6e188.js";function w({auth:i,cart:n,cart_amount:d}){let o=[];n&&n.forEach(t=>{o.push({id:t.product_id,weight:t.products.product_weight,swt:t.sweetness_level,addons:t.ingredient_addons,excl:t.ingredient_exclusions,name:t.product_variant!=null?t.product_variant.product_title:t.products.product_title,description:t.products.product_sub_title,price:t.product_variant!=null?t.product_variant.product_price:t.products.product_price,quantity:t.qty,image:t.products.product_thumb})});const[r,e]=m.useState(o),u=async t=>{await fetch("/api/cart/increase",{method:"POST",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")},body:JSON.stringify({item_id:t})}).then(c=>c.json()).then(c=>{e(r.map(a=>a.id===t?{...a,quantity:Number(a.quantity)+1}:a))}).catch(c=>console.error(c))},p=async t=>{e(r.map(c=>c.id===t&&c.quantity>1?{...c,quantity:c.quantity-1}:c));try{const c=await l.post("/api/cart/decrease",{item_id:t});e(r.map(a=>a.id===t?{...a,quantity:c.data.updated_quantity}:a))}catch(c){console.error("Error decreasing quantity:",c)}},h=async t=>{e(r.filter(c=>c.id!==t));try{await l.post("/api/cart/remove",{item_id:t}),e(r.filter(c=>c.id!==t))}catch(c){console.error("Error removing item:",c)}N.success("Product Removed Successfully",{autoClose:5e3})},x=async()=>{y.get("/checkout/payment",{onSuccess:()=>alert("Order Placed Successfully"),onError:t=>console.error(t)})};return s.jsxs(b,{auth:i,header:s.jsx("h2",{className:"text-xl font-semibold leading-tight text-gray-800",children:"Dashboard"}),children:[s.jsx(j,{title:"Cart"}),s.jsx("div",{className:"sub-banner bg-light pb-0",children:s.jsx("div",{className:"container",children:s.jsx("div",{className:"row",children:s.jsx("div",{className:"col-sm-12",children:s.jsxs("div",{className:"banner_heading pb-4",children:[s.jsx("h2",{children:"My Basket"}),s.jsxs("p",{children:[i.cart_count," Items"]})]})})})})}),s.jsx("section",{className:"checkout bg-light cart",children:s.jsx("div",{className:"container",children:s.jsx("div",{className:"row",children:s.jsx("div",{className:"col-sm-12",children:s.jsxs("div",{className:"checkout-right",children:[r.length>0?r.map(t=>s.jsxs("div",{className:"checkout-product mb-5",children:[s.jsxs("div",{className:"cart-product_image",children:[s.jsx("div",{className:"checkout-product_img position-relative",children:s.jsx("img",{src:"/backend-assets/uploads/product_thumbs/"+t.image,alt:""})}),s.jsxs("div",{className:"cart-product_content",children:[s.jsxs("div",{className:"checkout-product_content",children:[s.jsx("h5",{children:t.name}),s.jsxs("p",{children:[t.weight,"gm | ",t.swt??"low"," Sweetness | ",t.addons??"NA"," | No ",t.excl??"NA"]})]}),s.jsx("div",{className:"checkout-product_price",children:s.jsxs("p",{children:["₹",t.price]})})]})]}),s.jsxs("div",{className:"add-to-card-btn",children:[s.jsx("button",{type:"button",onClick:()=>u(t.id),className:"btn plus_button plus",id:"plus-btn1",children:"+"}),s.jsx("div",{className:"number",children:s.jsx("button",{type:"button",className:"btn black","data-bs-toggle":"modal","data-bs-target":"#addBasketModal",children:s.jsx("span",{id:"count1",children:t.quantity})})}),s.jsx("button",{onClick:()=>p(t.id),type:"button",className:"btn minus_button",id:"minus-btn1",children:"-"})]}),s.jsx("a",{href:"#",onClick:()=>h(t.id),children:s.jsxs("p",{className:"cart_remove",children:[s.jsx("i",{className:"far fa-trash-alt"}),"Remove"]})})]},t.id)):"Cart is Empty",s.jsxs("div",{className:"payment-history mt-5",children:[s.jsxs("div",{className:"payment-display mb-2",children:[s.jsxs("p",{children:["Subtotal . ",i.cart_count," Items"]}),s.jsxs("p",{children:["₹",d]})]}),s.jsxs("div",{className:"payment-display mb-3",children:[s.jsx("p",{children:"Shipping"}),s.jsx("p",{children:"₹0.00"})]}),s.jsxs("div",{className:"payment-display",children:[s.jsx("p",{children:s.jsx("b",{children:"Total"})}),s.jsx("p",{children:s.jsxs("b",{children:["₹",d]})})]})]}),s.jsx("div",{className:"pay-now-button",children:s.jsx("button",{onClick:()=>x(),children:"Checkout"})})]})})})})})]})}export{w as default};
