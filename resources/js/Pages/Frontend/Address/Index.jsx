import HomeLayout from "@/Layouts/HomeLayout";
import { Head, Link } from "@inertiajs/react";
import React from "react";

export default function Index({ auth, addresses }) {


    return (
        <HomeLayout auth={auth}>
            <Head title="Shipping Address" />
            <div className="container my-5">
                <h1 className="text-center mb-4">Shipping Address</h1>

                {/* Add Address Button */}
                <div className="d-flex justify-content-end mb-3">
                    <Link as="button" href="/shippingaddress/add" className="btn btn-primary">
                        Add Shipping Address
                    </Link>
                </div>

                {/* Address List */}
                <div className="card">
                    <div className="card-header">
                        <h4>Saved Addresses</h4>
                    </div>
                    <div className="card-body">
                        {addresses && addresses.length > 0 ? (
                            <table className="table table-striped table-bordered">
                                <thead className="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Pincode</th>
                                        <th>Default</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {addresses.map((address, index) => (
                                        <tr key={address.id}>
                                            <td>{index + 1}</td>
                                            <td>{address.shipping_full_name}</td>
                                            <td>
                                                {address.shipping_address_line1}
                                                {address.shipping_address_line2 && `, ${address.shipping_address_line2}`}
                                            </td>
                                            <td>{address.shipping_city}</td>
                                            <td>{address.shipping_state}</td>
                                            <td>{address.shipping_pincode}</td>
                                            <td>
                                                {address.default_address_flag ? (
                                                    <span className="badge bg-success">Default</span>
                                                ) : (
                                                    <span className="badge bg-secondary">No</span>
                                                )}
                                            </td>
                                            <td>
                                                <Link as="button" href={'/shippingaddress/edit/' + address.shipping_address_id} className="btn btn-sm btn-warning me-2">
                                                    Edit
                                                </Link>
                                                <Link
                                                    as="button"
                                                    href={'/shippingaddress/delete/' + address.shipping_address_id}
                                                    method="post"
                                                    className="btn btn-sm btn-danger"
                                                    onClick={(e) => {
                                                        return confirm("Are you sure you want to delete this address?")    
                                                    }}
                                                >
                                                    Delete
                                                </Link>


                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        ) : (
                            <p className="text-center">No shipping addresses added yet.</p>
                        )}
                    </div>
                </div>
            </div>
        </HomeLayout>
    );
}
