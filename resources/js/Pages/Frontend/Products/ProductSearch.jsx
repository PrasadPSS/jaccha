import { Head, Link } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { useState } from 'react';
import { asset } from '@/Helpers/asset';

export default function ProductSearch({ products }) {
    const [search, setSearch] = useState("");
    const [minPrice, setMinPrice] = useState("");
    const [maxPrice, setMaxPrice] = useState("");
    
    // Pagination state
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 10;  // Number of items per page

    // Filtered products based on search and price
    const filteredProducts = products.filter((product) => {
        const matchesSearch = product.name.toLowerCase().includes(search.toLowerCase());
        const matchesMinPrice = !minPrice || parseFloat(product.price) >= parseFloat(minPrice);
        const matchesMaxPrice = !maxPrice || parseFloat(product.price) <= parseFloat(maxPrice);
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
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <div className="flex min-h-screen bg-gray-100">
                                {/* Filter Box */}
                                <div className="w-1/4 bg-white p-4 shadow-md">
                                    <h2 className="text-xl font-semibold mb-4">Filters</h2>
                                    <div className="mb-4">
                                        <label className="block text-sm font-medium text-gray-700 mb-1">
                                            Search
                                        </label>
                                        <input
                                            type="text"
                                            value={search}
                                            onChange={(e) => setSearch(e.target.value)}
                                            className="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Search by name"
                                        />
                                    </div>
                                    <div className="mb-4">
                                        <label className="block text-sm font-medium text-gray-700 mb-1">
                                            Min Price
                                        </label>
                                        <input
                                            type="number"
                                            value={minPrice}
                                            onChange={(e) => setMinPrice(e.target.value)}
                                            className="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Minimum Price"
                                        />
                                    </div>
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 mb-1">
                                            Max Price
                                        </label>
                                        <input
                                            type="number"
                                            value={maxPrice}
                                            onChange={(e) => setMaxPrice(e.target.value)}
                                            className="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Maximum Price"
                                        />
                                    </div>
                                </div>

                                {/* Product Display */}
                                <div className="w-3/4 p-4">
                                    <h2 className="text-xl font-semibold mb-4">Products</h2>
                                    <div className="grid grid-cols-3 gap-4">
                                        {currentProducts.length > 0 ? (
                                            currentProducts.map((product) => (
                                                <div
                                                    key={product.id}
                                                    className="bg-white shadow-md rounded-lg p-4 flex flex-col items-center"
                                                >
                                                    <div className="h-40 w-40 bg-gray-200 flex items-center justify-center rounded mb-4">
                                                        {product.image ? (
                                                            <img
                                                                src={asset(product.image)}
                                                                alt={product.name}
                                                                className="h-full w-full object-cover"
                                                            />
                                                        ) : (
                                                            <span className="text-gray-500">No Image</span>
                                                        )}
                                                    </div>
                                                    <h3 className="text-lg font-semibold">{product.name}</h3>
                                                    <p className="text-gray-500">{product.description}</p>
                                                    <p className="text-blue-600 font-bold mt-2">${product.price}</p>
                                                    <Link className='' method='get' href={'product/buy/'+ product.id + '/' + 1} >Buy</Link>
                                                    <Link className='' method='get' href={'product/addtocart/'+ product.id + '/' + 1} >Add To Cart</Link>
                                                    <Link className='' method='get' href={'/wishlist/add/'+ product.id} >Add To Wishlist</Link>
                                                </div>
                                            ))
                                        ) : (
                                            <p className="text-gray-500">No products found</p>
                                        )}
                                    </div>

                                    {/* Pagination Controls */}
                                    <div className="flex justify-between mt-4">
                                        <button
                                            onClick={prevPage}
                                            className="bg-blue-500 text-white px-4 py-2 rounded-md disabled:opacity-50"
                                            disabled={currentPage === 1}
                                        >
                                            Previous
                                        </button>
                                        <span className="self-center text-gray-700">
                                            Page {currentPage} of {totalPages}
                                        </span>
                                        <button
                                            onClick={nextPage}
                                            className="bg-blue-500 text-white px-4 py-2 rounded-md disabled:opacity-50"
                                            disabled={currentPage === totalPages}
                                        >
                                            Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
