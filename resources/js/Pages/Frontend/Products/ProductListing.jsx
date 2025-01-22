import { Link, usePage } from '@inertiajs/react';
import React, { useState } from 'react';
import ProductList from './ProductList';
import { useEffect } from 'react';


export default function ProductListing({ products, sizes1, prices }) {

    let auth = usePage().props.auth;
    let sizes= [];
    let prices1 =[];
    sizes1.map((size)=> 
        {
            sizes.push(size.size_name);
        });
        prices.map((price)=> 
            {
                prices1.push({ label: price.price_name, min: price.min, max: price.max });
            });
   
    // State for filters
    const [selectedCategories, setSelectedCategories] = useState([]);
    const [selectedSizes, setSelectedSizes] = useState([]);
    const [selectedPriceRange, setSelectedPriceRange] = useState("");
    const [selectedSort, setSelectedSort] = useState("low-to-high");

    const [currentPage, setCurrentPage] = useState(1);



    // Handle filter changes
    const handleCategoryChange = (category) => {
        setSelectedCategories((prev) =>
            prev.includes(category)
                ? prev.filter((c) => c !== category)
                : [...prev, category]
        );
    };

    const handleSizeChange = (size) => {
        setSelectedSizes((prev) =>
            prev.includes(size)
                ? prev.filter((s) => s !== size)
                : [...prev, size]
        );
    };

    const handlePriceChange = (priceRange) => {
        setSelectedPriceRange(priceRange);
    };

    const handleSort = () => {
        setSelectedSort((prev) =>
            prev == 'low-to-high' ? 'high-to-low' : 'low-to-high'
        );

    }


    // Filter logic
    const filteredProducts = products.filter((product) => {
        const matchesCategory =
            selectedCategories.length === 0 ||
            selectedCategories.includes(product.category);

        const matchesSize =
            selectedSizes.length === 0 || selectedSizes.includes(product.size);

        const matchesPrice =
            !selectedPriceRange ||
            (product.price >= selectedPriceRange.min &&
                product.price <= selectedPriceRange.max);




        return matchesCategory && matchesSize && matchesPrice;
    });

    useEffect(() => setCurrentPage(1), [selectedCategories, selectedSizes, selectedPriceRange]);

    filteredProducts.sort(function (a, b) {
        if ((a.price - a.discount) > (b.price - b.discount)) {
            return selectedSort == 'low-to-high' ? 1 : -1;
        }

        if ((a.price - a.discount) == (b.price - b.discount)) {
            return 0;
        }

        if ((a.price - a.discount) < (b.price - b.discount)) {
            return selectedSort == 'high-to-low' ? 1 : -1;
        }
    });
    const clearFilters = () => {
        setSelectedCategories([]);
        setSelectedPriceRange(null);
        setSelectedSizes([]);
        const inputs = document.querySelectorAll('.product-accordian input');

        // Iterate over inputs and reset their state
        inputs.forEach((input) => {
            if (input.type === 'checkbox' || input.type === 'radio') {
                input.checked = false; // Uncheck checkboxes and radio buttons
            } else {
                input.value = ''; // Clear other input fields if present
            }
        });
    };


    return (
        <section className="section product_listing">
            <div className="container">
                <div className="row">
                    {/* Filter Section */}
                    <div className="col-sm-3">
                        <div
                            className="product-accordian"
                            data-aos="fade-up"
                            data-aos-delay="200"
                        >
                            <div className="product-filter">
                                <h2 className="">Filters</h2>
                                <button onClick={clearFilters} className="btn btn-primary filter-reset">Reset All</button>
                            </div>

                            <div className="accordion" id="accordionExample">
                                {/* Category Filter */}
                                <div className="accordion-item">
                                    <h2 className="accordion-header">
                                        <button
                                            className="accordion-button"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne"
                                            aria-expanded="true"
                                            aria-controls="collapseOne"
                                        >
                                            Category
                                        </button>

                                    </h2>
                                    <div
                                        id="collapseOne"
                                        className="accordion-collapse collapse show"
                                        data-bs-parent="#accordionExample"
                                    >
                                        <div className="accordion-body">
                                            <ul>
                                                {auth.categories.map(
                                                    (category) => (
                                                        <li key={category.category_id}>
                                                            <div className="form-check">
                                                                <input
                                                                    className="form-check-input"
                                                                    type="checkbox"
                                                                    value={category.category_slug}
                                                                    onChange={() =>
                                                                        handleCategoryChange(category.category_slug)
                                                                    }
                                                                />
                                                                <label className="form-check-label">
                                                                    {category.category_name}
                                                                </label>
                                                            </div>
                                                        </li>
                                                    )
                                                )}
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                {/* Price Filter */}
                                <div className="accordion-item">
                                    <h2 className="accordion-header">
                                        <button
                                            className="accordion-button collapsed"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo"
                                            aria-expanded="false"
                                            aria-controls="collapseTwo"
                                        >
                                            Price
                                        </button>
                                    </h2>
                                    <div
                                        id="collapseTwo"
                                        className="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample"
                                    >
                                        <div className="accordion-body">
                                            <ul>
                                                {prices1.map((range) => (
                                                    <li key={range.label}>
                                                        <div className="form-check">
                                                            <input
                                                                className="form-check-input"
                                                                type="radio"
                                                                name="priceFilter"
                                                                value={range.label}
                                                                onChange={() =>
                                                                    handlePriceChange(range)
                                                                }
                                                            />
                                                            <label className="form-check-label">
                                                                {range.label}
                                                            </label>
                                                        </div>
                                                    </li>
                                                ))}
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                {/* Size Filter */}
                                <div className="accordion-item">
                                    <h2 className="accordion-header">
                                        <button
                                            className="accordion-button collapsed"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree"
                                            aria-expanded="false"
                                            aria-controls="collapseThree"
                                        >
                                            Size
                                        </button>
                                    </h2>
                                    <div
                                        id="collapseThree"
                                        className="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample"
                                    >
                                        <div className="accordion-body">
                                            <ul>
                                                {sizes.map((size) => (
                                                    <li key={size.size_name}>
                                                        <div className="form-check">
                                                            <input
                                                                className="form-check-input"
                                                                type="checkbox"
                                                                value={size.size_name}
                                                                onChange={() =>
                                                                    handleSizeChange(size.size_name)
                                                                }
                                                            />
                                                            <label className="form-check-label">
                                                                {size}
                                                            </label>
                                                        </div>
                                                    </li>
                                                ))}
                                            </ul>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {/* Product Listing Section */}
                    <div className="col-sm-9">
                        <div className="row" data-aos="fade-up">
                            <div className="col-sm-12 text-right">
                                <div className="product-select mb-4">
                                    <select onChange={handleSort} className="form-select" aria-label="Default select example">
                                        <option selected disabled value="">Sort By</option>
                                        <option value="low-to-high">Price low to high</option>
                                        <option value="high-to-low">Price high to low</option>
                                    </select>
                                </div>
                            </div>
                            {filteredProducts.length == 0 && 
                            <div className="container">
                                <div className="row align-items-center empty-product">
                                 
                                    <div className="col-md-8">
                                        <div className="empty-wishlist-content">
                                            <h2>Oops! No products found.</h2>
                                            <p>
                                                It seems like we couldn't find any products matching your filters.
                                            </p>
                                            <button onClick={clearFilters} className="btn btn-primary">Reset All</button>
                                        </div>
                                    </div>


                                    <div className="col-md-4">
                                        <div className="empty-wishlist-image">
                                            <img src="/assets/images/empty-wishlist.png" alt="Empty Wishlist Illustration" className="img-fluid" />
                                        </div>
                                    </div>
                                </div>
                            </div>}
                            
                            <ProductList filteredProducts={filteredProducts} setCurrentPage={setCurrentPage} currentPage={currentPage} />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
