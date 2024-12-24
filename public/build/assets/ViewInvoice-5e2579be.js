import{j as e}from"./app-48c342ba.js";const l=()=>{const{orderId:a}=new URLSearchParams;console.log(a);const r=c=>{const n=document.querySelector(c).innerHTML,s=window.open("","Print Invoice","height=600,width=800");s.document.write("<html><head><title>Print Invoice</title>"),s.document.write(`
      <style>
        body {
          font-family: Arial !important;
          color: #000;
        }
        .table {
          width: 100%;
          max-width: 100%;
          background-color: transparent;
        }
        /* Add your other styles here */
      </style>
    `),s.document.write("</head><body>"),s.document.write(n),s.document.write("</body></html>"),s.document.close(),s.focus(),s.print(),s.close()};return e.jsxs("div",{className:"app-content content",children:[e.jsx("div",{className:"content-overlay"}),e.jsxs("div",{className:"content-wrapper",children:[e.jsx("div",{className:"content-header row",children:e.jsx("div",{className:"content-header-left col-12 mb-2 mt-1",children:e.jsx("div",{className:"row breadcrumbs-top",children:e.jsxs("div",{className:"col-12",children:[e.jsx("h5",{className:"content-header-title float-left pr-1 mb-0",children:"Orders Invoice"}),e.jsx("div",{className:"breadcrumb-wrapper col-12",children:e.jsxs("ol",{className:"breadcrumb p-0 mb-0",children:[e.jsx("li",{className:"breadcrumb-item",children:e.jsx("a",{href:"/admin/dashboard",children:e.jsx("i",{className:"bx bx-home-alt"})})}),e.jsx("li",{className:"breadcrumb-item",children:e.jsx("a",{href:"/admin/orders",children:"Orders"})}),e.jsx("li",{className:"breadcrumb-item active",children:"Order Invoice"})]})})]})})})}),e.jsx("div",{className:"row",children:e.jsx("div",{className:"col-12",children:e.jsxs("div",{className:"card",children:[e.jsxs("div",{className:"card-header",children:[e.jsxs("a",{href:"/admin/orders",className:"btn btn-outline-secondary float-right ml-1",children:[e.jsx("i",{className:"bx bx-arrow-back"}),e.jsx("span",{className:"align-middle ml-25",children:"Back"})]}),e.jsx("button",{className:"btn btn-outline-secondary float-right ml-1",onClick:()=>r(".printinvoice"),children:e.jsx("span",{className:"align-middle ml-25",children:"Print"})}),e.jsx("a",{href:`/admin/orders/invoice/${a}`,className:"btn btn-outline-secondary float-right ml-1",children:e.jsx("span",{className:"align-middle ml-25",children:"Download Invoice"})}),e.jsx("h4",{className:"card-title",children:"Order Invoice"})]}),e.jsx("div",{className:"card-content",children:e.jsx("div",{className:"card-body card-dashboard",children:e.jsxs("div",{className:"printinvoice",children:[e.jsx("h3",{children:"Invoice Details"}),e.jsxs("p",{children:["Order ID: ",a]}),e.jsx("p",{children:"Customer Name: John Doe"}),e.jsx("p",{children:"Total: $200"})]})})})]})})})]})]})};export{l as default};
