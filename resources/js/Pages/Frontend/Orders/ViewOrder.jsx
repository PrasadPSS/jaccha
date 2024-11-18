import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, router } from '@inertiajs/react';
import React from 'react';

export default function ViewOrder({ orders }) {
    console.log(orders);

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
                            <div className="min-h-screen bg-gray-100 py-8">
                                <div className="container mx-auto px-4">
                                    <h1 className="text-2xl font-semibold text-gray-800 mb-6">My Orders</h1>
                                    <div className="p-6 bg-gray-100 min-h-screen">
                                        <Head title="View Orders" />
                                        <h1 className="text-2xl font-bold mb-6 text-gray-800">Orders</h1>

                                        {orders.length > 0 ? (
                                            <div className="space-y-6">
                                                {orders.map((order) => (
                                                    <div key={order.id} className="bg-white shadow-md rounded-lg p-4">
                                                        {/* Order Details */}
                                                        <div className="border-b pb-4 mb-4">
                                                            <h2 className="text-lg font-semibold text-gray-800">Order #{order.id}</h2>
                                                            <p className="text-sm text-gray-600">User ID: {order.user_id}</p>
                                                            <p className="text-sm text-gray-600">Total: ${order.total.toFixed(2)}</p>
                                                        </div>

                                                        {/* Order Items */}
                                                        <div className="mb-4">
                                                            <h3 className="text-md font-bold text-gray-800 mb-2">Items</h3>
                                                            {order.order_items.length > 0 ? (
                                                                <div className="space-y-2">
                                                                    {order.order_items.map((item) => (
                                                                        <div key={item.id} className="flex justify-between items-center">
                                                                            <span className="text-gray-700">{item.product.name}</span>
                                                                            <span className="text-gray-700">Qty: {item.quantity}</span>
                                                                        </div>
                                                                    ))}
                                                                </div>
                                                            ) : (
                                                                <p className="text-gray-500">No items found for this order.</p>
                                                            )}
                                                        </div>

                                                        {/* Payment Details */}
                                                        <div>
                                                            <h3 className="text-md font-bold text-gray-800 mb-2">Payment Details</h3>
                                                            {order.payment_details.status == 1 ? (
                                                                <div className="space-y-2">
                                                                    <p className="text-gray-700">
                                                                        Amount: ${order.payment_details.amount.toFixed(2)}
                                                                    </p>
                                                                    <p
                                                                        className={`text-sm font-semibold ${order.payment_details.status == 1
                                                                                ? 'text-green-600'
                                                                                : 'text-red-600'
                                                                            }`}
                                                                    >
                                                                        Status: Completed
                                                                    </p>
                                                                </div>
                                                            ) : (
                                                                <p className="text-gray-500">Incomplete.</p>
                                                            )}
                                                        </div>
                                                    </div>
                                                ))}
                                            </div>
                                        ) : (
                                            <p className="text-gray-500 text-center">No orders found.</p>
                                        )}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};


