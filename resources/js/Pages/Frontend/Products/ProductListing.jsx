import { Link, usePage } from '@inertiajs/react';
import React, { useState } from 'react';


export default function ProductListing({ products }) {
    let auth = usePage().props.auth;
    // State for filters
    const [selectedCategories, setSelectedCategories] = useState([]);
    const [selectedSizes, setSelectedSizes] = useState([]);
    const [selectedPriceRange, setSelectedPriceRange] = useState("");
    const [selectedSort, setSelectedSort] = useState("asc");

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
            prev == 'asc' ? 'desc' : 'asc'
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

    filteredProducts.sort(function (a, b) {
        if (a.updatedAt > b.updatedAt) {
            return selectedSort == 'desc' ? -1 : 1;
        }

        if (a.updatedAt == b.updatedAt) {
            return 0;
        }

        if (a.updatedAt < b.updatedAt) {
            return selectedSort == 'desc' ? 1 : -1;
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
                            <h2>All Products</h2>
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
                                                {[
                                                    { label: "Low", min: 0, max: 1000 },
                                                    { label: "High", min: 1000, max: Infinity },
                                                ].map((range) => (
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
                                                {["Small", "Medium", "Large"].map((size) => (
                                                    <li key={size}>
                                                        <div className="form-check">
                                                            <input
                                                                className="form-check-input"
                                                                type="checkbox"
                                                                value={size}
                                                                onChange={() =>
                                                                    handleSizeChange(size)
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
                            <div className="mt-3">
                                            <button className="btn btn-secondary" onClick={clearFilters}>
                                                Clear Filters
                                            </button>
                                        </div>
                        </div>
                    </div>

                    {/* Product Listing Section */}
                    <div className="col-sm-9">
                        <div className="row" data-aos="fade-up">
                            <div className="col-sm-12 text-right">
                                <div className="product-select mb-4">
                                    <select onChange={handleSort} className="form-select" aria-label="Default select example">
                                        <option selected value="asc">Asc</option>
                                        <option value="desc">Desc</option>
                                    </select>
                                </div>
                            </div>

                            {filteredProducts.map((product, index) => (
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
