import{q as d,j as s}from"./app-110da61b.js";import{g as r}from"./getCsrfToken-7f0f8407.js";import{H as l}from"./HomeLayout-2918b9ca.js";import"./react-toastify.esm-4f62db88.js";import"./Header-0095ab83.js";import"./Footer-9dcce443.js";import"./InputError-312d8c85.js";function j({shipping_address:n}){let e=r();const o=d().props.auth,a=new URLSearchParams(window.location.search),i=a.get("token"),t=a.get("email");return s.jsx(l,{auth:o,children:s.jsx("section",{className:"login-sec section",children:s.jsxs("div",{className:"container",children:[s.jsx("h2",{"data-aos":"fade-right","data-aos-duration":"2000",children:"Enjoy exclusive deals & track your orders"}),s.jsxs("div",{className:"row g-5",children:[s.jsx("div",{className:"col-lg-6","data-aos":"fade-right","data-aos-duration":"2000",children:s.jsxs("div",{className:"login-img create-acc",children:[s.jsx("img",{src:"/assets/images/login/dots.png",alt:"Jaccha Website Element",className:"img-fluid dots-img d-i1",loading:"lazy"}),s.jsx("div",{className:"laddo-img-wrap",children:s.jsx("img",{src:"/assets/images/login/laddoo.png",alt:"Jaccha Website Element",className:"img-fluid laddo-img",loading:"lazy"})}),s.jsx("img",{src:"/assets/images/login/dots.png",alt:"Jaccha Website Element",className:"img-fluid dots-img d-i2",loading:"lazy"})]})}),s.jsx("div",{className:"col-lg-6","data-aos":"fade-left","data-aos-duration":"2000",children:s.jsxs("div",{className:"login-form",children:[s.jsx("h3",{children:"Set New Password"}),s.jsx("p",{children:"Please set a new password for your account."}),s.jsxs("form",{action:route("profile.updatepassword"),method:"post",children:[s.jsx("input",{type:"hidden",name:"_token",value:e}),s.jsx("input",{type:"hidden",name:"token",id:"token",value:i}),s.jsx("input",{type:"hidden",name:"email",id:"email",value:t}),s.jsx("div",{className:"mb-3 mt-4",children:s.jsx("input",{type:"password",className:"form-control",id:"password",name:"password",placeholder:"Enter New Password*"})}),s.jsx("div",{className:"mb-3",children:s.jsx("input",{type:"password",className:"form-control",id:"confirm_password",name:"confirm_password",placeholder:"Confirm New Password*"})}),s.jsx("div",{className:"mb-4",children:s.jsx("button",{href:route("profile.updatepassword"),className:"login-btn",children:"Set Password"})})]}),s.jsx("h4",{className:"mt-4 py-2",children:"Already have an account?"}),s.jsx("a",{href:route("login"),className:"create-acc-btn",children:"Login"})]})})]})]})})})}export{j as default};
