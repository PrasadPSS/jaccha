import { useState, useRef } from 'react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { useForm } from '@inertiajs/react';
import { Transition } from '@headlessui/react';

export default function UpdatePasswordForm({ className = '' }) {
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
            onSuccess: () => reset(),
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

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900">Update Password</h2>

                <p className="mt-1 text-sm text-gray-600">
                    Ensure your account is using a long, random password to stay secure.
                </p>
            </header>

            {/* Form for updating password normally */}
            <form onSubmit={updatePassword} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor="current_password" value="Current Password" />

                    <TextInput
                        id="current_password"
                        ref={currentPasswordInput}
                        value={data.current_password}
                        onChange={(e) => setData('current_password', e.target.value)}
                        type="password"
                        className="mt-1 block w-full"
                        autoComplete="current-password"
                    />

                    <InputError message={errors.current_password} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="password" value="New Password" />

                    <TextInput
                        id="password"
                        ref={passwordInput}
                        value={data.password}
                        onChange={(e) => setData('password', e.target.value)}
                        type="password"
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                    />

                    <InputError message={errors.password} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="password_confirmation" value="Confirm Password" />

                    <TextInput
                        id="password_confirmation"
                        value={data.password_confirmation}
                        onChange={(e) => setData('password_confirmation', e.target.value)}
                        type="password"
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                    />

                    <InputError message={errors.password_confirmation} className="mt-2" />
                </div>

                <div className="flex items-center gap-4">
                    <PrimaryButton disabled={processing}>Save</PrimaryButton>

                    <Transition
                        show={recentlySuccessful}
                        enter="transition ease-in-out"
                        enterFrom="opacity-0"
                        leave="transition ease-in-out"
                        leaveTo="opacity-0"
                    >
                        <p className="text-sm text-gray-600">Saved.</p>
                    </Transition>
                </div>
            </form>

            {/* Reset via OTP */}
            <div className="mt-6">
                <button
                    type="button"
                    onClick={sendOtp}
                    className="text-blue-600 hover:underline text-sm"
                >
                    Reset password via OTPs
                </button>
            </div>

            {/* OTP Modal */}
            {isOtpModalOpen && (
                <div className="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
                    <div className="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                        <h2 className="text-lg font-medium text-gray-900">Reset Password via OTP</h2>

                        <form onSubmit={resetPasswordWithOtp} className="mt-4 space-y-4">
                            <div>
                                <InputLabel htmlFor="otp" value="OTP" />

                                <TextInput
                                    id="otp"
                                    value={data.otp}
                                    onChange={(e) => setData('otp', e.target.value)}
                                    type="text"
                                    className="mt-1 block w-full"
                                    placeholder="Enter the OTP"
                                />

                                <InputError message={errors.otp} className="mt-2" />
                            </div>

                            <div>
                                <InputLabel htmlFor="password" value="New Password" />

                                <TextInput
                                    id="password"
                                    value={data.password}
                                    onChange={(e) => setData('password', e.target.value)}
                                    type="password"
                                    className="mt-1 block w-full"
                                    placeholder="Enter new password"
                                />

                                <InputError message={errors.password} className="mt-2" />
                            </div>

                            <div>
                                <InputLabel htmlFor="password_confirmation" value="Confirm Password" />

                                <TextInput
                                    id="password_confirmation"
                                    value={data.password_confirmation}
                                    onChange={(e) => setData('password_confirmation', e.target.value)}
                                    type="password"
                                    className="mt-1 block w-full"
                                    placeholder="Confirm new password"
                                />

                                <InputError message={errors.password_confirmation} className="mt-2" />
                            </div>

                            <div className="flex justify-end gap-4">
                                <button
                                    type="button"
                                    onClick={() => setIsOtpModalOpen(false)}
                                    className="text-gray-600 hover:underline text-sm"
                                >
                                    Cancel
                                </button>
                                <button type="submit">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </section>
    );
}
