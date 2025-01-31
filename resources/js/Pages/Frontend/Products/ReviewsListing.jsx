import React, { useState } from "react";

const ReviewsListing = ({ product_reviews }) => {
  const [currentPage, setCurrentPage] = useState(1); // Current page state
  const reviewsPerPage = 5; // Reviews per page

  // Calculate total pages
  const totalPages = Math.ceil(product_reviews.length / reviewsPerPage);

  // Get reviews for the current page
  const indexOfLastReview = currentPage * reviewsPerPage;
  const indexOfFirstReview = indexOfLastReview - reviewsPerPage;
  const currentReviews = product_reviews.slice(indexOfFirstReview, indexOfLastReview);

  // Handle page change
  const handlePageChange = (pageNumber) => {
    if (pageNumber > 0 && pageNumber <= totalPages) {
      setCurrentPage(pageNumber);
    }
  };

  const formatDateToRelative = (dateString) => {
    if (!dateString) return "1 day ago"; // Default fallback
  
    const reviewDate = new Date(dateString);
    const currentDate = new Date();
    const differenceInMilliseconds = currentDate - reviewDate;
  
    const daysAgo = Math.floor(differenceInMilliseconds / (1000 * 60 * 60 * 24));
    if (daysAgo === 0) return "Today";
    if (daysAgo === 1) return "1 day ago";
    return `${daysAgo} days ago`;
  };

  return (
    <div className="col-sm-12">
      {currentReviews.map((review, index) => (
      <div className="reviews-listing" key={index}>
        
          <div className="row align-items-center" key={index}>
            <div className="col-sm-2">
              <div className="person-name">
                <h4>{review.username}</h4>
                {/* Render stars dynamically based on rating */}
                {[...Array(Math.floor(review.rating))].map((_, i) => (
                  <img
                    key={`full-${i}`}
                    src="/assets/images/product-details/star1.png"
                    alt="Full star"
                  />
                ))}
                {review.rating % 1 >= 0.5 && (
                  <img
                    src="/assets/images/product-details/star2.png"
                    alt="Half star"
                  />
                )}
                {[...Array(5 - Math.ceil(review.rating))].map((_, i) => (
                  <img
                    key={`empty-${i}`}
                    src="/assets/images/product-details/star3.png"
                    alt="Empty star"
                  />
                ))}
              </div>
            </div>
            <div className="col-sm-9">
              <div className="review-content">
                <p>
                  <b>{review.headline}</b>
                </p>
                <p>{review.comment}</p>
              </div>
            </div>
            <div className="col-sm-1">
              <div className="last-day-review">
                <p>{formatDateToRelative(review.created_at) || "1 day ago"}</p>
              </div>
            </div>
          </div>
        
      </div>
))}
{currentReviews.length ==0 && 
  <div className="text-center mt-2">No Reviews Yet</div>
}


      {/* Pagination */}
      <div className="Page navigation review-pagination mt-5">
        <ul className="pagination">
          <li
            className={`page-item ${currentPage === 1 ? "disabled" : ""}`}
            onClick={() => handlePageChange(currentPage - 1)}
          >
            <a className="page-link" href="#">Previous</a>
          </li>
          {Array.from({ length: totalPages }, (_, i) => (
            <li
              key={i}
              className={`page-item ${currentPage === i + 1 ? "active" : ""}`}
              onClick={() => handlePageChange(i + 1)}
            >
              <a className="page-link" href="#">{i + 1}</a>
            </li>
          ))}
          <li
            className={`page-item ${currentPage === totalPages ? "disabled" : ""}`}
            onClick={() => handlePageChange(currentPage + 1)}
          >
            <a className="page-link" href="#">Next</a>
          </li>
        </ul>
      </div>
    </div>
  );
};

export default ReviewsListing;
