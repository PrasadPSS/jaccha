import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import DeleteUserForm from './Partials/DeleteUserForm';
import UpdatePasswordForm from './Partials/UpdatePasswordForm';
import UpdateAdditionalFields from './Partials/UpdateAdditionalFields';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm';
import { Head, Link, usePage } from '@inertiajs/react';
import HomeLayout from '@/Layouts/HomeLayout';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink';

export default function Edit({ auth, mustVerifyEmail, status, customer }) {
    const { error, success } = usePage().props.flash;

    return (
        <HomeLayout auth={auth}>
            <Head title="Profile" />

            <div className="container py-5">
                <div className="row justify-content-center">
                    <div className="col-lg-8">
                        <div className="card mb-4 shadow-sm">
                            <div className="card-header bg-primary text-white">
                                <h3 className="mb-0">Profile Information</h3>
                            </div>
                            <div className="card-body">
                                {error && (
                                    <div className="alert alert-danger" role="alert">
                                        <strong>Error: </strong>{error}
                                    </div>
                                )}
                                {success && (
                                    <div className="alert alert-success" role="alert">
                                        <strong>Success: </strong>{success}
                                    </div>
                                )}
                                <UpdateProfileInformationForm
                                    mustVerifyEmail={mustVerifyEmail}
                                    status={status}
                                    className="max-w-xl"
                                />
                                <div className="mt-4">
                                    <Link href={route('order.index')} className="btn btn-outline-primary">
                                        View Orders
                                    </Link>
                                </div>
                            </div>
                        </div>

                        <div className="card mb-4 shadow-sm">
                            <div className="card-header bg-secondary text-white">
                                <h3 className="mb-0">Update Password</h3>
                            </div>
                            <div className="card-body">
                                <UpdatePasswordForm className="max-w-xl" />
                            </div>
                        </div>

                        <div className="card mb-4 shadow-sm">
                            <div className="card-header bg-info text-white">
                                <h3 className="mb-0">Manage Address</h3>
                            </div>
                            <div className="card-body">
                                <p>Manage your saved addresses for shipping.</p>
                                <Link
                                    href="/shippingaddress/index"
                                    method="get"
                                    as="button"
                                    className="btn btn-outline-info"
                                >
                                    Add / Edit Shipping Address
                                </Link>
                            </div>
                        </div>

                        <div className="card mb-4 shadow-sm">
                            <div className="card-header bg-danger text-white">
                                <h3 className="mb-0">Delete Account</h3>
                            </div>
                            <div className="card-body">
                                <DeleteUserForm className="max-w-xl" />
                            </div>
                        </div>

                        <div className="text-center mt-4">
                            <ResponsiveNavLink
                                method="post"
                                href={route('logout')}
                                as="button"
                                className="btn btn-danger"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </div>
        </HomeLayout>
    );
}
