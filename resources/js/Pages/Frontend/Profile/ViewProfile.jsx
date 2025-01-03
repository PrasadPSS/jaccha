import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Link, router, useForm, usePage } from '@inertiajs/react';
import { Transition } from '@headlessui/react';
import UserMenu from '@/Layouts/UserMenu';
import { useEffect, useState } from 'react';
import axios from 'axios';

export default function UpdateProfileInformation({ shipping_addresses, mustVerifyEmail, status, className = '', districts }) {

    const diststates = districts.filter((value, index, self) =>
        index === self.findIndex((t) => (
            t.state_name === value.state_name
        )));

    const user = usePage().props.auth.user;
    const auth = usePage().props.auth;
    const error = usePage().props.flash.error;

    const [selectedState, setSelectedState] = useState("");

    const [states, setStates] = useState(diststates);
    const [selDistrict, setSelectedDistrict] = useState("");
    const [liDistrict, setLiDistrict] = useState([])


    useEffect(() => setLiDistrict(districts.filter((district) => district.state_name == selectedState)), [selectedState])

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
    const [validationErrors, setValidationErrors] = useState('');
    const [defaultAddFlg, setDefaultAdd] = useState(false);
    const handleInputChange = (e) => {
        const { name, value, type, checked } = e.target;
        setFormData({
            ...formData,
            [name]: type === "checkbox" ? checked : value,
        });
        if (name == 'shipping_state') {
            setSelectedState(value);

        }
        if (name == 'shipping_district') {
            setSelectedDistrict(value)

        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        // Submit form data to the route `address.store`
        router.post(route("address.store"), formData, {
            onSuccess: () => {
                console.log("Address submitted successfully");
                $('#exampleModal').modal('hide');
            },
            onError: (errors) => {
                setValidationErrors(errors);
                return false;
            },
        });
    };
    const [editDistricts, setEditDistricts] = useState([]);
    let shipping_address = '';
    const handleEditAddress = (shipping_address_id) => {
        axios.get('/shippingaddress/edit/' + shipping_address_id)
            .then(function (response) {
                shipping_address = response.data.shipping_address;
                setFormData2({
                    shipping_address_id: shipping_address.shipping_address_id || "",
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
                })
                setEditDistricts(districts.filter((district) => district.state_name == shipping_address.shipping_state))
                setDefaultAdd(shipping_address.default_address_flag);
            })
            .catch(function (error) {
                console.log(error);
            })
    }

    const [formData2, setFormData2] = useState({
        shipping_address_id: shipping_address.shipping_address_id || "",
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

    const handleChange2 = (e) => {
        const { name, value } = e.target;
        console.log(name, value);
        setFormData2({ ...formData2, [name]: value });


        if (name == 'default_address_flag') {
            setDefaultAdd(e.target.checked);
            setFormData2({ ...formData2, [name]: e.target.checked });
        }


    };

    const handleSubmit2 = (e) => {
        e.preventDefault();

        // Send data to backend route `address.update`
        router.post(
            route("address.update"), // Assuming you pass the `id` of the address
            formData2,
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

    const { data, setData, patch, errors, processing, recentlySuccessful } = useForm({
        name: user.name,
        email: user.email,
        mobile_no: user.mobile_no,
    });

    useEffect(() => console.log('selected disctrict', selDistrict), [selDistrict]);
    function handleChange(e) {
        const key = e.target.name;
        const value = e.target.value
        setData(key, value);
    }

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
                    <div className="row">
                        {shipping_addresses.map((shipping) =>
                            <div className="col-sm-6">
                                <div className="contact_details p-4">
                                    <p>Name: {shipping.shipping_full_name}</p>
                                    <p>Mail: {shipping.shipping_email}</p>
                                    <p>Phone: +91 {shipping.shipping_mobile_no}</p>
                                    <button
                                        type="button"
                                        className="btn edit-address-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editAddress"
                                        onClick={() => handleEditAddress(shipping.shipping_address_id)}
                                    > Edit
                                    </button>

                                    <Link
                                        as="button"
                                        href={'/shippingaddress/delete/' + shipping.shipping_address_id}
                                        method="post"
                                        className="btn remove-address-btn"
                                        onClick={(e) => {
                                            return confirm("Are you sure you want to delete this address?")
                                        }}
                                    >
                                        Remove
                                    </Link>
                                </div>
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
                    <form onSubmit={submit} className="modal-content bg-light py-2">
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
                            <div className="row" onSubmit={submit}>
                                <div className="col-sm-12">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            name='name'
                                            onChange={handleChange}
                                            placeholder="Full Name"
                                            value={data.name}
                                            id="exampleAddress"
                                        />
                                        <InputError className="mt-2" message={errors.name} />
                                    </div>
                                </div>
                                <div className="col-sm-12">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            name='email'
                                            onChange={handleChange}
                                            placeholder="E-mail Address"
                                            value={data.email}
                                            id="exampleAddress"
                                        />
                                        <InputError className="mt-2" message={errors.email} />
                                    </div>
                                </div>
                                <div className="col-sm-12">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="number"
                                            className="form-control"
                                            name='mobile_no'
                                            onChange={handleChange}
                                            placeholder="Contact Number"
                                            id="exampleAddress"
                                            value={data.mobile_no}
                                        />
                                        <InputError className="mt-2" message={errors.mobile_no} />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="modal-footer m-auto border-0">
                            <button type="submit" className="btn button black" data-bs-dismiss="modal">Update Details</button>
                            <button
                                type="button"
                                className="button cancel_btn black"
                                data-bs-dismiss="modal"
                            >
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            <div
                className="modal address-modal fade"
                id="editAddress"
                tabindex="-1"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <form className="modal-dialog add-address-form" onSubmit={handleSubmit2} >
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
                                            id="shipping_full_name"
                                            name="shipping_full_name"
                                            value={formData2.shipping_full_name}
                                            onChange={handleChange2}
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="number"
                                            className="form-control"
                                            placeholder="Contact Number"
                                            id="shipping_mobile_no"
                                            name="shipping_mobile_no"
                                            value={formData2.shipping_mobile_no}
                                            onChange={handleChange2}
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Address Line 1"
                                            id="shipping_address_line1"
                                            name="shipping_address_line1"
                                            value={formData2.shipping_address_line1}
                                            onChange={handleChange2}
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Address Line 2"
                                            id="shipping_address_line2"
                                            name="shipping_address_line2"
                                            value={formData2.shipping_address_line2}
                                            onChange={handleChange2}
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Landmark"
                                            id="shipping_landmark"
                                            name="shipping_landmark"
                                            value={formData2.shipping_landmark}
                                            onChange={handleChange2}
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="City"
                                            id="shipping_city"
                                            name="shipping_city"
                                            value={formData2.shipping_city}
                                            onChange={handleChange2}
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Pincode"
                                            id="shipping_pincode"
                                            name="shipping_pincode"
                                            value={formData2.shipping_pincode}
                                            onChange={handleChange2}
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <select className="form-control" id="shipping_district"
                                            name="shipping_district"
                                            value={formData2.shipping_district}
                                            onChange={handleChange2}>

                                            {editDistricts.map((district) => <option value={district.name}>{district.name}</option>)}
                                        </select>
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <select className="form-control" id="shipping_state"
                                            name="shipping_state"
                                            value={formData2.shipping_state}
                                            onChange={handleChange2}>

                                            {states.map((state) => <option value={state.state_name}>{state.state_name}</option>)}
                                        </select>
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="E-mail Address"
                                            id="shipping_email"
                                            name="shipping_email"
                                            value={formData2.shipping_email}
                                            onChange={handleChange2}
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <select className="form-control" id="shipping_address_type"
                                            name="shipping_address_type"
                                            value={formData2.shipping_address_type}
                                            onChange={handleChange2}>
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
                                            <input type="checkbox" id="default_address_flag"
                                                name="default_address_flag"
                                                onChange={handleChange2} checked={defaultAddFlg} /> Set as Default Address
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="modal-footer m-auto border-0">
                            <button data-bs-dismiss="modal" type="submit" className="btn button black">Update Address</button>
                            <button
                                type="button"
                                className="button cancel_btn black"
                                data-bs-dismiss="modal"
                            >
                                Cancel
                            </button>

                        </div>
                    </div>
                </form>
            </div>


            <div
                className="modal fade address-modal"
                id="exampleModal"
                tabindex="-1"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <form onSubmit={handleSubmit} className="modal-dialog add-address-form">
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
                                            id="shipping_full_name"
                                            name="shipping_full_name"
                                            value={formData.shipping_full_name}
                                            onChange={handleInputChange}

                                        />
                                        <InputError message={validationErrors.shipping_full_name} className="mt-2" />
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="number"
                                            className="form-control"
                                            placeholder="Contact Number"
                                            id="shipping_mobile_no"
                                            name="shipping_mobile_no"
                                            value={formData.shipping_mobile_no}
                                            onChange={handleInputChange}
                                        />
                                        <InputError message={validationErrors.shipping_mobile_no} className="mt-2" />
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Address Line 1"
                                            id="shipping_address_line1"
                                            name="shipping_address_line1"
                                            value={formData.shipping_address_line1}
                                            onChange={handleInputChange}
                                        />
                                        <InputError message={validationErrors.shipping_address_line1} className="mt-2" />
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Address Line 2"
                                            id="shipping_address_line2"
                                            name="shipping_address_line2"
                                            value={formData.shipping_address_line2}
                                            onChange={handleInputChange}
                                        />
                                        <InputError message={validationErrors.shipping_address_line2} className="mt-2" />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Landmark"
                                            id="shipping_landmark"
                                            name="shipping_landmark"
                                            value={formData.shipping_landmark}
                                            onChange={handleInputChange}
                                        />
                                        <InputError message={validationErrors.shipping_landmark} className="mt-2" />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="City"
                                            id="shipping_city"
                                            name="shipping_city"
                                            value={formData.shipping_city}
                                            onChange={handleInputChange}
                                        />
                                        <InputError message={validationErrors.shipping_city} className="mt-2" />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Pincode"
                                            id="shipping_pincode"
                                            name="shipping_pincode"
                                            value={formData.shipping_pincode}
                                            onChange={handleInputChange}
                                        />
                                        <InputError message={validationErrors.shipping_pincode} className="mt-2" />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <select className="form-control" id="shipping_district"
                                            name="shipping_district"
                                            value={formData.shipping_district}
                                            onChange={handleInputChange}>
                                            <option value="" selected disabled>Select District</option>
                                            {liDistrict.map((district) => <option value={district.name}>{district.name}</option>)}
                                        </select>
                                        <InputError message={validationErrors.shipping_district} className="mt-2" />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <select className="form-control" id="shipping_state"
                                            name="shipping_state"
                                            value={selectedState}
                                            onChange={handleInputChange}>
                                            <option value="" selected disabled>Select State</option>
                                            {states.map((state) => <option value={state.state_name}>{state.state_name}</option>)}



                                        </select>
                                        <InputError message={validationErrors.shipping_state} className="mt-2" />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="E-mail Address"
                                            id="shipping_email"
                                            name="shipping_email"
                                            value={formData.shipping_email}
                                            onChange={handleInputChange}
                                        />
                                        <InputError message={validationErrors.shipping_email} className="mt-2" />
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="form-inputs mb-3">
                                        <select className="form-control" id="shipping_address_type"
                                            name="shipping_address_type"
                                            value={formData.shipping_address_type}
                                            onChange={handleInputChange}>
                                            <option value="">Select Address Type</option>
                                            <option value="district1">Home</option>
                                            <option value="district2">Work</option>
                                            <option value="district3">Other</option>
                                        </select>
                                        <InputError message={validationErrors.shipping_address_type} className="mt-2" />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-inputs mb-3">
                                        <label for="defaultAddress">
                                            <input type="checkbox" id="default_address_flag"
                                                name="default_address_flag" value={formData.default_address_flag}
                                                onChange={handleInputChange} /> Set as Default Address
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="modal-footer m-auto border-0">
                            <button type="submit" className="btn button black">Add Address</button>
                            <button
                                type="button"
                                className="button cancel_btn black"
                                data-bs-dismiss="modal"
                            >
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </UserMenu>

    );
}


