import React from "react";
import { asset } from '../../../Helpers/asset';


export default function WeekHighlights({data}) {
    return (
        <section className="flex overflow-hidden flex-col pt-11 pb-11 font-medium text-start w-[80%]">
            <div className="mt-16 text-center text-[28px] font-semibold tracking-wide text-[#374151] capitalize mb-8 font-nunito">{data.section_childs[0].home_page_section_child_sub_title}</div>
            <div className="flex flex-row mb-14">
                <img src={asset("backend-assets/uploads/home_page_section_child_images/"+data.section_childs[1].home_page_section_child_images)} alt="" className="w-[50%]" />
                <img src={asset("backend-assets/uploads/home_page_section_child_images/"+data.section_childs[2].home_page_section_child_images)} alt="" className="w-[40%] ml-14" />
            </div>
            <h2 className="text-2xl leading-10 text-zinc-700 max-md:max-w-full ">
                { data.section_childs[3].home_page_section_child_sub_title }
            </h2>
            <div className="flex flex-wrap gap-5 justify-between items-start mt-20 w-full text-xl tracking-wide leading-7 max-w-[1363px] text-stone-900 max-md:mt-10 max-md:max-w-full">
                <article className="flex flex-col self-stretch w-[10%]">
                    <img loading="lazy" src={asset("backend-assets/uploads/home_page_section_child_images/"+data.section_childs[4].home_page_section_child_images)} alt="Icon representing nutrient-rich recipes" className="object-contain self-center aspect-square w-[75px]" />
                    <h3 className="mt-8">{data.section_childs[4].home_page_section_child_sub_title}</h3>
                </article>
                <article className="flex flex-col w-[10%]">
                    <img loading="lazy" src={asset("backend-assets/uploads/home_page_section_child_images/"+data.section_childs[5].home_page_section_child_images)} alt="Icon representing homemade with love" className="object-contain self-center aspect-[1.01] w-[76px]" />
                    <h3 className="mt-8">{data.section_childs[5].home_page_section_child_sub_title}</h3>
                </article>
                <article className="flex flex-col self-stretch w-[10%]">
                    <img loading="lazy" src={asset("backend-assets/uploads/home_page_section_child_images/"+data.section_childs[6].home_page_section_child_images)} alt="Icon representing traditionally inspired recipes" className="object-contain self-center aspect-[1.01] w-[76px]" />
                    <h3 className="mt-8">{data.section_childs[6].home_page_section_child_sub_title}</h3>
                </article>
                <article className="flex flex-col w-[10%]">
                    <img loading="lazy" src={asset("backend-assets/uploads/home_page_section_child_images/"+data.section_childs[7].home_page_section_child_images)} alt="Icon representing no preservatives" className="object-contain self-center aspect-[1.01] w-[76px]" />
                    <h3 className="mt-8">{data.section_childs[7].home_page_section_child_sub_title}</h3>
                </article>
                <article className="flex flex-col text-2xl w-[10%]">
                    <img loading="lazy" src={asset("backend-assets/uploads/home_page_section_child_images/"+data.section_childs[8].home_page_section_child_images)} alt="Icon representing pure and natural ingredients" className="object-contain aspect-square w-[76px]" />
                    <h3 className="mt-7">{data.section_childs[8].home_page_section_child_sub_title}</h3>
                </article>
                <article className="flex flex-col w-[10%]">
                    <img loading="lazy" src={asset("backend-assets/uploads/home_page_section_child_images/"+data.section_childs[9].home_page_section_child_images)} alt="Icon representing hand-packed with care" className="object-contain self-center aspect-square w-[75px]" />
                    <h3 className="mt-7">{data.section_childs[9].home_page_section_child_sub_title}</h3>
                </article>
            </div>
        </section>

    );
};
