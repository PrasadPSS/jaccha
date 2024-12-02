import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Link, useForm, usePage } from '@inertiajs/react';
import { Transition } from '@headlessui/react';
import { useState } from 'react';

export default function UpdateAdditionalFields({ className = '', customer }) {

    const [data1, setData1] = useState({
        billing_address: '',
        shipping_address: '',
    });

    const [isBillingSameAsShipping, setIsBillingSameAsShipping] = useState(true); // Track if billing is the same as shipping
    const [errors1, setErrors] = useState({});

    const handleBillingCheckboxChange = (e) => {
        const isChecked = e.target.checked;
        setIsBillingSameAsShipping(isChecked);

        // If the checkbox is unchecked, make sure the billing address and shipping address are different
        if (!isChecked) {
            setData1({
                billing_address: data1.billing_address,
                shipping_address: '', // Clear billing address when unchecked
            });
        }
        else
        {
            setData1({
                billing_address: data1.billing_address,
                shipping_address: '', // Clear billing address when unchecked
            });
        }
    };
    const user = customer;

    const { data, setData, patch, errors, processing, recentlySuccessful } = useForm({
        flat_no: customer.flat_no || '', // Ensure you provide default values if they are null
        building_name: customer.building_name || '',
        address1: customer.address1 || '',
        address2: customer.address2 || '',
        pin_code: customer.pin_code || '',
        shipping_address: customer.shipping_address || '',
        billing_address: customer.billing_address || '',
        user_id: customer.user_id || '', // Ensure this is passed if needed
    });

    const submit = (e) => {
        e.preventDefault();

        patch(route('profile.customer.update'));
    };

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900">Additional Profile Information</h2>

                <p className="mt-1 text-sm text-gray-600">
                    Update your account's profile information and email address.
                </p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor="flat_no" value="Flat Number" />
                    <TextInput
                        id="flat_no"
                        type="text"
                        className="mt-1 block w-full"
                        value={data.flat_no}
                        onChange={(e) => setData('flat_no', e.target.value)}
                        required
                    />
                    <InputError className="mt-2" message={errors.flat_no} />
                </div>

                <div>
                    <InputLabel htmlFor="building_name" value="Building Name" />
                    <TextInput
                        id="building_name"
                        type="text"
                        className="mt-1 block w-full"
                        value={data.building_name}
                        onChange={(e) => setData('building_name', e.target.value)}
                        required
                    />
                    <InputError className="mt-2" message={errors.building_name} />
                </div>

                <div>
                    <InputLabel htmlFor="address1" value="Address Line 1" />
                    <TextInput
                        id="address1"
                        type="text"
                        className="mt-1 block w-full"
                        value={data.address1}
                        onChange={(e) => setData('address1', e.target.value)}
                        required
                    />
                    <InputError className="mt-2" message={errors.address1} />
                </div>

                <div>
                    <InputLabel htmlFor="address2" value="Address Line 2" />
                    <TextInput
                        id="address2"
                        type="text"
                        className="mt-1 block w-full"
                        value={data.address2}
                        onChange={(e) => setData('address2', e.target.value)}
                        required
                    />
                    <InputError className="mt-2" message={errors.address2} />
                </div>

                <div>
                    <InputLabel htmlFor="pin_code" value="Pin Code" />
                    <TextInput
                        id="pin_code"
                        type="text" // Changed to text to allow for non-numeric codes
                        className="mt-1 block w-full"
                        value={data.pin_code}
                        onChange={(e) => setData('pin_code', e.target.value)}
                        required
                    />
                    <InputError className="mt-2" message={errors.pin_code} />
                </div>



                <div>
                    <InputLabel htmlFor="billing_address" value="Billing Address" />
                    <TextInput
                        id="billing_address"
                        type="text"
                        className="mt-1 block w-full"
                        value={data.billing_address}
                        onChange={(e) => setData('billing_address', e.target.value)}
                        required
                    />
                    <InputError className="mt-2" message={errors.billing_address} />
                </div>

                {/* Checkbox for Same Billing Address as Shipping */}
                <div className="mt-4">
                    <label className="flex items-center">
                        <input
                            type="checkbox"
                            checked={isBillingSameAsShipping}
                            onChange={handleBillingCheckboxChange}
                            className="mr-2"
                        />
                        <span>Billing address is the same as shipping address</span>
                    </label>
                </div>

                {/* Shipping Address */}
                {!isBillingSameAsShipping && (
                    <div className="mt-4">
                        <InputLabel htmlFor="shipping_address" value="Shipping Address" />
                        <TextInput
                            id="shipping_address"
                            type="text"
                            className="mt-1 block w-full"
                            value={data.shipping_address}
                            onChange={(e) => setData('shipping_address', e.target.value)}
                            required
                        />
                        <InputError className="mt-2" message={errors.shipping_address} />
                    </div>
                )}

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
        </section>
    );
}
