import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Link, useForm, usePage } from '@inertiajs/react';
import { Transition } from '@headlessui/react';
import UserMenu from '@/Layouts/UserMenu';

export default function UpdateProfileInformation({ shipping_addresses, mustVerifyEmail, status, className = '', }) {
    const user = usePage().props.auth.user;
    const auth = usePage().props.auth;

    const { data, setData, patch, errors, processing, recentlySuccessful } = useForm({
        name: user.name,
        email: user.email,
        mobile_no: user.mobile_no,
    });

    const submit = (e) => {
        e.preventDefault();

        patch(route('profile.update'));
    };

    return (
        <UserMenu auth={auth} activeTab={'profile'}>
            <div
                className="tab-pane fade show active"
                id="pills-second"
                role="tabpanel"
                aria-labelledby="pills-second-tab"
            >
                <div className="account-right-content">
                    <div className="details-heading px-4 py-3 d-flex align-items-center">
                        <h3>Personal Details</h3>
                        <button
                            type="button"
                            className="btn update-details-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#updatePersonal"
                        >
                            <i className="fas fa-pencil"></i> Edit
                        </button>
                    </div>
                    <div className="contact_details p-4">
                        <p>Name: {auth.user.name}</p>
                        <p>Mail: {auth.user.email}</p>
                        <p>Phone: +91 {auth.user.mobile_no}</p>
                    </div>
                </div>
                <div className="account-right-content mt-4">
                    <div
                        className="details-heading px-4 py-3 d-flex align-items-center"
                    >
                        <h3>Address Details</h3>
                        <button
                            type="button"
                            className="btn add-new-address-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModal"
                        >
                            <i className="fas fa-plus-circle"></i> Add New Address
                        </button>
                    </div>
                    <div className="d-flex g-4">
                        {shipping_addresses.map((shipping) =>
                            <div className="contact_details p-4">
                                <p>Name: {shipping.shipping_full_name}</p>
                                <p>Mail: {shipping.shipping_email}</p>
                                <p>Phone: +91 {shipping.shipping_mobile_no}</p>
                                <button
                                    type="button"
                                    className="btn edit-address-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editAddress"
                                > Edit
                                </button>
                                <button
                                    type="button"
                                    className="btn remove-address-btn"
                                > Remove
                                </button>
                            </div>
                            )
                        }

                    </div>
                </div>
            </div>

            <div
                className="modal fade"
                id="updatePersonal"
                tabindex="-1"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <div className="modal-dialog add-address-form">
                    <div className="modal-content bg-light py-2">
                        <div className="modal-header">
                            <h5 className="modal-title text-center m-auto" id="exampleModalLabel">
                                Update Personal Details
                            </h5>
                            <button
                                type="button"
                                className="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            >
                                <i className="far fa-times"></i>
                            </button>
                        </div>
                        <div className="modal-body">
                            <div className="row">
                                <div className="col-sm-12">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Full Name"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-12">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="E-mail Address"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-12">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="number"
                                            className="form-control"
                                            placeholder="Contact Number"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="modal-footer m-auto border-0">
                            <button type="button" className="btn button black">Update Details</button>
                            <button
                                type="button"
                                className="button cancel_btn black"
                                data-bs-dismiss="modal"
                            >
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div
                className="modal address-modal fade"
                id="editAddress"
                tabindex="-1"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <div className="modal-dialog add-address-form">
                    <div className="modal-content bg-light py-2">
                        <div className="modal-header">
                            <h5 className="modal-title text-center m-auto" id="exampleModalLabel">
                                Update Address
                            </h5>
                            <button
                                type="button"
                                className="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            >
                                <i className="far fa-times"></i>
                            </button>
                        </div>
                        <div className="modal-body">
                            <div className="row">
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Full Name"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="number"
                                            className="form-control"
                                            placeholder="Contact Number"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Address Line 1"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Address Line 2"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Landmark"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="City"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Pincode"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <select className="form-control" id="exampleAddress">
                                            <option value="">Select District</option>
                                            <option value="district1">District 1</option>
                                            <option value="district2">District 2</option>
                                            <option value="district3">District 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <select className="form-control" id="exampleAddress">
                                            <option value="">Select State</option>
                                            <option value="district1">State 1</option>
                                            <option value="district2">State 2</option>
                                            <option value="district3">State 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="E-mail Address"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <select className="form-control" id="exampleAddress">
                                            <option value="">Select Address Type</option>
                                            <option value="district1">Home</option>
                                            <option value="district2">Work</option>
                                            <option value="district3">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <label for="defaultAddress">
                                            <input type="checkbox" id="defaultAddress" checked /> Set as Default Address
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="modal-footer m-auto border-0">
                            <button type="button" className="btn button black">Update Address</button>
                            <button
                                type="button"
                                className="button cancel_btn black"
                                data-bs-dismiss="modal"
                            >
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div
                className="modal fade address-modal"
                id="exampleModal"
                tabindex="-1"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <div className="modal-dialog add-address-form">
                    <div className="modal-content bg-light py-2">
                        <div className="modal-header">
                            <h5 className="modal-title text-center m-auto" id="exampleModalLabel">
                                Add Shipping Address
                            </h5>
                            <button
                                type="button"
                                className="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            >
                                <i className="far fa-times"></i>
                            </button>
                        </div>
                        <div className="modal-body">
                            <div className="row">
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Full Name"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="number"
                                            className="form-control"
                                            placeholder="Contact Number"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Address Line 1"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Address Line 2"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Landmark"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="City"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Pincode"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <select className="form-control" id="exampleAddress">
                                            <option value="">Select District</option>
                                            <option value="district1">District 1</option>
                                            <option value="district2">District 2</option>
                                            <option value="district3">District 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <select className="form-control" id="exampleAddress">
                                            <option value="">Select State</option>
                                            <option value="district1">State 1</option>
                                            <option value="district2">State 2</option>
                                            <option value="district3">State 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="E-mail Address"
                                            id="exampleAddress"
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <select className="form-control" id="exampleAddress">
                                            <option value="">Select Address Type</option>
                                            <option value="district1">Home</option>
                                            <option value="district2">Work</option>
                                            <option value="district3">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <label for="defaultAddress">
                                            <input type="checkbox" id="defaultAddress" checked /> Set as Default Address
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="modal-footer m-auto border-0">
                            <button type="button" className="btn button black">Add Address</button>
                            <button
                                type="button"
                                className="button cancel_btn black"
                                data-bs-dismiss="modal"
                            >
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </UserMenu>

    );
}


