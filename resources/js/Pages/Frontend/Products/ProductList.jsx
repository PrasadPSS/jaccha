import { Link } from "@inertiajs/react";
import React, { useState } from "react";

const ProductList = ({ filteredProducts, setCurrentPage, currentPage }) => {
    // Pagination state
    
    const productsPerPage = 6; // Number of products per page

    // Calculate indices for slicing the product list
    const indexOfLastProduct = currentPage * productsPerPage;
    const indexOfFirstProduct = indexOfLastProduct - productsPerPage;
    const currentProducts = filteredProducts.slice(indexOfFirstProduct, indexOfLastProduct);

    // Calculate total pages
    const totalPages = Math.ceil(filteredProducts.length / productsPerPage);

    // Handle page change
    const paginate = (pageNumber) => setCurrentPage(pageNumber);

    return (
        <div className="row">
            {currentProducts.map((product, index) => (
                                            <a href={'/product/view/' + product.id} className={index > 2 ? "col-sm-4 mt-5" : "col-sm-4"} key={product.id}>
            
                                                <div className="feature-box">
            
            
                                                    <Link as="a" method="post" href='/product/addtocart' data={{ product_id: product.id, product_type: "simple", product_variant_id: null, quantity: 1, _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'), sweetnesslevel: null, ingrediantaddons: null, exclusions: null }}>
                                                        <div className="basket-box">
                                                            <i className="fal fa-shopping-basket"></i>
                                                        </div>
                                                    </Link>
                                                    {product.added &&
                                                        <Link method="post" href={route('wishlist.delete')} data={{ product_id: product.id }}><i className="fas fa-heart heart" style={{ color: 'red' }}></i></Link>
                                                    }
                                                    {!product.added &&
                                                        <Link method="post" href={route('wishlist.add')} as='a' data={{ product_id: product.id }}><i className="fal fa-heart heart"></i></Link>}
                                                    <img
                                                        src={product.image}
                                                        alt={product.name}
                                                    />
                                                    <div className="features-content">
                                                        <p>{product.category}</p>
                                                        <h5>{product.name}</h5>
                                                        <h6>₹{product.price}.00</h6>
                                                        <div className="star">
                                                            {Array(product.rating)
                                                                .fill()
                                                                .map((_, i) => (
                                                                    <img
                                                                        key={i}
                                                                        src="/assets/images/star.png"
                                                                        alt="star"
                                                                    />
                                                                ))}
                                                            <span>( {product.reviews} reviews )</span>
                                                        </div>
                                                    </div>
                                                </div>
            
                                            </a>
                                        ))}

            {/* Pagination Controls */}
            <div className="pagination">
                <button
                    disabled={currentPage === 1}
                    onClick={() => paginate(currentPage - 1)}
                >
                    Previous
                </button>
                &nbsp;
                {Array.from({ length: totalPages }, (_, i) => (
                    
                    <button
                        key={i}
                        className={currentPage === i + 1 ? "active m-4" : "m-4"}
                        onClick={() => paginate(i + 1)}
                    >
                        {i + 1}
                    </button>
                    
                ))}
                <button
                    disabled={currentPage === totalPages}
                    onClick={() => paginate(currentPage + 1)}
                >
                    Next
                </button>
            </div>
        </div>
    );
};

export default ProductList;
