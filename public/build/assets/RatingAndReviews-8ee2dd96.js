import{r as i,j as e,b as j}from"./app-b3118a2e.js";const R=({productReviews:c,reviews:p,productId:d,canReview:m})=>{console.log("asdasdasdas",c);const[u,h]=i.useState(p.find(s=>s.product_id===d)),[n,N]=i.useState(0),[o,x]=i.useState(""),[b,y]=i.useState(""),[g,r]=i.useState(""),v=s=>{N(s)},f=async s=>{var t,l;if(s.preventDefault(),!m){r("You can only rate/review if you have purchased the product.");return}try{const a=await j.post("/rating/review/edit",{product_id:d,rating:n,comment:o});a.data.success?h(!0):r(a.data.message||"Failed to submit your review.")}catch(a){r(((l=(t=a.response)==null?void 0:t.data)==null?void 0:l.message)||"An error occurred.")}},w=async s=>{var t,l;if(s.preventDefault(),!m){r("You can only rate/review if you have purchased the product.");return}try{const a=await j.post("/rating/review",{product_id:d,rating:n,comment:o});a.data.success?h(!0):r(a.data.message||"Failed to submit your review.")}catch(a){r(((l=(t=a.response)==null?void 0:t.data)==null?void 0:l.message)||"An error occurred.")}};return e.jsxs("div",{className:"row mt-4",children:[e.jsxs("div",{className:"col",children:[e.jsx("h3",{className:"text-dark fw-bold",children:"Ratings & Reviews"}),m&&!u?e.jsxs("form",{onSubmit:w,className:"p-3 border rounded shadow-sm",children:[e.jsxs("div",{className:"mb-3",children:[e.jsx("label",{htmlFor:"rating",className:"form-label fw-semibold",children:"Rating (out of 5)"}),e.jsxs("select",{id:"rating",className:"form-select",value:n,onChange:s=>v(Number(s.target.value)),required:!0,children:[e.jsx("option",{value:"",children:"Select a rating"}),[1,2,3,4,5].map(s=>e.jsx("option",{value:s,children:s},s))]})]}),e.jsxs("div",{className:"mb-3",children:[e.jsx("label",{htmlFor:"comment",className:"form-label fw-semibold",children:"Comment"}),e.jsx("textarea",{id:"comment",className:"form-control",rows:"3",value:o,onChange:s=>x(s.target.value),placeholder:"Share your thoughts about this product...",required:!0})]}),e.jsx("button",{type:"submit",className:"btn btn-primary",children:"Submit Review"})]}):u?e.jsxs("div",{className:"alert alert-warning mt-3",children:["You have already reviewed this product",e.jsxs("form",{onSubmit:f,className:"p-3 border rounded shadow-sm",children:[e.jsxs("div",{className:"mb-3",children:[e.jsx("label",{htmlFor:"rating",className:"form-label fw-semibold",children:"Rating (out of 5)"}),e.jsxs("select",{id:"rating",className:"form-select",value:n,onChange:s=>v(Number(s.target.value)),required:!0,children:[e.jsx("option",{value:"",children:"Select a rating"}),[1,2,3,4,5].map(s=>e.jsx("option",{value:s,children:s},s))]})]}),e.jsxs("div",{className:"mb-3",children:[e.jsx("label",{htmlFor:"comment",className:"form-label fw-semibold",children:"Comment"}),e.jsx("textarea",{id:"comment",className:"form-control",rows:"3",value:o,onChange:s=>x(s.target.value),placeholder:"Share your thoughts about this product...",required:!0})]}),e.jsx("button",{type:"submit",className:"btn btn-primary",children:"Edit Review"})]})]}):e.jsx("div",{className:"alert alert-warning mt-3",children:"You must purchase this product to leave a review."}),b&&e.jsx("div",{className:"alert alert-success mt-3",children:b}),g&&e.jsx("div",{className:"alert alert-danger mt-3",children:g})]}),e.jsxs("div",{className:"container mt-4 mb-4",children:[e.jsx("h2",{children:"Reviews"}),c&&c.length>0?e.jsx(e.Fragment,{children:c.map(s=>e.jsx("div",{className:"mb-3",children:e.jsxs("div",{className:"card",children:[e.jsx("div",{className:"card-header",children:e.jsx("h5",{className:"card-title",children:s.username})}),e.jsxs("div",{className:"card-body",children:[e.jsxs("h5",{className:"card-subtitle mb-2",children:["Rating: ",s.rating,"/5"]}),e.jsxs("p",{className:"card-text",children:["Comment: ",s.comment]})]})]})},s.id))}):e.jsx("p",{children:"No reviews available."})]})]})};export{R as default};