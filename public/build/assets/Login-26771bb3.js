import{W as t,r as d,j as s,a as n}from"./app-bebe3769.js";import"./TextInput-b3f34eee.js";import{H as c}from"./HomeLayout-908484e3.js";import"./Header-1b4c6fe5.js";import"./Footer-c6872daa.js";function y({auth:i,status:m,canResetPassword:g}){const{data:h,setData:e,post:r,processing:p,errors:u,reset:l}=t({email:"",password:"",remember:!1});d.useEffect(()=>()=>{l("password")},[]);const o=a=>{a.preventDefault(),r(route("login"))};return s.jsx(c,{auth:i,children:s.jsx("section",{className:"login-sec section",children:s.jsxs("div",{className:"container",children:[s.jsx("h2",{"data-aos":"fade-right","data-aos-duration":"2000",children:"Enjoy exclusive deals & track your orders"}),s.jsxs("div",{className:"row g-5",children:[s.jsx("div",{className:"col-lg-6","data-aos":"fade-right","data-aos-duration":"2000",children:s.jsxs("div",{className:"login-img",children:[s.jsx("img",{src:"/assets/images/login/dots.png",alt:"Jaccha Website Element",className:"img-fluid dots-img d-i1",loading:"lazy"}),s.jsx("div",{className:"laddo-img-wrap",children:s.jsx("img",{src:"/assets/images/login/laddoo.png",alt:"Jaccha Website Element",className:"img-fluid laddo-img",loading:"lazy"})}),s.jsx("img",{src:"/assets/images/login/dots.png",alt:"Jaccha Website Element",className:"img-fluid dots-img d-i2",loading:"lazy"})]})}),s.jsx("div",{className:"col-lg-6","data-aos":"fade-left","data-aos-duration":"2000",children:s.jsxs("div",{className:"login-form",children:[s.jsx("h3",{children:"Login"}),s.jsx("p",{children:"Please enter your e-mail and password:"}),s.jsxs("form",{onSubmit:o,children:[s.jsx("div",{className:"mb-3 mt-4",children:s.jsx("input",{type:"email",className:"form-control",id:"emailAddrs",placeholder:"Enter email address*",onChange:a=>e("email",a.target.value)})}),s.jsxs("div",{className:"mb-3 position-relative",children:[s.jsx("input",{type:"password",className:"form-control",id:"passoword",placeholder:"Password*",onChange:a=>e("password",a.target.value)}),s.jsx("div",{className:"forgt-pass",children:s.jsx("a",{href:"forgot-password.html",children:"Forgot password?"})})]}),s.jsx("div",{className:"mb-4",children:s.jsx("button",{type:"submit",className:"login-btn",children:"Login"})})]}),s.jsx("h4",{className:"mt-4 py-2",children:"Create Account"}),s.jsxs("ul",{children:[s.jsx("li",{children:"View your order history"}),s.jsx("li",{children:"Track your order status and shipping"}),s.jsx("li",{children:"Store multiple delivery addresses"})]}),s.jsx(n,{href:route("register"),className:"create-acc-btn",children:"Create Account"})]})})]})]})})})}export{y as default};