import React, { useState } from 'react';
import axios from 'axios';
import { toast } from 'react-toastify';

const DiscountCode = ({ finalGrandTotal, couponCode1, setFinalGrandTotal, shippingAmount, codCharges, gstCharges, paymentMode, setCouponCode1, setCouponDiscount, removeCoupon }) => {
    const [couponCode, setCouponCode] = useState('');
    const [message, setMessage] = useState('');

    const handleApplyCoupon = () => {
        if (!couponCode.trim()) {
            setMessage("Please enter a coupon code.");
            return;
        }

        axios.post('/apply-coupon', { coupon_code: couponCode })
            .then(response => {
                const { discountAmount, updatedTotal, success, message } = response.data;
                if (success) {
                    
                    finalGrandTotal= 0;
                    let codCharge = paymentMode == 'Cash On Delivery' ? codCharges : 0;
                    console.log('coupon worked', discountAmount);
                    setFinalGrandTotal((Number(updatedTotal) + Number(shippingAmount) + Number(codCharge) + Number(gstCharges)).toFixed(2));
                   
                    setMessage(`Coupon applied successfully! Discount: ${discountAmount}`);
                    setCouponCode1(couponCode);
                   
                    setCouponDiscount(discountAmount);
                    console.log('coupons worked', discountAmount);
                    toast(message);
                } else {
                    setMessage(message);
                    toast(message);
                }
            })
            .catch(error => {
                
                setMessage("An error occurred while applying the coupon.");
                toast(message);
            });
    };

    return (
        <div className="discount-code">
            <input
                type="text"
                className="form-control"
                placeholder="Discount Code"
                value={couponCode}
                onChange={(e) => setCouponCode(e.target.value)}
            />
            {couponCode1 == '' &&
            <button className="discount-button" type="button" onClick={handleApplyCoupon}>
            Apply
            </button>
            }
            
            {couponCode1 != '' &&  <button className="discount-button" onClick={()=>{
                toast('Coupon removed successfully')
                setFinalGrandTotal1((Number(finalGrandTotal) + Number(couponDiscount)).toFixed(2));
                setCouponCode1('');
                setCouponDiscount(0);

                }}>Remove</button>}
           
            <br />
            <div>
          
            </div>
        </div>
        
    );
};

export default DiscountCode;