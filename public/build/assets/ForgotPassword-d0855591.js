import{q as a,r as d,j as s,a as n}from"./app-422c2137.js";import{H as c}from"./HomeLayout-81fdb6ae.js";import"./react-toastify.esm-07e16aaa.js";import"./Header-72610feb.js";import"./Footer-50e07701.js";import"./InputError-f0d9cca6.js";function f({shipping_address:m}){let e=a().props.auth.csrf_token;const i=a().props.auth,[l,t]=d.useState(""),o=r=>{t(r.target.value)};return s.jsx(c,{auth:i,children:s.jsx("section",{className:"login-sec section",children:s.jsxs("div",{className:"container",children:[s.jsx("h2",{"data-aos":"fade-right","data-aos-duration":"2000",children:"Enjoy exclusive deals & track your orders"}),s.jsxs("div",{className:"row g-5",children:[s.jsx("div",{className:"col-lg-6","data-aos":"fade-right","data-aos-duration":"2000",children:s.jsxs("div",{className:"login-img",children:[s.jsx("img",{src:"/assets/images/login/dots.png",alt:"Jaccha Website Element",className:"img-fluid dots-img d-i1",loading:"lazy"}),s.jsx("div",{className:"laddo-img-wrap",children:s.jsx("img",{src:"/assets/images/login/laddoo.png",alt:"Jaccha Website Element",className:"img-fluid laddo-img",loading:"lazy"})}),s.jsx("img",{src:"/assets/images/login/dots.png",alt:"Jaccha Website Element",className:"img-fluid dots-img d-i2",loading:"lazy"})]})}),s.jsx("div",{className:"col-lg-6","data-aos":"fade-left","data-aos-duration":"2000",children:s.jsxs("div",{className:"login-form",children:[s.jsx("h3",{children:"Reset Password"}),s.jsx("p",{children:"Enter your email and we will send you a reset link."}),s.jsxs("form",{action:"",children:[s.jsx("div",{className:"mb-4 mt-4",children:s.jsx("input",{onChange:o,type:"email",className:"form-control",id:"email",name:"email",placeholder:"Enter E-mail Address*",required:!0})}),s.jsx("div",{className:"mb-5 pt-1",children:s.jsx(n,{as:"button",method:"post",href:route("profile.sendresetlink"),data:{email:l,_token:e},className:"login-btn",children:"Send Reset Password"})})]}),s.jsx("h4",{className:"mt-4 pt-3 pb-2",children:"I remember my password"}),s.jsx("a",{href:route("login"),className:"create-acc-btn",children:"Login"})]})})]})]})})})}export{f as default};
