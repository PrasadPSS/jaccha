import { useState, useRef } from 'react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { useForm, usePage } from '@inertiajs/react';
import { Transition } from '@headlessui/react';
import UserMenu from '@/Layouts/UserMenu';
import { toast } from 'react-toastify';

export default function ChangePassword({ shipping_address }) {
    const auth = usePage().props.auth;
    const passwordInput = useRef();
        const currentPasswordInput = useRef();
    
        const [isOtpModalOpen, setIsOtpModalOpen] = useState(false);
    
        const { 
            data, 
            setData, 
            errors, 
            put, 
            post, 
            reset, 
            processing, 
            recentlySuccessful 
        } = useForm({
            current_password: '',
            password: '',
            password_confirmation: '',
            otp: '',
        });
    
        const updatePassword = (e) => {
            e.preventDefault();
    
            put(route('password.update'), {
                preserveScroll: true,
                onSuccess: () => toast.success('Password Updated Successfully'),
                onError: (errors) => {
                    if (errors.password) {
                        reset('password', 'password_confirmation');
                        passwordInput.current.focus();
                    }
    
                    if (errors.current_password) {
                        reset('current_password');
                        currentPasswordInput.current.focus();
                    }
                },
            });
        };
    
        const resetPasswordWithOtp = async (e) => {
            e.preventDefault();
        
            try {
                const response = await axios.post(route('profile.reset-via-otp'), {
                    otp: data.otp,
                    password: data.password,
                    password_confirmation: data.password_confirmation,
                });
        
                    reset(); // Reset the form state
                    setIsOtpModalOpen(false); // Close the modal
                    alert('Password reset Successfully');
               
            } catch (error) {
                // Handle unexpected errors
                setIsOtpModalOpen(false);
        
                alert('Invalid otp');
            }
        };
    
        const sendOtp = async () => {
            try {
                const response = await axios.post(route('profile.sendotp'));
                if (response.data.success) {
                    setIsOtpModalOpen(true); // Show the modal if OTP is sent successfully
                } else {
                    console.error('Failed to send OTP:', response.data.message);
                }
            } catch (error) {
                console.error('Error sending OTP:', error.response?.data || error.message);
            }
        };

    return (<UserMenu auth={auth} activeTab={'changepassword'}>

<div
                  className="tab-pane fade show active"
                  id="pills-sixth"
                  role="tabpanel"
                  aria-labelledby="pills-sixth-tab"
                >
                  <form onSubmit={updatePassword} className="account-right-content">
                    <div className="details-heading px-4 py-3">
                      <h3>Change Password</h3>
                    </div>
                    <div className="contact_details p-4 need-help">
                      <div className="change">
                      <div className="col-sm-6">
                        <div className="form-inputs mb-3">
                          <input
                            type="password"
                            className="form-control"
                            placeholder="Existing Password"
                            id="exampleAddress"
                            value={data.current_password}
                            onChange={(e) => setData('current_password', e.target.value)}
                          />
                          <InputError message={errors.current_password} className="mt-2" />
                        </div>
                      </div>
                      <div className="col-sm-6">
                        <div className="form-inputs mb-3">
                          <input
                            type="password"
                            className="form-control"
                            placeholder="New Password"
                            id="exampleAddress"
                            value={data.password}
                            onChange={(e) => setData('password', e.target.value)}
                          />
                          <InputError message={errors.password} className="mt-2" />
                        </div>
                      </div>
                      <div className="col-sm-6">
                        <div className="form-inputs mb-3">
                          <input
                            type="password"
                            className="form-control"
                            placeholder="Confirm Password"
                            id="exampleAddress"
                            value={data.password_confirmation}
                            onChange={(e) => setData('password_confirmation', e.target.value)}
                          />
                            <InputError message={errors.password_confirmation} className="mt-2" />
                        </div>
                      </div>
                    </div>
                      <button type="submit" className="btn button black">Change Password</button>
                    </div>
                  </form>
                </div>
    </UserMenu>);
}





