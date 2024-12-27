import{r as p,W as N,j as s}from"./app-bebe3769.js";import{I as n}from"./InputError-48956302.js";import{I as l}from"./InputLabel-54c07c92.js";import{P as _}from"./PrimaryButton-9248f740.js";import{T as d}from"./TextInput-b3f34eee.js";import{q as b}from"./transition-ab22df7b.js";function k({className:w=""}){const m=p.useRef(),u=p.useRef(),[x,c]=p.useState(!1),{data:r,setData:t,errors:o,put:f,post:P,reset:i,processing:h,recentlySuccessful:j}=N({current_password:"",password:"",password_confirmation:"",otp:""}),v=e=>{e.preventDefault(),f(route("password.update"),{preserveScroll:!0,onSuccess:()=>i(),onError:a=>{a.password&&(i("password","password_confirmation"),m.current.focus()),a.current_password&&(i("current_password"),u.current.focus())}})},g=async e=>{e.preventDefault();try{const a=await axios.post(route("profile.reset-via-otp"),{otp:r.otp,password:r.password,password_confirmation:r.password_confirmation});i(),c(!1),alert("Password reset Successfully")}catch{c(!1),alert("Invalid otp")}},y=async()=>{var e;try{const a=await axios.post(route("profile.sendotp"));a.data.success?c(!0):console.error("Failed to send OTP:",a.data.message)}catch(a){console.error("Error sending OTP:",((e=a.response)==null?void 0:e.data)||a.message)}};return s.jsxs("section",{className:w,children:[s.jsxs("header",{children:[s.jsx("h2",{className:"text-lg font-medium text-gray-900",children:"Update Password"}),s.jsx("p",{className:"mt-1 text-sm text-gray-600",children:"Ensure your account is using a long, random password to stay secure."})]}),s.jsxs("form",{onSubmit:v,className:"mt-6 space-y-6",children:[s.jsxs("div",{children:[s.jsx(l,{htmlFor:"current_password",value:"Current Password"}),s.jsx(d,{id:"current_password",ref:u,value:r.current_password,onChange:e=>t("current_password",e.target.value),type:"password",className:"mt-1 block w-full",autoComplete:"current-password"}),s.jsx(n,{message:o.current_password,className:"mt-2"})]}),s.jsxs("div",{children:[s.jsx(l,{htmlFor:"password",value:"New Password"}),s.jsx(d,{id:"password",ref:m,value:r.password,onChange:e=>t("password",e.target.value),type:"password",className:"mt-1 block w-full",autoComplete:"new-password"}),s.jsx(n,{message:o.password,className:"mt-2"})]}),s.jsxs("div",{children:[s.jsx(l,{htmlFor:"password_confirmation",value:"Confirm Password"}),s.jsx(d,{id:"password_confirmation",value:r.password_confirmation,onChange:e=>t("password_confirmation",e.target.value),type:"password",className:"mt-1 block w-full",autoComplete:"new-password"}),s.jsx(n,{message:o.password_confirmation,className:"mt-2"})]}),s.jsxs("div",{className:"flex items-center gap-4",children:[s.jsx(_,{disabled:h,children:"Save"}),s.jsx(b,{show:j,enter:"transition ease-in-out",enterFrom:"opacity-0",leave:"transition ease-in-out",leaveTo:"opacity-0",children:s.jsx("p",{className:"text-sm text-gray-600",children:"Saved."})})]})]}),s.jsx("div",{className:"mt-6",children:s.jsx("button",{type:"button",onClick:y,className:"text-blue-600 hover:underline text-sm",children:"Reset password via OTPs"})}),x&&s.jsx("div",{className:"fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50",children:s.jsxs("div",{className:"bg-white p-6 rounded-lg shadow-lg w-full max-w-md",children:[s.jsx("h2",{className:"text-lg font-medium text-gray-900",children:"Reset Password via OTP"}),s.jsxs("form",{onSubmit:g,className:"mt-4 space-y-4",children:[s.jsxs("div",{children:[s.jsx(l,{htmlFor:"otp",value:"OTP"}),s.jsx(d,{id:"otp",value:r.otp,onChange:e=>t("otp",e.target.value),type:"text",className:"mt-1 block w-full",placeholder:"Enter the OTP"}),s.jsx(n,{message:o.otp,className:"mt-2"})]}),s.jsxs("div",{children:[s.jsx(l,{htmlFor:"password",value:"New Password"}),s.jsx(d,{id:"password",value:r.password,onChange:e=>t("password",e.target.value),type:"password",className:"mt-1 block w-full",placeholder:"Enter new password"}),s.jsx(n,{message:o.password,className:"mt-2"})]}),s.jsxs("div",{children:[s.jsx(l,{htmlFor:"password_confirmation",value:"Confirm Password"}),s.jsx(d,{id:"password_confirmation",value:r.password_confirmation,onChange:e=>t("password_confirmation",e.target.value),type:"password",className:"mt-1 block w-full",placeholder:"Confirm new password"}),s.jsx(n,{message:o.password_confirmation,className:"mt-2"})]}),s.jsxs("div",{className:"flex justify-end gap-4",children:[s.jsx("button",{type:"button",onClick:()=>c(!1),className:"text-gray-600 hover:underline text-sm",children:"Cancel"}),s.jsx("button",{type:"submit",children:"Reset"})]})]})]})})]})}export{k as default};
