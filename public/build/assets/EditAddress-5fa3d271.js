import{r as c,j as e,Y as p,y as o}from"./app-110da61b.js";import{H as h}from"./HomeLayout-2918b9ca.js";import"./react-toastify.esm-4f62db88.js";import"./Header-0095ab83.js";import"./Footer-9dcce443.js";import"./InputError-312d8c85.js";function j({auth:t,shipping_address:a}){const[s,r]=c.useState({shipping_address_id:a.shipping_address_id,shipping_full_name:a.shipping_full_name||"",shipping_mobile_no:a.shipping_mobile_no||"",shipping_address_line1:a.shipping_address_line1||"",shipping_address_line2:a.shipping_address_line2||"",shipping_landmark:a.shipping_landmark||"",shipping_city:a.shipping_city||"",shipping_pincode:a.shipping_pincode||"",shipping_district:a.shipping_district||"",shipping_state:a.shipping_state||"",shipping_address_type:a.shipping_address_type||"",shipping_email:a.shipping_email||"",default_address_flag:a.default_address_flag||0}),i=l=>{const{name:n,value:m}=l.target;r({...s,[n]:m})},d=l=>{l.preventDefault(),o.post(route("address.update"),s,{onSuccess:()=>{console.log("Address updated successfully!")},onError:n=>{console.error("Validation errors: ",n)}})};return e.jsxs(h,{auth:t,children:[e.jsx(p,{title:"Edit Shipping Address"}),e.jsxs("div",{className:"container my-4",children:[e.jsx("h1",{className:"text-center mb-4",children:"Edit Shipping Address"}),e.jsxs("form",{onSubmit:d,className:"p-4 border rounded shadow-sm bg-white",children:[e.jsxs("div",{className:"mb-3",children:[e.jsx("label",{className:"form-label",children:"Full Name"}),e.jsx("input",{type:"text",name:"shipping_full_name",value:s.shipping_full_name,onChange:i,className:"form-control",required:!0}),e.jsx("input",{type:"hidden",name:"shipping_address_id",value:s.shipping_address_id})]}),e.jsxs("div",{className:"mb-3",children:[e.jsx("label",{className:"form-label",children:"Mobile Number"}),e.jsx("input",{type:"text",name:"shipping_mobile_no",value:s.shipping_mobile_no,onChange:i,className:"form-control",required:!0})]}),e.jsxs("div",{className:"mb-3",children:[e.jsx("label",{className:"form-label",children:"Address Line 1"}),e.jsx("input",{type:"text",name:"shipping_address_line1",value:s.shipping_address_line1,onChange:i,className:"form-control",required:!0})]}),e.jsxs("div",{className:"mb-3",children:[e.jsx("label",{className:"form-label",children:"Address Line 2"}),e.jsx("input",{type:"text",name:"shipping_address_line2",value:s.shipping_address_line2,onChange:i,className:"form-control"})]}),e.jsxs("div",{className:"mb-3",children:[e.jsx("label",{className:"form-label",children:"Landmark"}),e.jsx("input",{type:"text",name:"shipping_landmark",value:s.shipping_landmark,onChange:i,className:"form-control",required:!0})]}),e.jsxs("div",{className:"mb-3",children:[e.jsx("label",{className:"form-label",children:"City"}),e.jsx("input",{type:"text",name:"shipping_city",value:s.shipping_city,onChange:i,className:"form-control",required:!0})]}),e.jsxs("div",{className:"mb-3",children:[e.jsx("label",{className:"form-label",children:"Pincode"}),e.jsx("input",{type:"text",name:"shipping_pincode",value:s.shipping_pincode,onChange:i,className:"form-control",required:!0})]}),e.jsxs("div",{className:"mb-3",children:[e.jsx("label",{className:"form-label",children:"District"}),e.jsx("input",{type:"text",name:"shipping_district",value:s.shipping_district,onChange:i,className:"form-control",required:!0})]}),e.jsxs("div",{className:"mb-3",children:[e.jsx("label",{className:"form-label",children:"State"}),e.jsx("input",{type:"text",name:"shipping_state",value:s.shipping_state,onChange:i,className:"form-control",required:!0})]}),e.jsxs("div",{className:"mb-3",children:[e.jsx("label",{className:"form-label",children:"Email"}),e.jsx("input",{type:"email",name:"shipping_email",value:s.shipping_email,onChange:i,className:"form-control",required:!0})]}),e.jsxs("div",{className:"mb-3",children:[e.jsx("label",{className:"form-label",children:"Address Type"}),e.jsxs("select",{name:"shipping_address_type",value:s.shipping_address_type,onChange:i,className:"form-select",required:!0,children:[e.jsx("option",{value:"",children:"Select Address Type"}),e.jsx("option",{value:"Home",children:"Home"}),e.jsx("option",{value:"Office",children:"Office"})]})]}),e.jsxs("div",{className:"mb-3 form-check",children:[e.jsx("input",{type:"checkbox",name:"default_address_flag",checked:s.default_address_flag===1,onChange:l=>r({...s,default_address_flag:l.target.checked?1:0}),className:"form-check-input"}),e.jsx("label",{className:"form-check-label",children:"Set as Default Address"})]}),e.jsx("div",{className:"text-center",children:e.jsx("button",{type:"submit",className:"btn btn-primary",children:"Update Address"})})]})]})]})}export{j as default};
