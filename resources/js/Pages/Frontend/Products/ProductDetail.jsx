import HomeLayout from '@/Layouts/HomeLayout';
import { Link, router, usePage } from '@inertiajs/react';
import axios from 'axios';
import React, { useState } from 'react';
import RatingAndReviews from './RatingAndReviews';


const ProductDetail = ({ auth, product, product_reviews }) => {
    
    console.log('sadas', product_reviews);
    const { slug } = new URLSearchParams(); // Get the slug from the URL
    const { errors } = usePage().props;
    // Ensure `product` is passed as a prop, or fetch it if needed
    if (!product) {
        return (
            <Container classNameName="mt-5">
                <p>Loading product details...</p>
            </Container>
        );
    }

    function canReview(productId){
        // Check if the given productId exists in any order's products
        const hasPurchased = auth.orders.some((order) =>
            order.orderproducts.some((product) => product.product_id === productId)
        );

        return hasPurchased;

    }

    const [values, setValues] = useState({
        pincode: '',
    })

    function handleChange(e) {
        const key = e.target.id;
        const value = e.target.value
        setValues(values => ({
            ...values,
            [key]: value,
        }))
    }

    const [courierData, setCourierData] = useState({ courier: null, fastest_etd: "" });
    const [error, setError] = useState("");

    function handleSubmit(e) {
        e.preventDefault();
        axios
          .post("/product/pincode/check", values)
          .then((response) => {
            setCourierData({courier: JSON.parse((response['data']))['data']['available_courier_companies'][0]['courier_name'], fastest_etd: JSON.parse((response['data']))['data']['available_courier_companies'][0]['estimated_delivery_days']});
          })
          .catch((err) => {
            setCourierData({courier: '', fastest_etd: ''});
          });
        }

    return (
        <HomeLayout auth={auth}>
            <div className="container mt-5">
                <div className="row align-items-center">
                    {/* Product Image Section */}
                    <div className="col-md-6">
                        <div className="card shadow-sm">
                            <img
                                className="card-img-top rounded"
                                src={'/backend-assets/uploads/product_thumbs/' + product.product_thumb}
                                alt="Channa Laddu"
                                style={{ objectFit: "cover", maxHeight: "400px" }}
                            />
                        </div>
                    </div>

                    {/* Product Details Section */}
                    <div className="col-md-6">
                        <h1 className="fw-bold text-dark">{product.product_title}</h1>
                        <p className="text-muted"><i>{product.product_sub_title}</i></p>
                        <h4 className="text-primary fw-bold">₹{product.product_discounted_price}</h4>
                        <p className="text-muted text-decoration-line-through">₹{product.product_price}</p>
                        <p>
                            <strong>Category:</strong> <span className="text-capitalize">Food</span>
                        </p>
                        <p>
                            <strong>Available Quantity:</strong> <span className="text-success fw-bold">100</span>
                        </p>
                        <p>
                            <strong>Delivery Estimate:</strong> <span className="text-info">7 days</span>
                        </p>
                        <div className="d-flex gap-3 mt-4">
                            <input type="hidden" name='_token' value={document.querySelector('meta[name="csrf-token"]').getAttribute('content')} />
                            <input type="hidden" name='product_id' value={product.id} />
                            <input type="hidden" name='quantity' value={1} />
                            <input type="hidden" name='product_type' value='simple' />
                            <input type="hidden" name='product_price' value={product.price} />
                            <Link href='/product/addtocart' method="post" data={{ product_id: product.product_id, quantity: 1, product_type: product.product_type, product_price: product.product_price }} className="btn btn-success px-4 py-2 shadow-sm">Add to Cart</Link>
                            <Link method="post" href={route('wishlist.add')} as='button' type='button' data={{ product_id: product.product_id }} className="btn btn-outline-primary px-4 py-2 shadow-sm">Add to Wishlist</Link>
                        </div>
                        <div className='mt-4'>
                            <form onSubmit={handleSubmit} className="p-4 border rounded shadow-sm bg-light">
                                <input type="hidden" name='_token' value={document.querySelector('meta[name="csrf-token"]').getAttribute('content')} />
                                <div className="mb-3">
                                    <label htmlFor="pincode" className="form-label">
                                        Enter Delivery Pincode:
                                    </label>
                                    <input
                                        type="number"
                                        id="pincode"
                                        value={values.pincode}
                                        onChange={handleChange}
                                        className="form-control"
                                        placeholder="Enter pincode"
                                    />
                                    {errors.pincode && <div className='mt-1 text-danger'>{ errors.pincode }</div>}
                                </div>
                                <button type="submit" className="btn btn-primary">
                                    Submit
                                </button><br/>
                                {courierData.courier != '' && courierData.courier != null && <div className='text-success mt-2'>Product can be delivered in {courierData.fastest_etd} days</div>}
                                {courierData.courier == '' && <div className=' my-2 text-danger'>Product cant be delivered to this location. Please change your pincode</div>}
                            </form>

                        </div>

                    </div>
                </div>

                {/* Product Specifications */}
                <div className="row mt-5">
                    <div className="col">
                        <h3 className="text-dark fw-bold">Product Specifications</h3>
                        <div
                            className="bg-light p-3 rounded shadow-sm"
                            style={{ lineHeight: "1.8", fontSize: "1rem" }}
                        >
                            <p>laddu</p>
                        </div>
                    </div>
                </div>

                {/* Disclaimer Section */}
                <div className="row mt-4">
                    <div className="col">
                        <h3 className="text-dark fw-bold">Disclaimer</h3>
                        <div
                            className="bg-warning-subtle p-3 rounded shadow-sm"
                            style={{ lineHeight: "1.8", fontSize: "0.95rem" }}
                            dangerouslySetInnerHTML={{
                                __html: product.product_disclaimer
                            }}
                        >
                        </div>
                    </div>
                </div>
                <RatingAndReviews productReviews={product_reviews} reviews={auth.reviews} productId={product.product_id} canReview={canReview(product.product_id)}
                />
            </div>
        </HomeLayout>
    );
};

export default ProductDetail;
