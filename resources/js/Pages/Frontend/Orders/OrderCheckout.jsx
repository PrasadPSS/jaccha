import { asset } from "@/Helpers/asset";
import { getCsrfToken } from "@/Helpers/getCsrfToken";
import HomeLayout from "@/Layouts/HomeLayout";
import { Head, Link, router, useForm, usePage } from "@inertiajs/react";
import axios from "axios";
import React, { useState } from "react";
import DiscountCode from "./DiscountCode";
import { useEffect } from "react";


export default function OrderCheckout({ auth, data }) {

    let token =  usePage().props.auth.csrf_token;
    const [formData, setFormData] = useState({
        shipping_full_name: auth.user.name,
        shipping_mobile_no: auth.user.mobile_no,
        shipping_address_line1: "",
        shipping_address_line2: "",
        shipping_landmark: "NA",
        shipping_city: "",
        shipping_pincode: "",
        shipping_district: "Thane",
        shipping_state: "",
        shipping_address_type: "Home",
        shipping_email: auth.user.email,
        default_address_flag: false,
    });

    // Destructure the required data
    const {
        cart,
        user,
        shipping_address,
        shipping_addresses,
        cart_amounts,
        shipping_amount,
        payment_mode,
        order_delivery,
        increment_id,
        shipping_charges,
        grand_total,
        cod_rmk,
        cod_response,
        cod_charges
    } = data;
    const [codCharges, setCodCharges] = useState(cod_charges);
    console.log('rmk',cod_rmk);
    const [shippingAmount, setShippingAmount] = useState(shipping_amount);
    const [codResponse, setCodResponse] = useState(cod_response == 'Y' ? 1 : 0);

    const [shippingAddressId, setShippingAddressId] = useState(shipping_address.shipping_address_id);

    const [paymentMode, setPaymentMode] = useState('');
    let finalGrandTotal;


    // Calculate grand total
    if (paymentMode == 'Cash On Delivery') {
        finalGrandTotal = parseFloat(cart_amounts.cart.cart_discounted_total + shippingAmount + Number(cod_charges)).toFixed(2);
    }
    else {
        finalGrandTotal = parseFloat(cart_amounts.cart.cart_discounted_total + shippingAmount).toFixed(2);
    }

    const totalGst = parseFloat(cart_amounts.total_gst).toFixed(2);
    const savings = parseFloat((cart_amounts.cart.cart_discounted_total - totalGst + cart_amounts.product_discount) - finalGrandTotal).toFixed(2);
    const handleAddressChange = (shipping_address_id) => {
        console.log('cod_response_null');
        axios.get('/orders/calculaterate/' + shipping_address_id)
            .then(res => {
                setShippingAmount(res.data.shipping_amount);
                setCodResponse(res.data.cod_response);
                console.log('cod_response', res);
            })

    }
    const handleInputChange = (e) => {
        const { name, value, type, checked } = e.target;
        setFormData({
            ...formData,
            [name]: type === "checkbox" ? checked : value,
        });
    };

    useEffect(()=>{
        if(paymentMode == 'Cash On Delivery')
        {
            setFinalGrandTotal1(prev => (Number(prev) + Number(codCharges)).toFixed(2));
        }
    }, [paymentMode])


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

    const [finalGrandTotal1, setFinalGrandTotal1] = useState(finalGrandTotal);
    const[couponCode, setCouponCode] = useState('');
    const[couponDiscount, setCouponDiscount] = useState(0);

    return (
        <HomeLayout auth={auth}>
            <Head title="Place Order" />
            <div className="sub-banner bg-light pb-0">
                <div className="container">
                    <div className="row">
                        <div className="col-sm-12">
                            <div className="banner_heading pb-4">
                                <h2>Checkout</h2>
                                <p>{auth.cart_count} Items</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <section className="checkout bg-light">
                <div className="container">
                    <form action="">
                        <div className="row">
                            <div className="col-sm-7">
                                <div className="checkout-form pt-5 d-flex align-items-center">
                                    <h4 className="mb-0">Address Details</h4>
                                    <Link href="/profile/view" type="button" className="btn add-new-address-btn"
                                        >
                                        <i className="fas fa-plus-circle"></i> Add New Address
                                    </Link>
                                    {/* <div className="row">
                                        <div className="col-sm-12">
                                            <div className="form-inputs mb-3">
                                                <input
                                                    type="text"
                                                    className="form-control"
                                                    placeholder="Address"
                                                    id="exampleAddress"
                                                />
                                            </div>
                                        </div>
                                        <div className="col-sm-12">
                                            <div className="form-inputs mb-3">
                                                <input
                                                    type="text"
                                                    className="form-control"
                                                    placeholder="Apartment (Optional)"
                                                    id="exampleAddress"
                                                />
                                            </div>
                                        </div>
                                        <div className="col-sm-6">
                                            <div className="form-inputs mb-3">
                                                <input
                                                    type="text"
                                                    className="form-control"
                                                    placeholder="City"
                                                    id="exampleAddress"
                                                />
                                            </div>
                                        </div>
                                        <div className="col-sm-6">
                                            <div className="form-inputs mb-3">
                                                <input
                                                    type="number"
                                                    className="form-control"
                                                    placeholder="Post Code"
                                                    id="exampleAddress"
                                                />
                                            </div>
                                        </div>
                                        <div className="col-sm-6">
                                            <div className="form-inputs">
                                                <input
                                                    type="text"
                                                    className="form-control"
                                                    placeholder="Country/Region"
                                                    id="exampleAddress"
                                                />
                                            </div>
                                        </div>
                                        <div className="col-sm-6">
                                            <div className="form-inputs">
                                                <input
                                                    type="number"
                                                    className="form-control"
                                                    placeholder="Alternate Contact Number"
                                                    id="exampleAddress"
                                                />
                                            </div>
                                        </div>
                                    </div>  */}
                                </div>
                                <div className="checkout-form mt-4 payment-details">
                                    <h4 className="">Select Address</h4>
                                    <div className="row">
                                        {shipping_addresses.map((address) => (
                                            <div key={address.shipping_address_id} className="col-sm-12">
                                                <div className="form-check payment-radio-btn">
                                                    <input onClick={() => {
                                                        setShippingAddressId(address.shipping_address_id);
                                                        handleAddressChange(address.shipping_address_id);
                                                    }} checked={address.shipping_address_id == shippingAddressId} className="form-check-input" type="radio" name="flexRadioDefault" id={"flexRadioDefault" + 2+address.shipping_address_id} />
                                                    <label className="form-check-label" htmlFor={"flexRadioDefault" + 2+address.shipping_address_id}>
                                                        {`${address.shipping_address_line1}, ${address.shipping_address_line2}, ${address.shipping_city}, ${address.shipping_state}, ${address.shipping_pincode}`}
                                                    </label>
                                                </div>
                                            </div>
                                        )
                                        )}


                                        {/* <div className="col-sm-12">
                                            <div className="form-check payment-radio-btn active">
                                                <input className="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                                    checked />
                                                <label className="form-check-label" htmlFor="flexRadioDefault2">
                                                    Address 2
                                                </label>
                                            </div>
                                        </div> */}
                                    </div>
                                </div>
                                <div className="checkout-form mt-4 payment-details">
                                    <h4 className="">Payment</h4>
                                    <p className="mb-4">All transactions are secure and encrypted.</p>

                                    <div className="row">
                                        {payment_mode.map((mode, index) =>
                                        (
                                            <div className="col-sm-12">
                                                <div className="form-check payment-radio-btn">
                                                    <input className="form-check-input" type="radio" name="paymentRadioDefault"
                                                        id={`paymentMode${mode.payment_mode_id}`}
                                                        disabled={mode.payment_mode_name == "Cash On Delivery" && codResponse == 0}
                                                        onClick={() => setPaymentMode(mode.payment_mode_name)}
                                                        defaultChecked={mode.default_selected === 1} />
                                                    <div className="d-flex payment-btn-img">
                                                        <label className="form-check-label" htmlFor={"flexRadioDefault" + index}>
                                                            {mode.payment_mode_name == 'Cash On Delivery' && codResponse == 0 ? cod_rmk : mode.payment_mode_name}
                                                        </label>
                                                        {mode.payment_mode_name != 'Cash On Delivery' &&
                                                            <div>
                                                                <img src="/assets/images/payment/visa.png" />
                                                                <img src="/assets/images/payment/maestro.png" />
                                                                <img src="/assets/images/payment/mastercard.png" />
                                                                <img src="/assets/images/payment/amex.png" />
                                                                <button type="button">+4</button>
                                                            </div>
                                                        }

                                                    </div>
                                                </div>
                                            </div>
                                        ))}


                                    </div>
                                </div>
                            </div>
                            <div className="col-sm-5">
                                <div className="checkout-right">
                                    {cart.map((item, index) => (
                                        <div className="checkout-product mb-3">
                                            <div className="checkout-product_img position-relative">
                                                <img src={'/backend-assets/uploads/product_thumbs/' + item.products.product_thumb} alt="" />
                                                <p>{item.qty}</p>
                                            </div>
                                            <div className="checkout-product_content">
                                                <h5>{item.products.product_title}</h5>
                                                <p></p>
                                            </div>
                                            <div className="checkout-product_price">
                                                <p>₹{item.product_variant_id ? item.product_variant.product_price : item.products.product_price}.00</p>
                                            </div>
                                        </div>))}

                                    {/* <div className="checkout-product mb-3">
                                        <div className="checkout-product_img position-relative">
                                            <img src="/assets/images/product-details/products-details-3.jpg" alt="" />
                                            <p>3</p>
                                        </div>
                                        <div className="checkout-product_content">
                                            <h5>Dana Methi Laddoo</h5>
                                            <p>1kg | Medium Sweetness | Almonds | No Ghee</p>
                                        </div>
                                        <div className="checkout-product_price">
                                            <p>₹750.00</p>
                                        </div>
                                    </div>
                                    <div className="checkout-product mb-5">
                                        <div className="checkout-product_img position-relative">
                                            <img src="/assets/images/product-details/products-details-3.jpg" alt="" />
                                            <p>3</p>
                                        </div>
                                        <div className="checkout-product_content">
                                            <h5>Dana Methi Laddoo</h5>
                                            <p>1kg | Medium Sweetness | Almonds | No Ghee</p>
                                        </div>
                                        <div className="checkout-product_price">
                                            <p>₹750.00</p>
                                        </div>

                                    </div> */}
                                    
                                    <DiscountCode setCouponCode1={setCouponCode} setCouponDiscount={setCouponDiscount} paymentMode={paymentMode} gstCharges={totalGst} shippingAmount={shippingAmount} codCharges={Number(cod_charges).toFixed(2)} finalGrandTotal={finalGrandTotal1} setFinalGrandTotal={setFinalGrandTotal1}/>
                                    <div className="payment-history mt-5">
                                        
                                        <div className="payment-display mb-2">
                                            <p>Gst Charges</p>
                                            
                                            <p>₹{totalGst}</p>
                                        </div>
                                        <div className="payment-display mb-2">
                                            <p>Subtotal . {auth.cart_count} Items</p>
                                            
                                            <p>₹
                                            {paymentMode == 'Cash On Delivery' ? finalGrandTotal - parseFloat(shippingAmount).toFixed(2) - Number(cod_charges) :  finalGrandTotal - parseFloat(shippingAmount).toFixed(2)}
                                            </p>
                                        </div>
                                        <div className="payment-display mb-3">
                                            <p>Shipping</p>
                                            <p>₹{parseFloat(shippingAmount).toFixed(2)}</p>
                                        </div>
                                        <div className="payment-display mb-3">
                                            <p>COD Charges</p>
                                            <p>₹
                                            {paymentMode == 'Cash On Delivery' ? 
                                            Number(codCharges).toFixed(2) : 0
                                            }
                                            </p>
                                        </div>
                                        {couponDiscount != 0 && 
                                        (<div className="payment-display mb-3">
                                        <p>Coupon Discount</p>
                                        <p>- ₹{couponDiscount}</p>
                                       
                                        </div>)
                                        }
                                        <div className="payment-display">
                                            <p><b>Total</b></p>
                                            <p><b>₹{finalGrandTotal1}</b></p>
                                        </div>
                                    </div>
                                    <form action="/order/place" method="POST">
                                        <input type="hidden" name="_token" value={token} />

                                        {/* Hidden Fields */}
                                        <input type="hidden" name="amount" value={finalGrandTotal1} />
                                        <input type="hidden" name="shipping_amount" value={shippingAmount} />
                                        <input type="hidden" name="txnid" value={increment_id || ""} />
                                        <input type="hidden" name="shipping_charges" value={JSON.stringify(shipping_charges || {})} />
                                        <input type="hidden" name="shipping_id" value={shippingAddressId} />
                                        <input type="hidden" name="paymentmode" value={paymentMode} />
                                        <input type="hidden" name="couponcode" value={couponCode} />
                                        <input type="hidden" name="coupondiscount" value={couponDiscount} />
                                        <div className="pay-now-button">
                                            <button type="submit" >Pay now & Confirm Order</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <div className="modal fade" id="exampleModal" tabIndex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div className="modal-dialog add-address-form">
                    <div className="modal-content bg-light py-2">
                        <div className="modal-header">
                            <h5 className="modal-title text-center m-auto" id="exampleModalLabel">
                                Add new Address
                            </h5>
                            <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i className="far fa-times"></i>
                            </button>
                        </div>
                        <form action="" onSubmit={handleSubmit}>
                            <div className="modal-body">

                                <div className="row" action="" >
                                    <div className="col-sm-12">
                                        <div className="form-inputs mb-3">
                                            <input type="text" className="form-control" placeholder="Address" id="shipping_address_line1" name="shipping_address_line1"
                                                value={formData.shipping_address_line1}
                                                onChange={handleInputChange} />
                                        </div>
                                    </div>
                                    <div className="col-sm-12">
                                        <div className="form-inputs mb-3">
                                            <input type="text" className="form-control" placeholder="Apartment (Optional)" id="shipping_address_line2"
                                                name="shipping_address_line2"
                                                value={formData.shipping_address_line2}
                                                onChange={handleInputChange} />
                                        </div>
                                    </div>
                                    <div className="col-sm-6">
                                        <div className="form-inputs mb-3">
                                            <input type="text" className="form-control" placeholder="City" id="shipping_city"
                                                name="shipping_city"
                                                value={formData.shipping_city}
                                                onChange={handleInputChange} />
                                        </div>
                                    </div>
                                    <div className="col-sm-6">
                                        <div className="form-inputs mb-3">
                                            <input type="number" className="form-control" placeholder="Post Code" id="shipping_pincode"
                                                name="shipping_pincode"
                                                value={formData.shipping_pincode}
                                                onChange={handleInputChange} />
                                        </div>
                                    </div>
                                    <div className="col-sm-6">
                                        <div className="form-inputs">
                                            <input type="text" className="form-control" placeholder="Country/Region" id="shipping_state"
                                                name="shipping_state"
                                                value={formData.shipping_state}
                                                onChange={handleInputChange} />
                                        </div>
                                    </div>
                                    <div className="col-sm-6">
                                        <div className="form-inputs">
                                            <input type="number" className="form-control" placeholder="Alternate Contact Number" id="exampleAddress" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div className="modal-footer m-auto border-0">
                                <button type="submit" className="btn button black">Add Address</button>
                                <button type="button" className="button cancel_btn black" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {/* <section className="section product_listing">
                <div className="container">
                    <div className="row align-items-center">
                        <div className="col-sm-3">
                            <div className="product-accordian product-listing-heading" data-aos="fade-up" data-aos-delay="200">
                                <h3 className="common-heading">You may also like</h3>
                                <p>Handpicked treats to complement your wellness journey.</p>
                                <div className="product-details-listing">
                                    <p>Total<br /><span>₹3500</span></p>
                                    <a href="#">Add all to basket</a>
                                </div>
                            </div>
                        </div>
                        <div className="col-sm-9">
                            <div className="row" data-aos="fade-up">
                                <div className="col-sm-4">
                                    <div className="feature-box">
                                        <div className="basket-box">
                                            <i className="fal fa-shopping-basket"></i>
                                        </div>
                                        <i className="fal fa-heart heart"></i>
                                        <img src="/assets/images/feature/feature-1.png" alt="feature image" />
                                        <div className="features-content">
                                            <p>1st Month of Pregnant</p>
                                            <h5>Baby Ubtan</h5>
                                            <h6>₹310.00</h6>
                                            <div className="star">
                                                <img src="/assets/images/star.png" alt="star image" />
                                                <img src="/assets/images/star.png" alt="star image" />
                                                <img src="/assets/images/star.png" alt="star image" />
                                                <img src="/assets/images/star.png" alt="star image" />
                                                <img src="/assets/images/star.png" alt="star image" />
                                                <span>( 6 reviews )</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="feature-box">
                                        <div className="basket-box">
                                            <i className="fal fa-shopping-basket"></i>
                                        </div>
                                        <i className="fal fa-heart heart"></i>
                                        <img src="/assets/images/feature/feature-2.png" alt="feature image" />
                                        <div className="features-content">
                                            <p>1st Month of Pregnant</p>
                                            <h5>Baby Ubtan</h5>
                                            <h6>₹310.00</h6>
                                            <div className="star">
                                                <img src="/assets/images/star.png" alt="star image" />
                                                <img src="/assets/images/star.png" alt="star image" />
                                                <img src="/assets/images/star.png" alt="star image" />
                                                <img src="/assets/images/star.png" alt="star image" />
                                                <img src="/assets/images/star.png" alt="star image" />
                                                <span>( 6 reviews )</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="feature-box">
                                        <div className="basket-box">
                                            <i className="fal fa-shopping-basket"></i>
                                        </div>
                                        <i className="fal fa-heart heart"></i>
                                        <img src="/assets/images/feature/feature-1.png" alt="feature image" />
                                        <div className="features-content">
                                            <p>1st Month of Pregnant</p>
                                            <h5>Baby Ubtan</h5>
                                            <h6>₹310.00</h6>
                                            <div className="star">
                                                <img src="/assets/images/star.png" alt="star image" />
                                                <img src="/assets/images/star.png" alt="star image" />
                                                <img src="/assets/images/star.png" alt="star image" />
                                                <img src="/assets/images/star.png" alt="star image" />
                                                <img src="/assets/images/star.png" alt="star image" />
                                                <span>( 6 reviews )</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> */}
        </HomeLayout>
    );
}
