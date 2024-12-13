import { Link } from '@inertiajs/react';
import React, { useState } from 'react';


export default function ProductListing({ products }) {
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
                                                {["food", "protein"].map(
                                                    (category) => (
                                                        <li key={category}>
                                                            <div className="form-check">
                                                                <input
                                                                    className="form-check-input"
                                                                    type="checkbox"
                                                                    value={category}
                                                                    onChange={() =>
                                                                        handleCategoryChange(category)
                                                                    }
                                                                />
                                                                <label className="form-check-label">
                                                                    {category}
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
                                                    { label: "Below ₹500", min: 0, max: 500 },
                                                    { label: "₹500 - ₹1000", min: 500, max: 1000 },
                                                    { label: "Above ₹1000", min: 1000, max: Infinity },
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
                        </div>
                    </div>

                    {/* Product Listing Section */}
                    <div className="col-sm-9">
                        <div className="row" data-aos="fade-up">
                            <div class="col-sm-12 text-right">
                                <div class="product-select mb-4">
                                    <select onChange={handleSort} class="form-select" aria-label="Default select example">
                                        <option selected value="asc">Asc</option>
                                        <option value="desc">Desc</option>
                                    </select>
                                </div>
                            </div>

                            {filteredProducts.map((product, index) => (
                                <a href={'product/view/'+ product.id} className={index > 2 ? "col-sm-4 mt-5" : "col-sm-4"} key={product.id}>
                                    <form action="/product/addtocart" method='post'>

                                        <input type="hidden" name='_token' value={document.querySelector('meta[name="csrf-token"]').getAttribute('content')} />
                                        <input type="hidden" name='product_id' value={product.id} />
                                        <input type="hidden" name='quantity' value={1} />
                                        <input type="hidden" name='product_type' value='simple' />
                                        <input type="hidden" name='product_price' value={product.price} />
                                        <div className="feature-box">


                                            <button
                                                type='submit'

                                            >
                                                <div className="basket-box">
                                                    <i className="fal fa-shopping-basket"></i>
                                                </div>
                                            </button>
                                            <Link method="post" href={route('wishlist.add')} as='button' type='button' data={{product_id: product.id}}><i className="fal fa-heart heart"></i></Link>
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
                                                                src="./assets/images/star.png"
                                                                alt="star"
                                                            />
                                                        ))}
                                                    <span>( {product.reviews} reviews )</span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </a>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
