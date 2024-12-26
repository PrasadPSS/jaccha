import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import HomeLayout from '@/Layouts/HomeLayout';
import { Head, Link, router } from '@inertiajs/react';
import React from 'react';

export default function Index ({ auth, wishlist }) {

    const handleAddToCart = (id, quantity=1) => {
        router.post('/wishlist/add-to-cart', { product_id:id, quantity: quantity }, {
            onSuccess: () => alert('Item added to cart!'),
            onError: (errors) => console.error(errors),
        });
    };

    const handleDeleteFromWishlist = (id, quantity=1) => {
        router.post('/wishlist/delete', { product_id:id }, {
            onSuccess: () => '',
            onError: (errors) => console.error(errors),
        });
    };

    return (
        <HomeLayout auth={auth} 
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard
                </h2>
            }
        >
            <Head title="Wishlist" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
        <div className="min-h-screen bg-gray-100 py-8">
            <div className="container mx-auto px-4">
                <h1 className="text-2xl font-semibold text-gray-800 mb-6">My Wishlist</h1>

                {wishlist.length > 0 ? (
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {wishlist.map((item, index) => (
                            
                            <div
                                key={index}
                                className="bg-white rounded-lg shadow-md overflow-hidden"
                            >
                                {/* Item Image */}
                                <img width="100" height="100"
                                    src={'/backend-assets/uploads/product_thumbs/' + item.products.product_thumb }
                                    alt={item.name}
                                    className="w-full h-48 object-cover"
                                />
                                {/* Item Details */}
                                <div className="p-4">
                                    <h2 className="text-lg font-medium text-gray-800">
                                        {item.products.product_title}
                                    </h2>
                                    <p className="text-gray-600 mt-1">${item.products.product_price}</p>
                                    <div className="mt-4 flex gap-2">
                                        {/* Add to Cart Button */}
                                        {/* <button
                                            onClick={() => handleAddToCart(item.id, 1)}
                                            className="px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300"
                                        >
                                            Add to Cart
                                        </button> */}
                                        {/* Remove from Wishlist Button */}
                                        <Link href='/product/addtocart' method="post" data={{ product_id: item.products.product_id, quantity: 1, product_type: item.products.product_type, product_price: item.products.product_price }} className="btn btn-success px-4 py-2 shadow-sm">Add to Cart</Link>
                                        <button
                                            onClick={() => handleDeleteFromWishlist(item.products.product_id)}
                                            className="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-300"
                                        >
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                ) : (
                    <p className="text-gray-600 text-center">Your wishlist is empty.</p>
                )}
            </div>
        </div>
        </div>
        </div>
                </div>
            </div>
        </HomeLayout>
    );
};


