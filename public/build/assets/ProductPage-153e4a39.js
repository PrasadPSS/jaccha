import{j as e}from"./app-dacddda1.js";import{H as p}from"./HomeLayout-2a5242ea.js";import n from"./Banner-71d2506a.js";import a from"./Highlights-f2540c05.js";import s from"./Benefits-20eff722.js";import _ from"./Featured-299afb08.js";import d from"./About-da791572.js";import l from"./Testimonials-920d5329.js";import"./Header-6faf8817.js";import"./Footer-a5b29dd6.js";import"./asset-5a6f21ef.js";const u={Banner:n,Highlights:a,Benefits:s,Featured:_,About:d,Testimonials:l};function v({auth:r,laravelVersion:f,phpVersion:g,homepagesections:i,data:m}){return e.jsx(p,{auth:r,children:i.map(o=>{const t=u[o.home_page_section_name];return t?e.jsx(t,{title:o.home_page_section_title,subTitle:o.home_page_section_sub_title,sectionChildren:o.section_childs,paddingTop:o.padding_top,paddingBottom:o.padding_bottom,data:m},o.home_page_section_id):null})})}export{v as default};