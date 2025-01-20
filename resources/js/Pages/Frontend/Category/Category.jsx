import { Head, Link } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { useState } from 'react';
import { asset } from '@/Helpers/asset';
import { router } from '@inertiajs/react';
import axios from 'axios';
import HomeLayout from '@/Layouts/HomeLayout';
import ProductBanner from '../Products/ProductBanner';
import ProductListing from '../Products/ProductListing';
import FirstOrder from '../Products/FirstOrder';
import Testimonials from '../Includes/Testimonials';
import CategoriesContent from '../Includes/CategoriesContent';



export default function ProductSearch({ auth, products, homepagesections, sizes,prices, categorycontent }) {

    let testimonials = homepagesections.filter((element)=> element.home_page_section_name == 'Testimonials')[0];

    let productDetails = [];
    products.map((element)=>
        {
            productDetails.push( {id: element.product_id, name: element.product_title, category: element.category_slug, price: element.product_price, image: '/backend-assets/uploads/product_thumbs/' + element.product_thumb, description: 'Sample 1', reviews: element.reviews != null ? element.reviews.length: 0, rating:element.reviews_avg_rating != null ? Number(element.reviews_avg_rating) : 0,size: 'Small', updatedAt: new Date(element.updated_at).getTime()});
        })
        console.log('here products', products);
    const [search, setSearch] = useState("");
    const [minPrice, setMinPrice] = useState("");
    const [maxPrice, setMaxPrice] = useState("");
        

    // Pagination state
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 10;  // Number of items per page
    // Filtered products based on search and price
    const filteredProducts = products.filter((product) => {
        const matchesSearch = product.product_title.toLowerCase().includes(search.toLowerCase());
        const matchesMinPrice = !minPrice || parseFloat(product.product_price) >= parseFloat(minPrice);
        const matchesMaxPrice = !maxPrice || parseFloat(product.product_price) <= parseFloat(maxPrice);
        return matchesSearch && matchesMinPrice && matchesMaxPrice;
    });

    // Get the current page products
    const indexOfLastProduct = currentPage * itemsPerPage;
    const indexOfFirstProduct = indexOfLastProduct - itemsPerPage;
    const currentProducts = filteredProducts.slice(indexOfFirstProduct, indexOfLastProduct);

    // Pagination controls
    const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);

    const nextPage = () => {
        if (currentPage < totalPages) {
            setCurrentPage(currentPage + 1);
        }
    };

    const prevPage = () => {
        if (currentPage > 1) {
            setCurrentPage(currentPage - 1);
        }
    };

    return (
        <HomeLayout auth={auth}
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Product Listing
                </h2>
            }
        >

            <Head title="Product Listing" />
            {/* <ProductBanner></ProductBanner> */}
            <ProductListing products={productDetails} sizes1={sizes} prices={prices}></ProductListing>
            {categorycontent && <CategoriesContent categoriescontent={categorycontent}/>}
            

            <FirstOrder></FirstOrder>
            <div className='pt-4 mb-4'></div>
            <Testimonials sectionChildren={testimonials.section_childs} section={homepagesections[5]}></Testimonials>
        </HomeLayout>
    );
}
