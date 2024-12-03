import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import HomeLayout from '@/Layouts/HomeLayout';
import { Head } from '@inertiajs/react';

export default function View({ cms_pages }) {
    console.log( cms_pages);
    return (
        <HomeLayout
            
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />
            <div className='p-4 m-4' dangerouslySetInnerHTML={{__html: cms_pages.cms_pages_content}}>
                
            </div>

            
        </HomeLayout>
    );
}
