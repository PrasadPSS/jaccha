import React, { useState } from "react";
import axios from "axios";

const RatingAndReviews = ({ productReviews, reviews, productId, canReview }) => {
    console.log('asdasdasdas', productReviews);

    const [hasReviewed, sethasReviewed] = useState(reviews.find(review => review.product_id === productId));
    const [rating, setRating] = useState(0);
    const [comment, setComment] = useState("");
    const [successMessage, setSuccessMessage] = useState("");
    const [errorMessage, setErrorMessage] = useState("");

    const handleRatingChange = (newRating) => {
        setRating(newRating);
    };

    const handleSubmit2 = async (e) => {
        e.preventDefault();

        if (!canReview) {
            setErrorMessage("You can only rate/review if you have purchased the product.");
            return;
        }

        try {
            const response = await axios.post("/rating/review/edit", {
                product_id: productId,
                rating,
                comment,
            });
            if (response.data.success) {
                sethasReviewed(true);

            } else {
                setErrorMessage(response.data.message || "Failed to submit your review.");
            }
        } catch (error) {
            setErrorMessage(error.response?.data?.message || "An error occurred.");
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        if (!canReview) {
            setErrorMessage("You can only rate/review if you have purchased the product.");
            return;
        }

        try {
            const response = await axios.post("/rating/review", {
                product_id: productId,
                rating,
                comment,
            });
            if (response.data.success) {
                sethasReviewed(true);

            } else {
                setErrorMessage(response.data.message || "Failed to submit your review.");
            }
        } catch (error) {
            setErrorMessage(error.response?.data?.message || "An error occurred.");
        }
    };

    return (
        <div className="row mt-4">
            <div className="col">
                <h3 className="text-dark fw-bold">Ratings & Reviews</h3>
                {canReview && !hasReviewed ? (
                    <form onSubmit={handleSubmit} className="p-3 border rounded shadow-sm">
                        <div className="mb-3">
                            <label htmlFor="rating" className="form-label fw-semibold">
                                Rating (out of 5)
                            </label>
                            <select
                                id="rating"
                                className="form-select"
                                value={rating}
                                onChange={(e) => handleRatingChange(Number(e.target.value))}
                                required
                            >
                                <option value="">Select a rating</option>
                                {[1, 2, 3, 4, 5].map((val) => (
                                    <option key={val} value={val}>
                                        {val}
                                    </option>
                                ))}
                            </select>
                        </div>
                        <div className="mb-3">
                            <label htmlFor="comment" className="form-label fw-semibold">
                                Comment
                            </label>
                            <textarea
                                id="comment"
                                className="form-control"
                                rows="3"
                                value={comment}
                                onChange={(e) => setComment(e.target.value)}
                                placeholder="Share your thoughts about this product..."
                                required
                            ></textarea>
                        </div>
                        <button type="submit" className="btn btn-primary">
                            Submit Review
                        </button>
                    </form>
                ) : hasReviewed ? (
                    <div className="alert alert-warning mt-3">
                        You have already reviewed this product
                        <form onSubmit={handleSubmit2} className="p-3 border rounded shadow-sm">
                            <div className="mb-3">
                                <label htmlFor="rating" className="form-label fw-semibold">
                                    Rating (out of 5)
                                </label>
                                <select
                                    id="rating"
                                    className="form-select"
                                    value={rating}
                                    onChange={(e) => handleRatingChange(Number(e.target.value))}
                                    required
                                >
                                    <option value="">Select a rating</option>
                                    {[1, 2, 3, 4, 5].map((val) => (
                                        <option key={val} value={val}>
                                            {val}
                                        </option>
                                    ))}
                                </select>
                            </div>
                            <div className="mb-3">
                                <label htmlFor="comment" className="form-label fw-semibold">
                                    Comment
                                </label>
                                <textarea
                                    id="comment"
                                    className="form-control"
                                    rows="3"
                                    value={comment}
                                    onChange={(e) => setComment(e.target.value)}
                                    placeholder="Share your thoughts about this product..."
                                    required
                                ></textarea>
                            </div>
                            <button type="submit" className="btn btn-primary">
                                Edit Review
                            </button>
                        </form>
                    </div>
                ) : (
                    <div className="alert alert-warning mt-3">
                        You must purchase this product to leave a review.
                    </div>
                )}

                {successMessage && (
                    <div className="alert alert-success mt-3">{successMessage}</div>
                )}
                {errorMessage && (
                    <div className="alert alert-danger mt-3">{errorMessage}</div>
                )}
            </div>
            <div className="container mt-4 mb-4">
                <h2>Reviews</h2>
                {productReviews && productReviews.length > 0 ? (
                    <>
                        {productReviews.map((element) => (
                            <div key={element.id} className="mb-3">
                                <div className="card">
                                    <div className="card-header">
                                        <h5 className="card-title">{element.username}</h5>
                                    </div>
                                    <div className="card-body">
                                        <h5 className="card-subtitle mb-2">Rating: {element.rating}/5</h5>
                                        <p className="card-text">Comment: {element.comment}</p>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </>
                ) : (
                    <p>No reviews available.</p>
                )}
            </div>
        </div>
    );
};

export default RatingAndReviews;