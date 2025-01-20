import React from "react";


const CategoriesContent = ({ categoriescontent }) => {
  return (
    <div className="container mt-4">
      <div className="card">
        <div className="card-header bg-primary text-white">
          <h5 className="mb-0">Category Content Details</h5>
        </div>
        <div className="card-body">
          <div className="mb-3">
            <h6 className="text-muted">Meta Information</h6>
            <ul className="list-group">
              <li className="list-group-item">
                <strong>Meta Title:</strong> {categoriescontent.meta_title}
              </li>
              <li className="list-group-item">
                <strong>Meta Description:</strong> {categoriescontent.meta_desc}
              </li>
              <li className="list-group-item">
                <strong>Meta Keywords:</strong> {categoriescontent.meta_keywords}
              </li>
            </ul>
          </div>

          <div className="mb-3">
            <h6 className="text-muted">OG Information</h6>
            <ul className="list-group">
              <li className="list-group-item">
                <strong>OG Title:</strong> {categoriescontent.og_title}
              </li>
              <li className="list-group-item">
                <strong>OG Description:</strong> {categoriescontent.og_desc}
              </li>
            </ul>
          </div>

          <div className="mb-3">
            <h6 className="text-muted">Content Information</h6>
            <p>
              <strong>Content Date:</strong>{" "}
              {new Date(categoriescontent.content_date).toLocaleDateString()}
            </p>
            <p>
              <strong>Content:</strong>
            </p>
            <div
              dangerouslySetInnerHTML={{ __html: categoriescontent.contents }}
              className="bg-light p-3 rounded border"
            ></div>
          </div>

         

          
        </div>
      </div>
    </div>
  );
};

export default CategoriesContent;
