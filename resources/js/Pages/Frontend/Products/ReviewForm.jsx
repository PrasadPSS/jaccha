import React, { useState } from "react";
import axios from "axios";

const ReviewForm = ({ productId, onClose }) => {
  const [rating, setRating] = useState(0); // Rating state
  const [title, setTitle] = useState("");
  const [review, setReview] = useState("");
  const [photo, setPhoto] = useState(null);

  const handleRating = (value) => setRating(value); // Update rating
  const handlePhotoChange = (event) => setPhoto(event.target.files[0]);

  const handleSubmit = async (event) => {
    event.preventDefault();
    const formData = new FormData();
    formData.append("product_id", productId);
    formData.append("rating", rating);
    formData.append("headline", title);
    formData.append("comment", review);
    if (photo) {

      formData.append("photo", photo);
    }

    try {
      const response = await axios.post("/rating/review", formData); // Post data to backend

      alert("Review submitted successfully!");

    } catch (error) {
      console.error(error);
      alert("Failed to submit the review.");
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      <div className="review-form-box mb-3">
        <label htmlFor="reviewFormControlstar" className="form-label">
          My Rate
        </label>
        {[...Array(5)].map((_, index) => (
          <img
            key={index}
            src={`/assets/images/product-details/star${
              index < rating ? "1" : "3"
            }.png`}
            alt=""
            onClick={() => handleRating(index + 1)}
            style={{ cursor: "pointer" }}
          />
        ))}
      </div>

      <div className="mb-4">
        <label htmlFor="reviewFormControlTextarea" className="form-label">
          Review
        </label>
        <textarea
          className="form-control"
          id="reviewFormControlTextarea"
          rows="2"
          value={review}
          onChange={(e) => setReview(e.target.value)}
        ></textarea>
      </div>

      <div className="mb-4">
        <label htmlFor="reviewFormControlInput" className="form-label">
          Title
        </label>
        <input
          type="text"
          className="form-control"
          id="reviewFormControlInput"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
        />
      </div>

      <div>
        <div className="btn review-form-button">
          <label
            className="form-label text-white m-1"
            htmlFor="customFile1"
          >
            <i className="fal fa-folder-upload"></i> Upload Photo
          </label>
          <input
            type="file"
            className="form-control d-none"
            id="customFile1"
            onChange={handlePhotoChange}
          />
        </div>
      </div>

      <div className="footer_button mt-5">
        <button type="submit" className="button save_button" data-bs-dismiss="modal">
          Save
        </button>
        <button
          type="button"
          className="button"
          data-bs-dismiss="modal"
        >
          Cancel
        </button>
      </div>
    </form>
  );
};

export default ReviewForm;
