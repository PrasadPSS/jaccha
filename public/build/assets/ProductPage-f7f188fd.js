import{j as e}from"./app-bebe3769.js";import{H as p}from"./HomeLayout-908484e3.js";import n from"./Banner-4bbcfa5a.js";import a from"./Highlights-95e05371.js";import s from"./Benefits-5c242d30.js";import _ from"./Featured-1010b2cf.js";import d from"./About-578e75a8.js";import l from"./Testimonials-75c4a979.js";import"./Header-1b4c6fe5.js";import"./Footer-c6872daa.js";import"./asset-5a6f21ef.js";const u={Banner:n,Highlights:a,Benefits:s,Featured:_,About:d,Testimonials:l};function v({auth:r,laravelVersion:f,phpVersion:g,homepagesections:i,data:m}){return e.jsx(p,{auth:r,children:i.map(o=>{const t=u[o.home_page_section_name];return t?e.jsx(t,{title:o.home_page_section_title,subTitle:o.home_page_section_sub_title,sectionChildren:o.section_childs,paddingTop:o.padding_top,paddingBottom:o.padding_bottom,data:m},o.home_page_section_id):null})})}export{v as default};