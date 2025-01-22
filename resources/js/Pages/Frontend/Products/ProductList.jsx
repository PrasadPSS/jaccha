
import { Link, usePage } from "@inertiajs/react";
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
    const paginate = (pageNumber) => {

        setCurrentPage(pageNumber);
    };

    let token = usePage().props.auth.csrf_token;;


    return (
        <div className="row">
            {currentProducts.map((product, index) => (
                <a href={'/product/view/' + product.product_slug} className={index > 2 ? "col-sm-4 mt-5" : "col-sm-4"} key={product.id}>

                    <div className="feature-box">


                        <Link as="a" method="post" href='/product/addtocart' data={{ product_id: product.id, product_type: "simple", product_variant_id: null, quantity: 1, _token: token, sweetnesslevel: null, ingrediantaddons: null, exclusions: null }}>
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
                            {(product.price - product.discount) < product.price &&
                                <div class="feature-box"><h6>₹{product.price - product.discount}.00<span>₹{product.price}.00</span></h6></div>
                            }
                            {product.discount == 0 &&
                                <h6>₹{product.price}</h6>
                            }
                            {product.rating != 0 &&
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
                                        {Array(5-product.rating)
                                        .fill()
                                        .map((_, i) => (
                                            <img
                                                key={i}
                                                src="/assets/images/star2.png"
                                                alt="star"
                                            />
                                        ))}
                                    <span>( {product.reviews} reviews )</span>
                                </div>
                            }

                        </div>
                    </div>

                </a>
            ))}
            {filteredProducts.length != 0 &&
                <div className="Page navigation review-pagination mt-5">
                    <ul className="pagination">
                        <li className="page-item">
                            <button href="#" className="page-link" disabled={currentPage == 1}
                                onClick={() => paginate(currentPage - 1)} >Previous</button>
                        </li>
                        {Array.from({ length: totalPages }, (_, i) => (
                            <li className="page-item" ><a className={currentPage === i + 1 ? "page-link active" : "page-link"} key={i} onClick={() => paginate(i + 1)} href="#">{i + 1}</a></li>
                        ))}


                        <li className="page-item">
                            <button className="page-link" href="#" disabled={currentPage === totalPages}
                                onClick={() => paginate(currentPage + 1)}>Next</button>
                        </li>
                    </ul>
                </div>
            }
            {/* Pagination Controls */}

        </div>
    );
};

export default ProductList;
