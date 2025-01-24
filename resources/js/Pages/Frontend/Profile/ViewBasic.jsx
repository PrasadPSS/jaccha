import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Link, router, useForm, usePage } from '@inertiajs/react';
import { Transition } from '@headlessui/react';
import UserMenu from '@/Layouts/UserMenu';
import { useState } from 'react';
import axios from 'axios';

export default function UpdateProfileInformation({ shipping_address }) {
    const auth = usePage().props.auth;

    return (<UserMenu auth={auth} activeTab={'account'}>

        <div
            class="tab-pane fade show active"
            id="pills-first"
            role="tabpanel"
            aria-labelledby="pills-first-tab"
        >
            <div class="account-right-content d-flex p-4">
                <div class="contact_details">
                    <p>Name: {auth.user.name}</p>
                    <p>Mail: {auth.user.email}</p>
                    <p>Phone: +91 {auth.user.mobile_no}</p>
                </div>
                <div class="contact_details">
                    {shipping_address != null &&
                     <p>
                        
                     {auth.user.name}<br />{shipping_address.shipping_district}<br />{shipping_address.shipping_city} {shipping_address.shipping_postcode}<br />{shipping_address.shipping_state},
                         India
                     </p>
                    
                    }
                   
                </div>
            </div>
        </div>
    </UserMenu>);
}





