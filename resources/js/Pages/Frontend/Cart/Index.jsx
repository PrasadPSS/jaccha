import { Head, Link, router } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { useState } from 'react';
import axios from 'axios';
import { asset } from '@/Helpers/asset';

export default function ProductSearch({ cart }) {
    console.log(cart);
    let cart_items = [];
    if (cart) {
    cart.forEach(element => {
        cart_items.push({id: element.product_id, name: element.products.product_name , description: element.products.product_desc, price: element.products.product_price, quantity: 1});
    });
}
    const [cartItems, setCartItems] = useState(cart_items);

    // Calculate total price
    const calculateTotal = () => {
        return cartItems.reduce((total, item) => total + item.price * item.quantity, 0);
    };

    // Increase item quantity
    const increaseQuantity = async (id) => {
        console.log(id);
        setCartItems(cartItems.map(item => item.id === id ? { ...item, quantity: item.quantity + 1 } : item));
        await fetch('/api/cart/increase', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ item_id: id }),
        }).then(response => response.json())
        .then(data => console.log(data))
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
    };

    const handleCheckout  = async () => 
    {
        router.post('/checkout/payment', {
            onSuccess: () => alert('Order Placed Successfully'),
            onError: (errors) => console.error(errors),
        });
    }

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />
    
            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <div className="container mx-auto p-6">
                                <h1 className="text-2xl font-bold mb-4">Shopping Cart</h1>
                                <div className="bg-white shadow-md rounded-lg p-4">
                                    {cartItems.length > 0 ? (
                                        cartItems.map(item => (
                                            <div key={item.id} className="flex items-center justify-between border-b py-4">
                                                <div className='w-[100px] truncate ...'>
                                                    <h2 className="text-lg font-medium">{item.name}</h2>
                                                    <p className="text-gray-600 text-sm">{item.description}</p>
                                                    <p className="text-gray-800 font-semibold">Price: ${item.price}</p>
                                                </div>
                                                <div className="flex items-center">
                                                    <button
                                                        onClick={() => decreaseQuantity(item.id)}
                                                        className="px-3 py-1 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                                                    >
                                                        -
                                                    </button>
                                                    <span className="mx-3">{item.quantity}</span>
                                                    <button
                                                        onClick={() => increaseQuantity(item.id)}
                                                        className="px-3 py-1 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                                                    >
                                                        +
                                                    </button>
                                                </div>
                                                <button
                                                    onClick={() => removeItem(item.id)}
                                                    className="text-red-500 hover:text-red-600"
                                                >
                                                    Delete
                                                </button>
                                            </div>
                                        ))
                                    ) : (
                                        <p className="text-gray-600 text-center py-4">
                                            Your cart is currently empty.
                                        </p>
                                    )}
                                </div>
                                {cartItems.length > 0 && (
                                    <>
                                        <div className="mt-4 text-right">
                                            <h2 className="text-xl font-bold">Total: ${calculateTotal()}</h2>
                                        </div>
                                        <div className="mt-4 text-right">
                                            <button onClick={() => handleCheckout()} className='text-gray-900 hover:text-gray-950 border border-black p-1 rounded hover:bg-gray-900 hover:text-white'>Checkout</button>
                                        </div>
                                    </>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
    
}
