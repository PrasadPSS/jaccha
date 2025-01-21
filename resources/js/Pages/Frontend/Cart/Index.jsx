


import { Head, Link, router, usePage } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { useState } from 'react';
import axios from 'axios';
import { asset } from '@/Helpers/asset';
import HomeLayout from '@/Layouts/HomeLayout';
import { toast } from 'react-toastify';
import { useEffect } from 'react';
import InputError from '@/Components/InputError';


export default function ProductSearch({ auth, cart, cart_amount, isProfileCompleted, districts }) {
    let token = usePage().props.auth.csrf_token;
    const diststates = districts.filter((value, index, self) =>
        index === self.findIndex((t) => (
            t.state_name === value.state_name
        )));
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
    const [selectedState, setSelectedState] = useState("");
    const [states, setStates] = useState(diststates);
    const [liDistrict, setLiDistrict] = useState([]);
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
    useEffect(() => setLiDistrict(districts.filter((district) => district.state_name == selectedState)), [selectedState]);

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


    let cart_items = [];
    if (cart) {
        cart.forEach(element => {
            cart_items.push({ id: element.product_id, weight: element.products.product_weight, swt: element.sweetness_level, addons: element.ingredient_addons, excl: element.ingredient_exclusions, name: element.product_variant != null ? element.product_variant.product_title : element.products.product_title, description: element.products.product_sub_title, price: element.product_variant != null ? element.product_variant.product_price : element.products.product_price, quantity: element.qty, image: element.products.product_thumb });
        });
    }
    const [cartAmount, setCartAmount] = useState(cart_amount);
    const [cartItems, setCartItems] = useState(cart_items);

    // Calculate total price
    useEffect(() => {
        let total = cartItems.reduce((total, item) => total + item.price * item.quantity, 0);

        setCartAmount(total);
    }, [cartItems]);

    // Increase item quantity
    const increaseQuantity = async (id) => {


        await fetch('/api/cart/increase', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
            },
            body: JSON.stringify({ item_id: id }),
        }).then(response => response.json())
            .then(data => {
                setCartItems(cartItems.map(item => item.id === id ? { ...item, quantity: Number(item.quantity) + 1 } : item));

            })
            .catch(error => console.error(error));
    };

    // Decrease item quantity
    const decreaseQuantity = async (id) => {
        setCartItems(cartItems.map(item =>
            item.id === id && item.quantity > 1 ? { ...item, quantity: item.quantity - 1 } : item
        ));
        try {
            const response = await axios.post(`/api/cart/decrease`, { item_id: id });
            setCartItems(cartItems.map(item =>
                item.id === id ? { ...item, quantity: response.data.updated_quantity } : item
            ));

        } catch (error) {
            console.error("Error decreasing quantity:", error);
        }
    };

    // Remove item from cart
    const removeItem = async (id) => {
        setCartItems(cartItems.filter(item => item.id !== id));
        try {
            await axios.post(`/api/cart/remove`, { item_id: id });
            setCartItems(cartItems.filter(item => item.id !== id));
        } catch (error) {
            console.error("Error removing item:", error);
        }

        toast.success('Product Removed Successfully', { autoClose: 5000 });
    };

    const handleCheckout = async () => {
        router.get('/checkout/payment', {
            onSuccess: () => alert('Order Placed Successfully'),
            onError: (errors) => console.error(errors),
        });
    }

    return (
        <HomeLayout auth={auth}
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard
                </h2>
            }
        >
            <Head title="Cart" />

            {cartItems.length == 0 &&
                <div className="sub-banner bg-light pb-0">
                    <div className="container">
                        <div className="row">
                            <div className="col-sm-12">
                                <div className="banner_heading pb-4">
                                    <h2>My Basket</h2>
                                    <p>0 Items</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="empty-cart-content">
                        <img
                            src="/assets/images/empty-wishlist.png"
                            alt="Empty Cart"
                            className="img-fluid mb-4"
                            style={{ maxWidth: "200px" }}
                        />
                        <h1>Oops! Fill Your Basket with Care! 👩‍👧💛</h1>
                        <p className="mt-2">Your shopping basket is empty. Start adding items to it!</p>
                        <Link as='button' href='/products' className="button mt-4">Explore Our Products</Link>
                    </div>
                </div>
            }
            {cartItems.length > 0 && (<>
                <div className="sub-banner bg-light pb-0">
                    <div className="container">
                        <div className="row">
                            <div className="col-sm-12">
                                <div className="banner_heading pb-4">
                                    <h2>My Basket</h2>
                                    <p>{auth.cart_count} Items</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <section className="checkout bg-light cart">
                    <div className="container">
                        <div className="row">
                            <div className="col-sm-12">
                                <div className="checkout-right">
                                    {cartItems.length > 0 ? (
                                        cartItems.map(item => (

                                            <div key={item.id} className="checkout-product mb-5">
                                                <div className="cart-product_image">
                                                    <div className="checkout-product_img position-relative">
                                                        <img
                                                            src={'/backend-assets/uploads/product_thumbs/' + item.image}
                                                            alt=""
                                                        />

                                                    </div>
                                                    <div className="cart-product_content">
                                                        <div className="checkout-product_content">
                                                            <h5>{item.name}</h5>
                                                            <p>

                                                                {/* <button
                                                        type="button"
                                                        className="btn edit-cart_btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#addBasketModal"
                                                    >
                                                        Edit
                                                    </button> */}
                                                            </p>
                                                        </div>
                                                        <div className="checkout-product_price">
                                                            <p>₹{item.price}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div className="add-to-card-btn">
                                                    <button
                                                        type="button"
                                                        onClick={() => increaseQuantity(item.id)}
                                                        className="btn plus_button plus"
                                                        id="plus-btn1"
                                                    >
                                                        +
                                                    </button>
                                                    <div className="number">
                                                        <button
                                                            type="button"
                                                            className="btn black"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#addBasketModal"
                                                        >
                                                            <span id="count1">{item.quantity}</span>
                                                        </button>
                                                    </div>
                                                    <button
                                                        onClick={() => decreaseQuantity(item.id)}
                                                        type="button"
                                                        className="btn minus_button"
                                                        id="minus-btn1"
                                                    >
                                                        -
                                                    </button>
                                                </div>
                                                <a href="#" onClick={() => removeItem(item.id)}>
                                                    <p className="cart_remove">
                                                        <i className="far fa-trash-alt"></i>Remove
                                                    </p>
                                                </a>
                                            </div>
                                        ))) : 'Cart is Empty'}


                                    {/* <div className="discount-code">
                                    <input
                                        type="text"
                                        className="form-control"
                                        placeholder="Discount Code"
                                    />
                                    <button className="discount-button" type="button">Apply</button>
                                </div> */}
                                    <div className="payment-history mt-5">
                                        <div className="payment-display mb-2">
                                            <p>Subtotal . {auth.cart_count} Items</p>
                                            <p>₹{cartAmount}</p>
                                        </div>
                                        {/* <div className="payment-display mb-3">
                                        <p>Shipping</p>
                                        <p>₹0.00</p>
                                    </div> */}
                                        <div className="payment-display">
                                            <p><b>Total</b></p>
                                            <p><b>₹{cartAmount}</b></p>
                                        </div>
                                    </div>
                                    {isProfileCompleted &&
                                        <div className="pay-now-button">
                                            <button onClick={() => handleCheckout()}>Checkout</button>
                                        </div>}
                                    {!isProfileCompleted &&
                                        <div className='pay-now-button'>
                                            <button
                                                type="button"
                                                className=" "
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"

                                            >
                                                <i className="fas fa-plus-circle"></i> Add New Address
                                            </button>

                                        </div>
                                    }


                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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
                                                type="number"
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
                                                <option value="Home">Home</option>
                                                <option value="Work">Work</option>
                                                <option value="Other">Other</option>
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
                </div></>)
            }
        </HomeLayout>
    );

}
