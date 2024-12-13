import HomeLayout from "@/Layouts/HomeLayout";
import { Head, router } from "@inertiajs/react";
import React, { useState } from "react";



export default function AddAddress({ auth }) {
  const [formData, setFormData] = useState({
    shipping_full_name: "",
    shipping_mobile_no: "",
    shipping_address_line1: "",
    shipping_address_line2: "",
    shipping_landmark: "",
    shipping_city: "",
    shipping_pincode: "",
    shipping_district: "",
    shipping_state: "",
    shipping_address_type: "",
    shipping_email: "",
    default_address_flag: false,
  });

  const handleInputChange = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData({
      ...formData,
      [name]: type === "checkbox" ? checked : value,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
  
    // Submit form data to the route `address.store`
    router.post(route("address.store"), formData, {
      onSuccess: () => {
        console.log("Address submitted successfully");
      },
      onError: (errors) => {
        console.error("Validation Errors: ", errors);
      },
    });
  };

  return (
    <HomeLayout auth={auth}>
      <Head title="Add Shipping Address" />

      <div className="container my-5">
        <h1 className="text-center mb-4">Add Shipping Address</h1>

        <form onSubmit={handleSubmit} className="card p-4">
          <div className="row mb-3">
            <div className="col-md-6">
              <label htmlFor="shipping_full_name" className="form-label">
                Full Name <span className="text-danger">*</span>
              </label>
              <input
                type="text"
                className="form-control"
                id="shipping_full_name"
                name="shipping_full_name"
                value={formData.shipping_full_name}
                onChange={handleInputChange}
                required
              />
            </div>
            <div className="col-md-6">
              <label htmlFor="shipping_mobile_no" className="form-label">
                Mobile Number <span className="text-danger">*</span>
              </label>
              <input
                type="tel"
                className="form-control"
                id="shipping_mobile_no"
                name="shipping_mobile_no"
                value={formData.shipping_mobile_no}
                onChange={handleInputChange}
                required
              />
            </div>
          </div>

          <div className="row mb-3">
            <div className="col-md-6">
              <label htmlFor="shipping_address_line1" className="form-label">
                Address Line 1 <span className="text-danger">*</span>
              </label>
              <input
                type="text"
                className="form-control"
                id="shipping_address_line1"
                name="shipping_address_line1"
                value={formData.shipping_address_line1}
                onChange={handleInputChange}
                required
              />
            </div>
            <div className="col-md-6">
              <label htmlFor="shipping_address_line2" className="form-label">
                Address Line 2 <span className="text-danger">*</span>
              </label>
              <input
                type="text"
                className="form-control"
                id="shipping_address_line2"
                name="shipping_address_line2"
                value={formData.shipping_address_line2}
                onChange={handleInputChange}
                required
              />
            </div>
          </div>

          <div className="row mb-3">
            <div className="col-md-4">
              <label htmlFor="shipping_landmark" className="form-label">
                Landmark <span className="text-danger">*</span>
              </label>
              <input
                type="text"
                className="form-control"
                id="shipping_landmark"
                name="shipping_landmark"
                value={formData.shipping_landmark}
                onChange={handleInputChange}
                required
              />
            </div>
            <div className="col-md-4">
              <label htmlFor="shipping_city" className="form-label">
                City <span className="text-danger">*</span>
              </label>
              <input
                type="text"
                className="form-control"
                id="shipping_city"
                name="shipping_city"
                value={formData.shipping_city}
                onChange={handleInputChange}
                required
              />
            </div>
            <div className="col-md-4">
              <label htmlFor="shipping_pincode" className="form-label">
                Pincode <span className="text-danger">*</span>
              </label>
              <input
                type="text"
                className="form-control"
                id="shipping_pincode"
                name="shipping_pincode"
                value={formData.shipping_pincode}
                onChange={handleInputChange}
                required
              />
            </div>
          </div>

          <div className="row mb-3">
            <div className="col-md-4">
              <label htmlFor="shipping_district" className="form-label">
                District <span className="text-danger">*</span>
              </label>
              <input
                type="text"
                className="form-control"
                id="shipping_district"
                name="shipping_district"
                value={formData.shipping_district}
                onChange={handleInputChange}
                required
              />
            </div>
            <div className="col-md-4">
              <label htmlFor="shipping_state" className="form-label">
                State <span className="text-danger">*</span>
              </label>
              <input
                type="text"
                className="form-control"
                id="shipping_state"
                name="shipping_state"
                value={formData.shipping_state}
                onChange={handleInputChange}
                required
              />
            </div>
            <div className="col-md-4">
              <label htmlFor="shipping_email" className="form-label">
                Email <span className="text-danger">*</span>
              </label>
              <input
                type="email"
                className="form-control"
                id="shipping_email"
                name="shipping_email"
                value={formData.shipping_email}
                onChange={handleInputChange}
                required
              />
            </div>
          </div>

          <div className="mb-3">
            <label htmlFor="shipping_address_type" className="form-label">
              Address Type <span className="text-danger">*</span>
            </label>
            <select
              className="form-select"
              id="shipping_address_type"
              name="shipping_address_type"
              value={formData.shipping_address_type}
              onChange={handleInputChange}
              required
            >
              <option value="">Select Address Type</option>
              <option value="Home">Home</option>
              <option value="Office">Office</option>
            </select>
          </div>

          <div className="mb-3 form-check">
            <input
              type="checkbox"
              className="form-check-input"
              id="default_address_flag"
              name="default_address_flag"
              checked={formData.default_address_flag}
              onChange={handleInputChange}
            />
            <label className="form-check-label" htmlFor="default_address_flag">
              Set as Default Address
            </label>
          </div>

          <div className="text-center">
            <button type="submit" className="btn btn-primary">
              Save Address
            </button>
          </div>
        </form>
      </div>
    </HomeLayout>
  );
}
