import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { asset } from '../../../Helpers/asset';
import ApplicationLogo from '@/Components/ApplicationLogo';

function Header({auth}) {

    return (
        <header className="flex flex-col justify-center items-start self-stretch pt-5 pr-24 pb-10 pl-28 w-full bg-neutral-50 max-md:px-5 max-md:max-w-full">
            <div className="flex gap-10 items-center max-w-full w-[1476px]">
                <Link href={route('home')}>
                    <ApplicationLogo />
                </Link>
                
                <form className="flex flex-col self-stretch my-auto text-xl tracking-wide text-gray-400 min-w-[240px] w-[343px]">
                    <div className="flex gap-5 self-start">
                        <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/57e8eca467c2706218aaa75643929cd29b8795d4853c1b50128c179abfb2b0ce?placeholderIfAbsent=true&apiKey=13ac881fd2134f72b1dc131d381f5f3b" alt="" className="object-contain shrink-0 w-5 aspect-square" />
                        <label htmlFor="searchInput" className="sr-only">Search for an Item</label>
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Search for an Item..."
                            className="basis-auto bg-transparent border-none outline-none shadow-none focus:outline-none"
                        />
                    </div>
                    <div className='border-b-2'></div>
                </form>
                <nav className="flex gap-10 items-center self-stretch my-auto text-normal font-bold text-gray-500 min-w-[240px] max-md:max-w-full">
                    <a href="#store" className="self-stretch my-auto">Store</a>
                    {auth.user ? (<Link href={route('profile.edit')} className="self-stretch my-auto">Account</Link> ):( <Link href={route('login')} className="self-stretch my-auto">Log In</Link>)}
                    <a href="#wishlist" className="self-stretch my-auto">Wish List</a>
                    <a href="#basket" className="flex gap-2.5 justify-center items-center self-stretch my-auto ">
                        <span className=" my-auto">Basket</span>
                        <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/ae7dc6e18b403a62ea91fbab7b89876bd48df24ae978331e5c28bb9950836539?placeholderIfAbsent=true&apiKey=13ac881fd2134f72b1dc131d381f5f3b" alt="" className="object-contain shrink-0 self-stretch my-auto aspect-square w-[24px]" />
                    </a>
                </nav>
            </div>
        </header>
    );
}

export default Header;