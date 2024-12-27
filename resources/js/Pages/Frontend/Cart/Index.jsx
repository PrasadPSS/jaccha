


import { Head, Link, router } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { useState } from 'react';
import axios from 'axios';
import { asset } from '@/Helpers/asset';
import HomeLayout from '@/Layouts/HomeLayout';
import { toast } from 'react-toastify';

export default function ProductSearch({ auth, cart, cart_amount }) {

    let cart_items = [];
    if (cart) {
        cart.forEach(element => {
            cart_items.push({ id: element.product_id, weight: element.products.product_weight,swt: element.sweetness_level, addons: element.ingredient_addons, excl: element.ingredient_exclusions, name: element.product_variant != null ? element.product_variant.product_title : element.products.product_title, description: element.products.product_sub_title, price: element.product_variant != null ? element.product_variant.product_price : element.products.product_price, quantity: element.qty });
        });
    }

    const [cartItems, setCartItems] = useState(cart_items);

    // Calculate total price
    const calculateTotal = () => {
        return cartItems.reduce((total, item) => total + item.price * item.quantity, 0);
    };

    // Increase item quantity
    const increaseQuantity = async (id) => {


        await fetch('/api/cart/increase', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
                                                {/* <div className="checkout-product_img position-relative">
                                                    <img
                                                        src="/assets/images/product-details/products-details-3.jpg"
                                                        alt=""
                                                    />
                                                    <p>3</p>
                                                </div> */}
                                                <div className="cart-product_content">
                                                    <div className="checkout-product_content">
                                                        <h5>{item.name}</h5>
                                                        <p>
                                                        {item.weight}gm | {item.swt ?? "low"} Sweetness | {item.addons ?? 'NA'} | No {item.excl ?? 'NA'}
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
                                    ))): 'Cart is Empty'}


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
                                        <p>₹{cart_amount}</p>
                                    </div>
                                    <div className="payment-display mb-3">
                                        <p>Shipping</p>
                                        <p>₹0.00</p>
                                    </div>
                                    <div className="payment-display">
                                        <p><b>Total</b></p>
                                        <p><b>₹{cart_amount}</b></p>
                                    </div>
                                </div>
                                <div className="pay-now-button">
                                     <button onClick={() => handleCheckout()}>Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </HomeLayout>
    );

}
