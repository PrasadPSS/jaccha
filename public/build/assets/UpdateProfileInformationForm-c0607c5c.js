import{q as p,W as j,j as e,a as v}from"./app-b3118a2e.js";import{T as n,I as o}from"./TextInput-b0da70a7.js";import{I as m}from"./InputLabel-73c8eee5.js";import{P as g}from"./PrimaryButton-722d2366.js";import{q as b}from"./transition-ee94ed7b.js";function k({mustVerifyEmail:l,status:u,className:c=""}){const s=p().props.auth.user,{data:t,setData:i,patch:d,errors:r,processing:x,recentlySuccessful:f}=j({name:s.name,email:s.email,mobile_no:s.mobile_no}),h=a=>{a.preventDefault(),d(route("profile.update"))};return e.jsxs("section",{className:c,children:[e.jsxs("header",{children:[e.jsx("h2",{className:"text-lg font-medium text-gray-900",children:"Profile Information"}),e.jsx("p",{className:"mt-1 text-sm text-gray-600",children:"Update your account's profile information and email address."})]}),e.jsxs("form",{onSubmit:h,className:"mt-6 space-y-6",children:[e.jsxs("div",{children:[e.jsx(m,{htmlFor:"name",value:"Name"}),e.jsx(n,{id:"name",className:"mt-1 block w-full",value:t.name,onChange:a=>i("name",a.target.value),required:!0,isFocused:!0,autoComplete:"name"}),e.jsx(o,{className:"mt-2",message:r.name})]}),e.jsxs("div",{children:[e.jsx(m,{htmlFor:"email",value:"Email"}),e.jsx(n,{id:"email",type:"email",className:"mt-1 block w-full",value:t.email,onChange:a=>i("email",a.target.value),required:!0,autoComplete:"username"}),e.jsx(o,{className:"mt-2",message:r.email})]}),e.jsxs("div",{children:[e.jsx(m,{htmlFor:"mobile_no",value:"Phone no"}),e.jsx(n,{id:"mobile_no",type:"number",className:"mt-1 block w-full",value:t.mobile_no,onChange:a=>i("mobile_no",a.target.value),required:!0,autoComplete:"username"}),e.jsx(o,{className:"mt-2",message:r.mobile_no})]}),l&&s.email_verified_at===null&&e.jsxs("div",{children:[e.jsxs("p",{className:"text-sm mt-2 text-gray-800",children:["Your email address is unverified.",e.jsx(v,{href:route("verification.send"),method:"post",as:"button",className:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500",children:"Click here to re-send the verification email."})]}),u==="verification-link-sent"&&e.jsx("div",{className:"mt-2 font-medium text-sm text-green-600",children:"A new verification link has been sent to your email address."})]}),e.jsxs("div",{className:"flex items-center gap-4",children:[e.jsx(g,{disabled:x,children:"Save"}),e.jsx(b,{show:f,enter:"transition ease-in-out",enterFrom:"opacity-0",leave:"transition ease-in-out",leaveTo:"opacity-0",children:e.jsx("p",{className:"text-sm text-gray-600",children:"Saved."})})]})]})]})}export{k as default};
