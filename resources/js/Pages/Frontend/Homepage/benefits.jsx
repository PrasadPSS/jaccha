import React from "react";
import { asset } from '../../../Helpers/asset';


export default function Benefits({data}) {
    return (
        <div className="w-[1688px] h-[614px] mt-11">
            <div className="h-[614px]">
                <div className="relative w-[1688px] h-[614px]">
                    <div className="absolute w-[1412px] h-[614px] top-0 left-[276px] rounded-[5px] [background:linear-gradient(180deg,rgba(223,159,152,0.4)_0%,rgba(189,98,128,0.8)_100%)]" />
                    <img
                        className="absolute w-[590px] h-[532px] top-[41px] left-32 rounded-r-xl object-cover"
                        alt="Rectangle"
                        src={asset('backend-assets/uploads/home_page_section_child_images/'+ data.section_childs[1].home_page_section_child_images)}
                    />

                    <div className="inline-flex flex-col items-center gap-[8.92px] absolute top-[30px] left-[753px]">
                        <div className="relative w-[653px] h-1 rounded-[111.54px]" />

                        <p className="relative w-fit [font-family:'Nunito-Bold',Helvetica] font-normal text-black text-[38px] tracking-[0.76px] leading-[normal]">
                            {data.section_childs[0].home_page_section_child_title}
                        </p>
                    </div>

                    <div className="flex flex-col w-[367px] items-start gap-5 absolute top-[173px] left-[818px]">
                        <div className="inline-flex items-center gap-6 relative flex-[0_0_auto]">
                            <img
                                className="relative w-[36.12px] h-[36.12px]"
                                alt="Hugeicons tick"
                                src={asset('frontend/images/hugeicons_tick.png')}
                            />

                            <div className="relative w-fit mt-[-0.94px] [font-family:'Nunito-Medium',Helvetica] font-medium text-[#343232] text-2xl tracking-[0.53px] leading-[normal]">
                            {data.section_childs[2].home_page_section_child_title}
                            </div>
                        </div>

                        <div className="inline-flex items-center gap-6 relative flex-[0_0_auto]">
                            <img
                                className="relative w-[36.12px] h-[36.12px]"
                                alt="Hugeicons tick"
                                src={asset('frontend/images/hugeicons_tick.png')}
                            />

                            <div className="relative w-fit mt-[-0.94px] [font-family:'Nunito-Medium',Helvetica] font-medium text-[#343232] text-2xl tracking-[0.53px] leading-[normal]">
                            {data.section_childs[3].home_page_section_child_title}
                            </div>
                        </div>

                        <div className="inline-flex items-center gap-6 relative flex-[0_0_auto]">
                            <img
                                className="relative w-[36.12px] h-[36.12px]"
                                alt="Hugeicons tick"
                                src={asset('frontend/images/hugeicons_tick.png')}
                            />

                            <div className="relative w-fit mt-[-0.94px] [font-family:'Nunito-Medium',Helvetica] font-medium text-[#343232] text-2xl tracking-[0.53px] leading-[normal]">
                            {data.section_childs[4].home_page_section_child_title}
                            </div>
                        </div>

                        <div className="flex items-center gap-6 relative self-stretch w-full flex-[0_0_auto]">
                            <img
                                className="relative w-[36.12px] h-[36.12px]"
                                alt="Hugeicons tick"
                                src={asset('frontend/images/hugeicons_tick.png')}
                            />

                            <div className="relative w-fit mt-[-0.94px] [font-family:'Nunito-Medium',Helvetica] font-medium text-[#343232] text-2xl tracking-[0.53px] leading-[normal]">
                            {data.section_childs[5].home_page_section_child_title}
                            </div>
                        </div>

                        <div className="inline-flex items-center gap-6 relative flex-[0_0_auto]">
                            <img
                                className="relative w-[36.12px] h-[36.12px]"
                                alt="Hugeicons tick"
                                src={asset('frontend/images/hugeicons_tick.png')}
                            />

                            <div className="relative w-fit mt-[-0.94px] [font-family:'Nunito-Medium',Helvetica] font-medium text-[#343232] text-2xl tracking-[0.53px] leading-[normal]">
                            {data.section_childs[6].home_page_section_child_title}
                            </div>
                        </div>
                    </div>

                    <button className="all-[unset] box-border absolute w-[281px] h-12 top-[476px] left-[818px]">
                        <div className="relative w-[279px] h-12 bg-[#2c2b2b] rounded-[8.54px]">
                            <div className="absolute top-1.5 left-[27px] [font-family:'Poppins-Medium',Helvetica] font-medium text-white text-xl tracking-[1.00px] leading-[34.7px] whitespace-nowrap">
                            {data.section_childs[7].home_page_section_child_title}
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    );
};
