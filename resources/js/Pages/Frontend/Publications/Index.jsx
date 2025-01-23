import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import HomeLayout from "@/Layouts/HomeLayout";
import { Head, usePage } from "@inertiajs/react";
import React, { useState } from 'react';

export default function Index({ publications }) {
    const auth = usePage().props.auth;
    
    // Declare state variables for pagination
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 10; // Number of publications per page
    
    // Calculate total pages
    const totalPages = Math.ceil(publications.length / itemsPerPage);

    // Function to get the publications for the current page
    const paginatePublications = () => {
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        return publications.slice(startIndex, endIndex);
    };

    // Function to handle pagination
    const paginate = (pageNumber) => {
        if (pageNumber > 0 && pageNumber <= totalPages) {
            setCurrentPage(pageNumber);
        }
    };

    // Current page publications
    const currentPublications = paginatePublications();

    return (
        <HomeLayout auth={auth}>
            <Head title={"Publications"} />
            <div className="sub-banner bg-light">
                <div className="container">
                    <div className="row">
                        <div className="col-sm-12">
                            <div className="banner_heading pb-4">
                                <h2>Publications</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section className="section product_listing privacy-policy">
                <div className="container">
                    <div className="row align-items-center">
                        {currentPublications.map((publication) => (
                            <a className="col-sm-4" href={'/publication/'+ publication.publication_slug} key={publication.id}>
                                <div
                                    style={{
                                        padding: "16px",
                                        margin: "8px",
                                        border: "1px solid #ccc",
                                        borderRadius: "8px",
                                        textAlign: "left",
                                        flex: "0 0 calc(33.333% - 16px)",
                                        boxSizing: "border-box",
                                    }}
                                >
                                    <p
                                        style={{
                                            fontWeight: "bold",
                                            marginBottom: "8px",
                                        }}
                                    >
                                        {publication.publications_title}
                                    </p>
                                    <p><div className="text-truncate"
                                        dangerouslySetInnerHTML={{
                                            __html: publication.publications_sub_title ,
                                        }}
                                    /></p>
                                </div>
                            </a>
                        ))}
                    </div>
                </div>
            </section>

            {/* Pagination */}
            {publications.length !== 0 && (
                <div className="Page navigation review-pagination mt-5 mb-2">
                    <ul className="pagination">
                        <li className="page-item">
                            <button 
                                href="#" 
                                className="page-link" 
                                disabled={currentPage === 1}
                                onClick={() => paginate(currentPage - 1)} 
                            >
                                Previous
                            </button>
                        </li>
                        {Array.from({ length: totalPages }, (_, i) => (
                            <li className="page-item" key={i}>
                                <a 
                                    className={currentPage === i + 1 ? "page-link active" : "page-link"} 
                                    onClick={() => paginate(i + 1)} 
                                    href="#"
                                >
                                    {i + 1}
                                </a>
                            </li>
                        ))}
                        <li className="page-item">
                            <button 
                                className="page-link" 
                                href="#" 
                                disabled={currentPage === totalPages}
                                onClick={() => paginate(currentPage + 1)}
                            >
                                Next
                            </button>
                        </li>
                    </ul>
                </div>
            )}
        </HomeLayout>
    );
}
