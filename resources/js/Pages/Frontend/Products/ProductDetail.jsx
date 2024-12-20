import HomeLayout from '@/Layouts/HomeLayout';
import { Link, router, usePage } from '@inertiajs/react';
import axios from 'axios';
import React, { useState } from 'react';
import RatingAndReviews from './RatingAndReviews';
import ReviewsListing from './ReviewsListing';
import ReviewForm from './ReviewForm';


const ProductDetail = ({ auth, product, product_reviews, product_images, average_rating }) => {

    const fullStars = Math.floor(average_rating); // Number of full stars
    const hasHalfStar = average_rating % 1 >= 0.1; // Check if there's a half star

    const { slug } = new URLSearchParams(); // Get the slug from the URL
    const { errors } = usePage().props;
    // Ensure `product` is passed as a prop, or fetch it if needed
    if (!product) {
        return (
            <Container classNameNameName="mt-5">
                <p>Loading product details...</p>
            </Container>
        );
    }

    function canReview(productId) {
        // Check if the given productId exists in any order's products
        const hasPurchased = auth.orders.some((order) =>
            order.orderproducts.some((product) => product.product_id === productId)
        );

        return hasPurchased;

    }

    const [values, setValues] = useState({
        pincode: '',
    })

    function handleChange(e) {
        const key = e.target.id;
        const value = e.target.value
        setValues(values => ({
            ...values,
            [key]: value,
        }))
    }

    const [courierData, setCourierData] = useState({ courier: null, fastest_etd: "" });
    const [error, setError] = useState("");

    function handleSubmit(e) {
        e.preventDefault();
        axios
            .post("/product/pincode/check", values)
            .then((response) => {
                setCourierData({ courier: JSON.parse((response['data']))['data']['available_courier_companies'][0]['courier_name'], fastest_etd: JSON.parse((response['data']))['data']['available_courier_companies'][0]['estimated_delivery_days'] });
            })
            .catch((err) => {
                setCourierData({ courier: '', fastest_etd: '' });
            });
    }

    $(document).ready(function () {
        $("#fixedBox").removeClass("visible").addClass("hidden");
        $(window).on("scroll", function () {
            var $fixedBox = $("#fixedBox");
            var $section2 = $("#section2");
            var section2Top = $section2.offset().top;
            var section2Bottom = section2Top + $section2.outerHeight();
            var scrollY = $(window).scrollTop() + $(window).height() / 2; // Adjust trigger point
            // && scrollY <= section2Bottom
            if (scrollY >= section2Top) {
                $fixedBox.removeClass("hidden").addClass("visible");
            } else {
                $fixedBox.removeClass("visible").addClass("hidden");
            }
        });
        $("#addtoBasketButton").on("click", function () {
            $("#addBasketModal").modal("toggle");
            // toaster
            swal({
                title: "",
                text: "“Dana Meethi Laddoo” Added to Your Basket!",
                // imageUrl: "thumbs-up.jpg",
                timer: 2000,
            });
        });
    });
    const [productQty, setQty] = useState(1);
    const [totalPrice, setPrice] = useState(product.product_discounted_price * productQty);

    return (
        <HomeLayout auth={auth}>
            <section className="section pt-5 products-details bg_light">
                <div className="container">
                    <div className="row g-5">
                        <div className="col-sm-6">
                            <div className="main-image-box">
                                <h2 className="product-details-heading mb-4">
                                    All Products {'>>'}  <span>{product.product_title}</span>
                                </h2>
                                <div className="images-box">
                                    <div className="image-b-box">
                                        <img
                                            src={'/backend-assets/uploads/product_thumbs/' + product.product_thumb}
                                            alt="product details image"
                                        />
                                    </div>
                                    <div className="image-s-boxes">
                                        <img
                                            src={'/backend-assets/uploads/product_images/' + product_images[0].image_name}
                                            alt=""
                                        />
                                        <img
                                            src={'/backend-assets/uploads/product_images/' + product_images[1].image_name}
                                            alt=""
                                        />
                                        <img
                                            src={'/backend-assets/uploads/product_images/' + product_images[2].image_name}
                                            alt=""
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="col-sm-6">
                            <div className="content-box">
                                <h2 className="product-details-heading">
                                    <span>{product.product_title}</span>
                                </h2>
                                <div className="content-price">
                                    <h4><span>₹{product.product_price}.00</span>₹{product.product_discounted_price}.00</h4>
                                    <p className="content-offer">Offer</p>
                                </div>
                                <div className="content-star star">
                                    {[...Array(fullStars)].map((_, index) => (
                                        <img
                                            key={`full-${index}`}
                                            src="/assets/images/product-details/star1.png"
                                            alt="Full star"
                                        />
                                    ))}

                                    {/* Render half star */}
                                    {hasHalfStar && (
                                        <img
                                            src="/assets/images/product-details/star2.png"
                                            alt="Half star"
                                        />
                                    )}


                                    <span>({product_reviews.length} Reviews)</span>
                                </div>
                                <div className="main-content">
                                    <h6>
                                        {product.product_sub_title}
                                    </h6>
                                    <div dangerouslySetInnerHTML={{ __html: product.product_specification }}>

                                    </div>
                                    <ul className="icon-list mt-3">
                                        <div dangerouslySetInnerHTML={{ __html: product.product_desc }}></div>
                                    </ul>
                                </div>
                                <div className="kg-box position-relative">
                                    <p>Choose Weight: 1Kg</p>
                                    <button className="button gram-button active">1 Kg</button>

                                    <button className="button gram-button">500 g</button>
                                    <button className="button gram-button">250 g</button>
                                    <p className="get-offer">
                                        <img src="/assets/images/product-details/SVG.png" /><br />Get
                                        Offer
                                    </p>
                                </div>
                                <div className="black-button mt-5">
                                    <Link
                                        type="button"
                                        className="btn btn-primary black"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addBasketModal"
                                        data-price={totalPrice}
                                        data-quantity={productQty}
                                    >
                                        ₹{totalPrice}.00 &nbsp;&nbsp;|&nbsp;&nbsp; +
                                        &nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; Add 1 to basket
                                        &nbsp;&nbsp; |&nbsp;&nbsp; - &nbsp;&nbsp;|
                                    </Link>

                                    <Link type='button' href={route('wishlist.add')} method="post" as='button' className="gray" data={{product_id: product.product_id}}>
                                        <img src="/assets/images/product-details/heart.png" />
                                    </Link>
                                    
                                    <p className="free-delivery text-center">
                                        <img
                                            src="/assets/images/product-details/delivery-truck.png"
                                        />Free delivery over ₹500
                                    </p>
                                    <div
                                        className="accordion product-ingredients mt-3"
                                        id="accordionExample"
                                    >
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
                                                    Ingredients
                                                </button>
                                            </h2>
                                            <div
                                                id="collapseOne"
                                                className="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample"
                                            >
                                                <div className="accordion-body pt-0 ms-3" dangerouslySetInnerHTML={{ __html: product.ingredients }}>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section className="section bg_light pt-4">
                <div className="marquee">
                    <div className="marquee__item">
                        No preservatives. 100% natural. Handcrafted with love.
                        <span className="marquee__seperator"></span>
                        No preservatives. 100% natural. Handcrafted with love.
                        <span className="marquee__seperator"></span>
                        No preservatives. 100% natural. Handcrafted with love.
                        <span className="marquee__seperator"></span>
                        No preservatives. 100% natural. Handcrafted with love.
                        <span className="marquee__seperator"></span>
                        No preservatives. 100% natural. Handcrafted with love.
                        <span className="marquee__seperator"></span>
                        No preservatives. 100% natural. Handcrafted with love.
                        <span className="marquee__seperator"></span>
                        No preservatives. 100% natural. Handcrafted with love.
                        <span className="marquee__seperator"></span>
                    </div>
                    <div className="marquee__item">
                        No preservatives. 100% natural. Handcrafted with love.
                        <span className="marquee__seperator"></span>
                        No preservatives. 100% natural. Handcrafted with love.
                        <span className="marquee__seperator"></span>
                        No preservatives. 100% natural. Handcrafted with love.
                        <span className="marquee__seperator"></span>
                        No preservatives. 100% natural. Handcrafted with love.
                        <span className="marquee__seperator"></span>
                        No preservatives. 100% natural. Handcrafted with love.
                        <span className="marquee__seperator"></span>
                        No preservatives. 100% natural. Handcrafted with love.
                        <span className="marquee__seperator"></span>
                        No preservatives. 100% natural. Handcrafted with love.
                        <span className="marquee__seperator"></span>
                    </div>
                </div>
            </section>

            <section className="section usage-instructions bg_light pt-4" id="section2">
                <div className="container">
                    <div className="row g-5">
                        <div className="col-sm-6">
                            <div className="instruction-image">
                                <img
                                    src={'/backend-assets/uploads/product_thumbs/' + product.product_thumb}
                                    alt=""
                                />
                            </div>
                        </div>
                        <div className="col-sm-6">
                            <div className="instruction-content">
                                <h2 className="product-details-heading mb-4">Usage Instructions</h2>
                                <p>
                                    <img
                                        src="./assets/images/product-details/consumed-hours.png"
                                        alt=""
                                    />When to Consume
                                </p>
                                <ul>
                                    <li>
                                        Postpartum: Consume 1 laddoo daily for lactation and recovery.
                                    </li>
                                    <li>General Health: Ideal for adults as a nutritious snack.</li>
                                </ul>
                                <p>
                                    <img
                                        src="./assets/images/product-details/basket.png"
                                        alt=""
                                    />How to Store
                                </p>
                                <ul>
                                    <li>Keep in an airtight container.</li>
                                    <li>Store in a cool, dry place.</li>
                                </ul>
                                <p>
                                    <img
                                        src="./assets/images/product-details/milk.png"
                                        alt=""
                                    />Shelf Life
                                </p>
                                <ul>
                                    <li>Best before 30 days from the date of preparation.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="half-circle">
                    <img src="./assets/images/half-circle.png" />
                </div>
            </section>

            <section className="why-choose">
                <div className="container">
                    <div className="row">
                        <div className="col-sm-6">
                            <div className="why-choose-content">
                                <h3 className="common-heading">
                                    Why Choose Jaccha Dana Methi Laddoos?
                                </h3>
                                <ul className="ms-4" dangerouslySetInnerHTML={{ __html: product.product_disclaimer }}>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section className="section reviews">
                <div className="container">
                    <div className="row">
                        <div className="col-sm-12">
                            <div className="reviews-heading">
                                <h3>{Number(average_rating).toFixed(1)}<span>Based on {product_reviews.length} reviews</span></h3>
                                {canReview(product.product_id) && <button
                                    type="button"
                                    className="btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"
                                >
                                    Write a Review <i className="fal fa-angle-right ms-3"></i>
                                </button>}
                                
                            </div>
                        </div>
                        <ReviewsListing product_reviews={product_reviews}/>
                    </div>
                </div>
            </section>

            <section className="section product_listing">
                <div className="container">
                    <div className="row align-items-center">
                        <div className="col-sm-3">
                            <div
                                className="product-accordian product-listing-heading"
                                data-aos="fade-up"
                                data-aos-delay="200"
                            >
                                <h3 className="common-heading">You may also like</h3>
                                <p>Handpicked treats to complement your wellness journey.</p>
                                <div className="product-details-listing">
                                    <p>Total<br /><span>₹3500</span></p>
                                    <a href="#">Add all to basket</a>
                                </div>
                            </div>
                        </div>
                        <div className="col-sm-9">
                            <div className="row" data-aos="fade-up">
                                <div className="col-sm-4">
                                    <div className="feature-box">
                                        <div className="basket-box">
                                            <i className="fal fa-shopping-basket"></i>
                                        </div>
                                        <i className="fal fa-heart heart"></i>
                                        <img
                                            src="./assets/images/feature/feature-1.png"
                                            alt="feature image"
                                        />
                                        <div className="features-content">
                                            <p>1st Month of Pregnant</p>
                                            <h5>Baby Ubtan</h5>
                                            <h6>₹310.00</h6>
                                            <div className="star">
                                                <img src="./assets/images/star.png" alt="star image" />
                                                <img src="./assets/images/star.png" alt="star image" />
                                                <img src="./assets/images/star.png" alt="star image" />
                                                <img src="./assets/images/star.png" alt="star image" />
                                                <img src="./assets/images/star.png" alt="star image" />
                                                <span>( 6 reviews )</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="feature-box">
                                        <div className="basket-box">
                                            <i className="fal fa-shopping-basket"></i>
                                        </div>
                                        <i className="fal fa-heart heart"></i>
                                        <img
                                            src="./assets/images/feature/feature-2.png"
                                            alt="feature image"
                                        />
                                        <div className="features-content">
                                            <p>1st Month of Pregnant</p>
                                            <h5>Baby Ubtan</h5>
                                            <h6>₹310.00</h6>
                                            <div className="star">
                                                <img src="./assets/images/star.png" alt="star image" />
                                                <img src="./assets/images/star.png" alt="star image" />
                                                <img src="./assets/images/star.png" alt="star image" />
                                                <img src="./assets/images/star.png" alt="star image" />
                                                <img src="./assets/images/star.png" alt="star image" />
                                                <span>( 6 reviews )</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="feature-box">
                                        <div className="basket-box">
                                            <i className="fal fa-shopping-basket"></i>
                                        </div>
                                        <i className="fal fa-heart heart"></i>
                                        <img
                                            src="./assets/images/feature/feature-1.png"
                                            alt="feature image"
                                        />
                                        <div className="features-content">
                                            <p>1st Month of Pregnant</p>
                                            <h5>Baby Ubtan</h5>
                                            <h6>₹310.00</h6>
                                            <div className="star">
                                                <img src="./assets/images/star.png" alt="star image" />
                                                <img src="./assets/images/star.png" alt="star image" />
                                                <img src="./assets/images/star.png" alt="star image" />
                                                <img src="./assets/images/star.png" alt="star image" />
                                                <img src="./assets/images/star.png" alt="star image" />
                                                <span>( 6 reviews )</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section className="sticky-div" id="fixedBox">
                <div className="container">
                    <div className="sticky-product">
                        <div className="sticky-product-img">
                            <img
                                src={'/backend-assets/uploads/product_thumbs/' + product.product_thumb}
                                alt=""
                            />
                            <p>
                                {product.product_title} <br />
                                <span> ₹{product.product_discounted_price}.00 </span>
                            </p>
                        </div>
                        <div className="sticky-product-button">
                            <p>₹{totalPrice}.00</p>
                            <a href="#">
                                <button
                                    type="button"
                                    className="black"
                                    data-bs-toggle="modal"
                                    data-bs-target="#addBasketModal"
                                >
                                    +&nbsp;&nbsp;|<span>Add {productQty} to basket</span>|&nbsp;&nbsp; -
                                </button></a
                            >
                        </div>
                    </div>
                </div>
            </section>

            <div
                className="modal fade addBasket-modal review-modal"
                id="addBasketModal"
                tabIndex="-1"
                aria-labelledby="addBasketModalLabel"
                aria-hidden="true"
            >
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-body">
                            <button
                                type="button"
                                className="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            >
                                <i className="fal fa-times"></i>
                            </button>
                            <div className="row">
                                <div className="col-sm-12">
                                    <div className="add-modal">

                                            <div className="modal_header">
                                                <h2>Customize Your Laddoo!</h2>
                                            </div>
                                            <div className="modal_in px-5 pt-4">
                                                <h5 className="mb-3">Sweetness Level:</h5>
                                                <div className="checkboxes">
                                                    <div className="form-check">
                                                        <input
                                                            className="form-check-input"
                                                            type="checkbox"
                                                            value="low"
                                                            id="flexCheckDefault"
                                                        />
                                                        <label className="form-check-label" htmlFor="flexCheckDefault">
                                                            Low
                                                        </label>
                                                    </div>
                                                    <div className="form-check">
                                                        <input
                                                            className="form-check-input"
                                                            type="checkbox"
                                                            value="medium"
                                                            id="flexCheckDefault"
                                                        />
                                                        <label className="form-check-label" htmlFor="flexCheckDefault">
                                                            Medium
                                                        </label>
                                                    </div>
                                                    <div className="form-check">
                                                        <input
                                                            className="form-check-input"
                                                            type="checkbox"
                                                            value="high"
                                                            id="flexCheckDefault"
                                                        />
                                                        <label className="form-check-label" htmlFor="flexCheckDefault">
                                                            High
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="modal_in px-5 pt-4">
                                                <h5 className="mb-3">Ingredient Add-ons:</h5>
                                                <div className="checkboxes">
                                                    <div className="form-check">
                                                        <input
                                                            className="form-check-input"
                                                            type="checkbox"
                                                            value="almonds"
                                                            id="flexCheckDefault"
                                                        />
                                                        <label className="form-check-label" htmlFor="flexCheckDefault">
                                                            Almonds
                                                        </label>
                                                    </div>
                                                    <div className="form-check">
                                                        <input
                                                            className="form-check-input"
                                                            type="checkbox"
                                                            value="cashews"
                                                            id="flexCheckDefault"
                                                        />
                                                        <label className="form-check-label" htmlFor="flexCheckDefault">
                                                            Cashews
                                                        </label>
                                                    </div>
                                                    <div className="form-check">
                                                        <input
                                                            className="form-check-input"
                                                            type="checkbox"
                                                            value="walnuts"
                                                            id="flexCheckDefault"
                                                        />
                                                        <label className="form-check-label" htmlFor="flexCheckDefault">
                                                            Walnuts
                                                        </label>
                                                    </div>
                                                    <div className="form-check">
                                                        <input
                                                            className="form-check-input"
                                                            type="checkbox"
                                                            value="dates"
                                                            id="flexCheckDefault"
                                                        />
                                                        <label className="form-check-label" htmlFor="flexCheckDefault">
                                                            Dates
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="modal_in px-5 py-4">
                                                <h5 className="mb-3">Ingredient Exclusions:</h5>
                                                <div className="checkboxes">
                                                    <div className="form-check">
                                                        <input
                                                            className="form-check-input"
                                                            type="checkbox"
                                                            value="jaggery"
                                                            id="flexCheckDefault"
                                                        />
                                                        <label className="form-check-label" htmlFor="flexCheckDefault">
                                                            No Jaggery
                                                        </label>
                                                    </div>
                                                    <div className="form-check">
                                                        <input
                                                            className="form-check-input"
                                                            type="checkbox"
                                                            value="ghee"
                                                            id="flexCheckDefault"
                                                        />
                                                        <label className="form-check-label" htmlFor="flexCheckDefault">
                                                            No Ghee
                                                        </label>
                                                    </div>
                                                    <div className="form-check">
                                                        <input
                                                            className="form-check-input"
                                                            type="checkbox"
                                                            value="sugar"
                                                            id="flexCheckDefault"
                                                        />
                                                        <label className="form-check-label" htmlFor="flexCheckDefault">
                                                            No Sugar
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                className="modal-button black-button pt-3 pb-5 m-auto text-center"
                                            >
                                                
                                                <Link href="/product/addtocart" method="post" className="black" id="addtoBasketButton" data={{ product_id: product.product_id, product_type: "simple",quantity:productQty,_token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')}}>
                                                    
                                                    ₹{totalPrice}.00 <span>|</span> Add {productQty} to basket
                                                    <i className="fal fa-angle-right"></i>
                                                </Link>
                                            </div>
                                        

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                className="modal fade review-modal"
                id="exampleModal"
                tabIndex="-1"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-body">
                            <button
                                type="button"
                                className="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            >
                                <i className="fal fa-times"></i>
                            </button>
                            <div className="row">
                                <div className="col-sm-6">
                                    <div className="review-popup-content">
                                        <h2 className="modal-heading">Write A Review</h2>
                                        <ReviewForm productId={product.product_id}/>
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="review-popup-image">
                                        <img
                                            src="/assets/images/product-details/why-choose.jpg"
                                            alt=""
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </HomeLayout>
    );
};

export default ProductDetail;
