import{j as s}from"./app-c84f3ec7.js";import{a as e}from"./asset-cfb426c9.js";function g({title:l,subTitle:n,sectionChildren:i,paddingTop:m,paddingBottom:r,section:o}){const c=[];return i.forEach(a=>{a.home_page_section_child_title!="NA"&&c.push({image:e("backend-assets/uploads/home_page_section_child_images/"+a.home_page_section_child_images),name:a.home_page_section_child_sub_title,comments:a.home_page_section_child_title,rating:parseInt(a.home_page_section_child_footer_title,10)})}),s.jsx("section",{className:"section testimonials pt-3",children:s.jsxs("div",{className:"container",children:[s.jsx("div",{className:"row mb-5",children:s.jsx("div",{className:"col-sm-12 text-center","data-aos":"fade-up",children:s.jsx("h2",{className:"mini-heading",children:l})})}),s.jsxs("div",{className:"row pt-4",children:[s.jsx("div",{className:"col-sm-10 pe-0",children:s.jsxs("div",{id:"carouselExampleFade",className:"carousel slide testimonial-carousel","data-aos":"fade-up",children:[s.jsx("div",{className:"carousel-inner",children:c.map((a,t)=>s.jsx("div",{className:`carousel-item ${t===0?"active":""}`,children:s.jsxs("div",{className:"row",children:[s.jsx("div",{className:"col-sm-4",children:s.jsxs("div",{className:"testimonial-image",children:[s.jsx("img",{className:"test-img",src:a.image}),s.jsx("div",{className:"dot-bg",children:s.jsx("img",{src:"/assets/images/dot.png",alt:"about image"})}),s.jsx("h4",{children:a.name})]})}),s.jsx("div",{className:"col-sm-8",children:s.jsxs("div",{className:"testimonial-content",children:[s.jsx("div",{className:"star",children:[...Array(a.rating)].map((h,d)=>s.jsx("img",{src:"/assets/images/star.png",alt:"",className:"object-contain shrink-0 aspect-[1.12] w-[18px]"},d))}),s.jsx("p",{children:a.comments})]})})]})},t))}),s.jsxs("button",{className:"carousel-control-prev",type:"button","data-bs-target":"#carouselExampleFade","data-bs-slide":"prev",children:[s.jsx("span",{className:"carousel-control-prev-icon","aria-hidden":"true"}),s.jsx("span",{className:"visually-hidden",children:"Previous"})]}),s.jsxs("button",{className:"carousel-control-next",type:"button","data-bs-target":"#carouselExampleFade","data-bs-slide":"next",children:[s.jsx("span",{className:"carousel-control-next-icon","aria-hidden":"true"}),s.jsx("span",{className:"visually-hidden",children:"Next"})]})]})}),s.jsx("div",{className:"col-sm-2 ps-0",children:s.jsxs("div",{className:"testimonial-right text-end","data-aos":"zoom-in-up",children:[s.jsx("img",{className:"testimonial-img",src:e("backend-assets/uploads/home_page_section_images/"+o.home_page_section_images1)}),s.jsx("div",{className:"dot-bg",children:s.jsx("img",{src:e("backend-assets/uploads/home_page_section_child_images/"+i[3].home_page_section_child_images),alt:"about image"})})]})})]})]})})}export{g as default};
