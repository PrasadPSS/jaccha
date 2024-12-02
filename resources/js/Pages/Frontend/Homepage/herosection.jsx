import React from "react";
import { asset } from '../../../Helpers/asset';

function HeroSection({data}) {
    
    return (
        <section className="flex flex-col self-stretch px-36 py-20 mt-1.5 w-full bg-rose-100 max-md:px-5 max-md:max-w-full">
            <div className="flex flex-row mb-20">

                <div className="flex z-10 flex-col self-center mt-0 w-full max-w-[1457px] max-md:mt-0 max-md:max-w-full">
                    <div className="flex flex-col max-w-full w-[841px]">
                        <div className="flex gap-6 self-start text-lg tracking-widest leading-none text-zinc-900">
                            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/b694040c40065a66dd7ba9a3dc4426489a7b383e8b6e908b526815b9fb97bb31?placeholderIfAbsent=true&apiKey=13ac881fd2134f72b1dc131d381f5f3b" alt="" className="object-contain shrink-0 w-px aspect-[0.03]" />
                            <div data-layername="featuredClass">{data.section_childs[0].home_page_section_child_title}</div>
                        </div>
                        <h1 data-layername="theRoleOfUserInt" className="mt-4 text-[100px] font-bold tracking-tighter leading-[125px] text-zinc-700 max-md:max-w-full max-md:text-4xl max-md:leading-[56px]">
                            {data.section_childs[1].home_page_section_child_sub_title}
                        </h1>
                    </div>

                </div>
                <img loading="lazy" src={asset('backend-assets/uploads/home_page_section_child_images/'+data.section_childs[2].home_page_section_child_images)} alt="Decorative image" className="object-contain z-10 self-start max-w-full aspect-[0.93] w-[400px] max-md:mr-2.5" />
            </div>
            <div className="flex flex-row">
                <img className="w-[400px] h-[370px]" src={asset('backend-assets/uploads/home_page_section_child_images/'+data.section_childs[3].home_page_section_child_images)} alt="" />
                <div className="flex flex-col">
                    <div className="flex flex-row">
                        <div className="flex flex-col ml-36 ">
                            <div className="flex flex-row">
                                <span className="border border-gray-600 h-9"></span> <span className="ml-5 text-normal font-bold mt-1">About Us</span>
                            </div>
                            <p data-layername="quisNostrudExercit" className="self-end mr-20 ml-5 mt-1 text-normal text-gray-500 font-normal tracking-wide leading-8 bg-blend-normal w-[468px] max-md:mr-2.5 max-md:max-w-full">
                                {data.section_childs[5].home_page_section_child_sub_title
                                }
                            </p>
                        </div>
                        <img className="w-[200px]" src={asset("backend-assets/uploads/home_page_section_child_images/"+data.section_childs[6].home_page_section_child_images)} alt="" />
                    </div>
                    <div className="flex flex-row bg-[#C9D4E5] w-[614px] ml-36">
                        <img className="w-[150px] h-[200px]" src={asset("backend-assets/uploads/home_page_section_child_images/"+data.section_childs[7].home_page_section_child_images)} alt="" />
                        <div className="ml-11 mt-7">
                        <h2 data-layername="quisNostrudExercit" className="relative self-end text-xl leading-tight bg-blend-normal text-gray-500 font-semibold">
                            {data.section_childs[7].home_page_section_child_title
                            }
                        </h2>
                        <p data-layername="quisNostrudExercit" className="relative mt-4 text-xl tracking-wider leading-none bg-blend-normal text-gray-500 font-semibold">
                        ${data.section_childs[7].home_page_section_child_sub_title
                            }
                        </p> 

                        <button data-layername="bg" className="relative px-10 py-1 mt-6 ml-2 max-w-full text-base font-semibold leading-9 text-white bg-black rounded-lg shadow-[0px_10px_20px_rgba(0,0,0,0.15)] w-[177px] max-md:px-5">
                            BUY NOW
                        </button>
                        </div>
                    </div>
                </div>
            </div>
            <div className="flex flex-col -mt-72 w-full max-w-[1322px] max-md:max-w-full">

                <div className="flex flex-wrap gap-5 justify-between mt-20 font-medium text-zinc-700 max-md:mt-10 max-md:max-w-full">
                    <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/604a11e57bce42e478762a2ec83236a86f890e8b968d194a1c823a023e94bb7b?placeholderIfAbsent=true&apiKey=13ac881fd2134f72b1dc131d381f5f3b" alt="Product image" className="object-contain shrink-0 self-start mt-8 max-w-full rounded-sm bg-blend-normal aspect-[1.47] w-[115px]" />
                    <div className="flex relative flex-col items-center px-20 py-7 min-h-[208px] max-md:px-5 max-md:max-w-full">
                        
                        
                        
                    </div>
                </div>
                <div className="ml-11 max-w-full w-[624px]">
                    <div className="flex gap-5 max-md:flex-col">
                        <div data-layername="column" className="flex flex-col w-6/12 max-md:ml-0 max-md:w-full">
                            <div className="flex flex-col mt-5 text-zinc-700 max-md:mt-10">
                                <h3 data-layername="karenWilliam" className="self-start text-2xl font-semibold tracking-wide leading-normal">
                                    {data.section_childs[4].home_page_section_child_title}
                                </h3>
                                <p data-layername="seniorDesigner" className="text-base tracking-wide leading-7 bg-blend-normal">
                                    Certified Nutritionist & <br /> Maternal Wellness Expert
                                </p>
                            </div>
                        </div>
                        <div data-layername="column" className="flex flex-col ml-5 w-6/12 max-md:ml-0 max-md:w-full">
                            <div data-layername="yellowBox" className="flex flex-col px-9 py-9 w-full text-3xl font-semibold leading-9 text-white bg-rose-500 max-md:px-5 max-md:mt-10">
                                <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/357225d9e8e6a546cbebca9f8caa3ab0e7d28b768b6060d93ba096400cd9aba2?placeholderIfAbsent=true&apiKey=13ac881fd2134f72b1dc131d381f5f3b" alt="" className="object-contain aspect-[1.27] w-[19px]" />
                                <h3 data-layername="joinTheClass" className="mt-5">
                                    {data.section_childs[8].home_page_section_child_title}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
    }

export default HeroSection; 