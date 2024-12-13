import HomeLayout from "@/Layouts/HomeLayout";
import { Head, router } from "@inertiajs/react";
import React, { useState } from "react";

export default function EditAddress({ auth, shipping_address }) {
  const [formData, setFormData] = useState({
    shipping_address_id:shipping_address.shipping_address_id,
    shipping_full_name: shipping_address.shipping_full_name || "",
    shipping_mobile_no: shipping_address.shipping_mobile_no || "",
    shipping_address_line1: shipping_address.shipping_address_line1 || "",
    shipping_address_line2: shipping_address.shipping_address_line2 || "",
    shipping_landmark: shipping_address.shipping_landmark || "",
    shipping_city: shipping_address.shipping_city || "",
    shipping_pincode: shipping_address.shipping_pincode || "",
    shipping_district: shipping_address.shipping_district || "",
    shipping_state: shipping_address.shipping_state || "",
    shipping_address_type: shipping_address.shipping_address_type || "",
    shipping_email: shipping_address.shipping_email || "",
    default_address_flag: shipping_address.default_address_flag || 0,
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    // Send data to backend route `address.update`
    router.post(
      route("address.update"), // Assuming you pass the `id` of the address
      formData,
      {
        onSuccess: () => {
          console.log("Address updated successfully!");
        },
        onError: (errors) => {
          console.error("Validation errors: ", errors);
        },
      }
    );
  };

  return (
    <HomeLayout auth={auth}>
      <Head title="Edit Shipping Address" />

      <div className="container my-4">
        <h1 className="text-center mb-4">Edit Shipping Address</h1>
        <form onSubmit={handleSubmit} className="p-4 border rounded shadow-sm bg-white">
          <div className="mb-3">
            <label className="form-label">Full Name</label>
            <input
              type="text"
              name="shipping_full_name"
              value={formData.shipping_full_name}
              onChange={handleChange}
              className="form-control"
              required
            />
            <input type="hidden" name="shipping_address_id" value={formData.shipping_address_id} />
          </div>

          <div className="mb-3">
            <label className="form-label">Mobile Number</label>
            <input
              type="text"
              name="shipping_mobile_no"
              value={formData.shipping_mobile_no}
              onChange={handleChange}
              className="form-control"
              required
            />
          </div>


          <div className="mb-3">
            <label className="form-label">Address Line 1</label>
            <input
              type="text"
              name="shipping_address_line1"
              value={formData.shipping_address_line1}
              onChange={handleChange}
              className="form-control"
              required
            />
          </div>

          <div className="mb-3">
            <label className="form-label">Address Line 2</label>
            <input
              type="text"
              name="shipping_address_line2"
              value={formData.shipping_address_line2}
              onChange={handleChange}
              className="form-control"
            />
          </div>

          <div className="mb-3">
            <label className="form-label">Landmark</label>
            <input
              type="text"
              name="shipping_landmark"
              value={formData.shipping_landmark}
              onChange={handleChange}
              className="form-control"
              required
            />
          </div>

          <div className="mb-3">
            <label className="form-label">City</label>
            <input
              type="text"
              name="shipping_city"
              value={formData.shipping_city}
              onChange={handleChange}
              className="form-control"
              required
            />
          </div>

          <div className="mb-3">
            <label className="form-label">Pincode</label>
            <input
              type="text"
              name="shipping_pincode"
              value={formData.shipping_pincode}
              onChange={handleChange}
              className="form-control"
              required
            />
          </div>

          <div className="mb-3">
            <label className="form-label">District</label>
            <input
              type="text"
              name="shipping_district"
              value={formData.shipping_district}
              onChange={handleChange}
              className="form-control"
              required
            />
          </div>

          <div className="mb-3">
            <label className="form-label">State</label>
            <input
              type="text"
              name="shipping_state"
              value={formData.shipping_state}
              onChange={handleChange}
              className="form-control"
              required
            />
          </div>

          <div className="mb-3">
            <label className="form-label">Email</label>
            <input
              type="email"
              name="shipping_email"
              value={formData.shipping_email}
              onChange={handleChange}
              className="form-control"
              required
            />
          </div>

          <div className="mb-3">
            <label className="form-label">Address Type</label>
            <select
              name="shipping_address_type"
              value={formData.shipping_address_type}
              onChange={handleChange}
              className="form-select"
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
              name="default_address_flag"
              checked={formData.default_address_flag === 1}
              onChange={(e) =>
                setFormData({ ...formData, default_address_flag: e.target.checked ? 1 : 0 })
              }
              className="form-check-input"
            />
            <label className="form-check-label">Set as Default Address</label>
          </div>

          <div className="text-center">
            <button type="submit" className="btn btn-primary">Update Address</button>
          </div>
        </form>
      </div>
    </HomeLayout>
  );
}
