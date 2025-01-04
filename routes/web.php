<?php

use App\Http\Controllers\Frontend\GoogleLoginController;
use App\Http\Controllers\Frontend\HomeController;

use App\Http\Controllers\backend\NotificationController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\AccountController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\BackendmenuController;
use App\Http\Controllers\backend\BackendsubmenuController;
use App\Http\Controllers\backend\AdminusersController;
use App\Http\Controllers\backend\RolesController;
use App\Http\Controllers\backend\CategoriesController;
use App\Http\Controllers\backend\SubcategoriesController;
use App\Http\Controllers\backend\SubsubcategoriesController;
use App\Http\Controllers\backend\ProductsController;
use App\Http\Controllers\backend\SellersController;
use App\Http\Controllers\backend\ManufacturersController;
use App\Http\Controllers\backend\PackersController;
use App\Http\Controllers\backend\ImportersController;
use App\Http\Controllers\backend\FiltersController;
use App\Http\Controllers\backend\FiltervaluesController;
use App\Http\Controllers\backend\SizesController;
use App\Http\Controllers\backend\ColorsController;
use App\Http\Controllers\backend\ProductvariantsController;
use App\Http\Controllers\backend\CmspagesController;
use App\Http\Controllers\backend\BrandsController;
use App\Http\Controllers\backend\SizechartsController;
use App\Http\Controllers\backend\SizechartchildsController;
use App\Http\Controllers\backend\FaqsController;
use App\Http\Controllers\backend\FaquestionsController;
use App\Http\Controllers\backend\HomepagesectionsController;
use App\Http\Controllers\backend\SizecharttypesController;
use App\Http\Controllers\backend\HomepagesectiontypesController;
use App\Http\Controllers\backend\HomepagesectionchildsController;
use App\Http\Controllers\backend\FootercontentController;
use App\Http\Controllers\backend\HomepagefeaturedproductsController;
use App\Http\Controllers\backend\FooterController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\HeadernotesController;
use App\Http\Controllers\backend\GstController;
use App\Http\Controllers\backend\ReviewsController;
use App\Http\Controllers\backend\NewslettersController;
use App\Http\Controllers\backend\CompanyController;
use App\Http\Controllers\backend\MissingPaymentsController;
use App\Http\Controllers\backend\OrdersController;
use App\Http\Controllers\backend\CodmanagementController;
use App\Http\Controllers\backend\OrderreturnmanagementController;
use App\Http\Controllers\backend\SuggestionsController;
use App\Http\Controllers\backend\ReportsController;
use App\Http\Controllers\backend\FilterassignController;
use App\Http\Controllers\backend\ExternalusersController;
use App\Http\Controllers\backend\SpecialDealsController;
use App\Http\Controllers\backend\OrdercancelmanagementController;
use App\Http\Controllers\backend\FakeordermanagementController;
use App\Http\Controllers\backend\DailycodlimitController;
use App\Http\Controllers\backend\MetamanageController;
use App\Http\Controllers\backend\ProductlistingController;
use App\Http\Controllers\backend\ShippingchargesmanagementController;
use App\Http\Controllers\backend\OrderdeliverymanagementController;
use App\Http\Controllers\backend\MaterialsController;
use App\Http\Controllers\backend\HsncodesController;
use App\Http\Controllers\backend\OrdercancelreasonsController;
use App\Http\Controllers\backend\OrderreturnreasonsController;
use App\Http\Controllers\backend\FrontendImagesController;
use App\Http\Controllers\backend\HotoffersController;
use App\Http\Controllers\backend\DownloadappsController;
use App\Http\Controllers\backend\LoginmanagementController;
use App\Http\Controllers\backend\SitemanagementController; //07-07-2022
use App\Http\Controllers\backend\CustompagetitlesController; //15-09-2022
use App\Http\Controllers\backend\PaymentModeController;
use App\Http\Controllers\backend\TrafficsourceController; //22-12-2022


use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\frontend\UsersController;
use App\Http\Controllers\frontend\WishlistsController;
use App\Http\Controllers\frontend\SimilarController;
use App\Http\Controllers\frontend\MyaccountController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\AddressesController;
use App\Http\Controllers\frontend\ReviewController;
use App\Http\Controllers\frontend\DealsController;
use App\Http\Controllers\frontend\SuggestionController;
use App\Http\Controllers\frontend\DealController;
use App\Http\Controllers\frontend\SearchController;
use App\Http\Controllers\frontend\NewsletterController;
use App\Http\Controllers\frontend\CouponsController;
use App\Http\Controllers\frontend\ContactusController;
use App\Http\Controllers\frontend\HotofferController;
use App\Http\Controllers\frontend\DownloadappController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
//Clear configurations:
Route::get('/config-clear', function () {
    $status = Artisan::call('config:clear');
    return '<h1>Configurations cleared</h1>';
});

//Clear cache:
Route::get('/cache-clear', function () {
    $status = Artisan::call('cache:clear');
    return '<h1>Cache cleared</h1>';
});

//Clear configuration cache:
Route::get('/config-cache', function () {
    $status = Artisan::call('config:cache');
    return '<h1>Configurations cache cleared</h1>';
});

//Clear route cache:
Route::get('/route-clear', function () {
    $status = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear view cache:
Route::get('/view-clear', function () {
    $status = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//dump autoload:
Route::get('/dump-autoload', function () {
    $status = Artisan::call('dump-autoload');
    return '<h1>Dumped Autoload</h1>';
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/thankyou', function () {
    return Inertia::render('Frontend/Orders/ThankYou');
})->middleware(['auth', 'verified'])->name('dashboard');

//shipping address
Route::get('/shippingaddress/index', [AddressesController::class, 'index'])
->middleware(['auth', 'verified'])->name('address.index');
Route::get('/shippingaddress/add', [AddressesController::class, 'addaddress'])
->middleware(['auth', 'verified'])->name('address.add');
Route::post('/shippingaddress/store', [AddressesController::class, 'storeaddress'])
->middleware(['auth', 'verified'])->name('address.store');
Route::get('/shippingaddress/edit/{shipping_address_id}', [AddressesController::class, 'editaddress'])
->middleware(['auth', 'verified'])->name('address.edit');
Route::post('/shippingaddress/update', [AddressesController::class, 'updateaddress'])
->middleware(['auth', 'verified'])->name('address.update');
Route::post('/shippingaddress/delete/{shipping_address_id}', [AddressesController::class, 'deleteaddress'])
->middleware(['auth', 'verified'])->name('address.delete');


//products
Route::get('/products', [ProductController::class, 'index'])
->name('product.index');
Route::get('/products/{category_name}', [ProductController::class, 'category'])
->name('product.category');
Route::get('/product/buy/{product_id}/{quantity}', [ProductController::class, 'buy'])
->middleware(['auth', 'verified'])->name('product.buy');
Route::post('/product/addtocart', [ProductController::class, 'addtocart'])
->middleware(['auth', 'verified'])->name('product.add');
Route::get('/product/view/{product_id}', [ProductController::class, 'viewProductDetails'])
->name('product.view');
Route::post('product/pincode/check', [ProductController::class, 'checkPincodeServiceability'])
->middleware(['auth', 'verified'])->name('product.pincode.check');

//rating and reviews
Route::post('/rating/review', [App\Http\Controllers\Frontend\ReviewController::class, 'store'])->middleware(['auth', 'verified'])
->name('product.review');
Route::post('/rating/review/edit', [App\Http\Controllers\Frontend\ReviewController::class, 'update'])->middleware(['auth', 'verified'])
->name('product.review.edit');

//wishlist
Route::get('/wishlist/view', [WishlistController::class, 'index'])
->middleware(['auth', 'verified'])->name('wishlist.index');
Route::post('/wishlist/add', [WishlistController::class, 'add'])
->middleware(['auth', 'verified'])->name('wishlist.add');
Route::get('/wishlist/add-all-to-cart', [WishlistController::class, 'addAllToCart'])
->middleware(['auth', 'verified'])->name('wishlist.addAllToCart');
Route::post('/wishlist/delete', [WishlistController::class, 'delete'])
->middleware(['auth', 'verified'])->name('wishlist.delete');


//orders
Route::get('/orders/viewinvoice/{order_id}', [OrderController::class, 'viewInvoice'])
->middleware(['auth', 'verified'])->name('order.viewinvoice');
Route::post('/order/place', [OrderController::class, 'placeOrder'])
->middleware(['auth', 'verified','isProfileCompleted'])->name('order.place');
Route::get('/checkout/payment', [OrderController::class, 'checkout'])
->middleware(['auth', 'verified','isProfileCompleted'])->name('checkout.payment');
Route::post('/order/create', [OrderController::class, 'createOrder'])
->middleware(['auth', 'verified','isProfileCompleted'])->name('order.create');
Route::get('/order/details', [OrderController::class, 'viewDetails'])
->middleware(['auth', 'verified','isProfileCompleted'])->name('order.details');

Route::get('/orders/view', [OrderController::class, 'index'])->name('order.index');
Route::get('/orders/calculaterate/{shipping_address_id}', [OrderController::class, 'calculateShippingCost'])
->name('order.calculaterate');
//profile
Route::post('/profile/sendOtp', [ProfileController::class, 'sendOtp'])
->middleware(['auth', 'verified'])->name('profile.sendotp');
Route::post('/profile/checkOtp', [ProfileController::class, 'checkOtp'])
->middleware(['auth', 'verified'])->name('profile.reset-via-otp');
Route::get('/profile/view-basic', [ProfileController::class, 'viewBasic'])
->middleware(['auth', 'verified'])->name('profile.viewBasic');
Route::get('/profile/changepassword', [ProfileController::class, 'changePassword'])
->middleware(['auth', 'verified'])->name('profile.changePassword');



//need help
Route::get('/faq/view', [FaqController::class, 'index'])->name('faq.view');

//cart
Route::post('/api/cart/increase', [CartController::class, 'increaseQuantity']);
Route::post('/api/cart/decrease', [CartController::class, 'decreaseQuantity']);
Route::post('/api/cart/remove', [CartController::class, 'removeItem']);
Route::get('/cart/view', [CartController::class, 'index'])
->middleware(['auth', 'verified','isProfileCompleted'])->name('cart.index');

//google
Route::get('/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/customer/update', [ProfileController::class, 'customerUpdate'])->name('profile.customer.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/view', [ProfileController::class, 'viewProfile'])->name('profile.view');
});

Route::get('/phonepepaymentsuccess', [CartController::class, 'phonepepaymentsuccess'])->name('phonepepaymentsuccess');
Route::get('/phonepepaymentfailure', [CartController::class, 'phonepepaymentfailure'])->name('phonepepaymentfailure');
Route::get('/phonepepaymentpending', [CartController::class, 'phonepepaymentpending'])->name('phonepepaymentpending');

Route::post('/cart/paymentstatus', [CartController::class, 'paymentstatus'])->name('cart.paymentstatus');

Route::prefix('admin')->group(function () {

    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AccountController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AccountController::class, 'login'])->name('admin.login.submit');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        // Route::get('/', [AdminController::class,'index'])->name('admin');
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/profile', [AdminController::class, 'myProfile'])->name('admin.profile');
        Route::post('/update_profile', [AdminController::class, 'updateProfile'])->name('admin.update_profile');
        Route::get('/changepassword', [AdminController::class, 'changePassword'])->name('admin.change_password');
        Route::post('/updatepassword', [AdminController::class, 'updatePassword'])->name('admin.update_password');
        Route::get('/logout', [AccountController::class, 'logout'])->name('admin.logout');
        Route::get('/permissions', [PermissionController::class, 'index'])->name('admin.permissions');
        Route::get('/permissions/create', [PermissionController::class, 'create'])->name('admin.permissions.create');
        Route::post('/permissions/store', [PermissionController::class, 'store'])->name('admin.permissions.store');
        Route::get('/permissions/edit/{id}', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
        Route::post('/permissions/update', [PermissionController::class, 'update'])->name('admin.permissions.update');
        Route::get('/permissions/delete/{id}', [PermissionController::class, 'destroy'])->name('admin.permissions.delete');
        Route::resource('admin/permission', 'PermissionController');
        Route::get('/backendmenu', [BackendmenuController::class, 'index'])->name('admin.backendmenu');
        Route::get('/backendmenu/create', [BackendmenuController::class, 'create'])->name('admin.backendmenu.create');
        Route::post('/backendmenu/store', [BackendmenuController::class, 'store'])->name('admin.backendmenu.store');
        Route::get('/backendmenu/edit/{id}', [BackendmenuController::class, 'edit'])->name('admin.backendmenu.edit');
        Route::post('/backendmenu/update', [BackendmenuController::class, 'update'])->name('admin.backendmenu.update');
        Route::get('/backendmenu/delete/{id}', [BackendmenuController::class, 'destroy'])->name('admin.backendmenu.delete');
        Route::get('/backendmenu/view/{id}', [BackendmenuController::class, 'show'])->name('admin.backendmenu.view');
        Route::resource('admin/backendmenu', 'BackendmenuController');
        Route::get('/backendsubmenu', [BackendsubmenuController::class, 'index'])->name('admin.backendsubmenu');
        Route::get('/backendsubmenu/menu/{menu_id}', [BackendsubmenuController::class, 'menu'])->name('admin.backendsubmenu.menu');
        Route::get('/backendsubmenu/create/{menu_id?}', [BackendsubmenuController::class, 'create'])->name('admin.backendsubmenu.create');
        Route::post('/backendsubmenu/store', [BackendsubmenuController::class, 'store'])->name('admin.backendsubmenu.store');
        Route::get('/backendsubmenu/edit/{id}', [BackendsubmenuController::class, 'edit'])->name('admin.backendsubmenu.edit');
        Route::post('/backendsubmenu/update', [BackendsubmenuController::class, 'update'])->name('admin.backendsubmenu.update');
        Route::get('/backendsubmenu/delete/{id}', [BackendsubmenuController::class, 'destroy'])->name('admin.backendsubmenu.delete');
        Route::get('/backendsubmenu/view/{id}', [BackendsubmenuController::class, 'show'])->name('admin.backendsubmenu.view');
        Route::resource('admin/backendsubmenu', 'BackendsubmenuController');

        Route::get('/adminusers', [AdminusersController::class, 'index'])->name('admin.adminusers');
        Route::get('/adminusers/create', [AdminusersController::class, 'create'])->name('admin.adminusers.create');
        Route::post('/adminusers/store', [AdminusersController::class, 'store'])->name('admin.adminusers.store');
        Route::get('/adminusers/edit/{id}', [AdminusersController::class, 'edit'])->name('admin.adminusers.edit');
        Route::post('/adminusers/update', [AdminusersController::class, 'update'])->name('admin.adminusers.update');
        Route::get('/adminusers/delete/{id}', [AdminusersController::class, 'destroy'])->name('admin.adminusers.delete');
        Route::get('/adminusers/view/{id}', [AdminusersController::class, 'show'])->name('admin.adminusers.view');
        Route::get('/adminusers/editstatus/{id}', [AdminusersController::class, 'editstatus'])->name('admin.adminusers.editstatus');
        Route::post('/adminusers/updatestatus', [AdminusersController::class, 'updatestatus'])->name('admin.adminusers.updatestatus');
        Route::resource('admin/adminusers', 'AdminusersController');

        Route::get('/roles', [RolesController::class, 'index'])->name('admin.roles');
        Route::get('/roles/create', [RolesController::class, 'create'])->name('admin.roles.create');
        Route::post('/roles/store', [RolesController::class, 'store'])->name('admin.roles.store');
        Route::get('/roles/edit/{id}', [RolesController::class, 'edit'])->name('admin.roles.edit');
        Route::post('/roles/update', [RolesController::class, 'update'])->name('admin.roles.update');
        Route::get('/roles/delete/{id}', [RolesController::class, 'destroy'])->name('admin.roles.delete');
        Route::get('/roles/view/{id}', [RolesController::class, 'show'])->name('admin.roles.view');
        Route::resource('admin/roles', 'RolesController');

        Route::get('/categories', [CategoriesController::class, 'index'])->name('admin.categories');
        Route::get('/categories/create', [CategoriesController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories/store', [CategoriesController::class, 'store'])->name('admin.categories.store');
        Route::get('/categories/edit/{id}', [CategoriesController::class, 'edit'])->name('admin.categories.edit');
        Route::post('/categories/update', [CategoriesController::class, 'update'])->name('admin.categories.update');
        Route::get('/categories/delete/{id}', [CategoriesController::class, 'destroy'])->name('admin.categories.delete');
        Route::get('/categories/view/{id}', [CategoriesController::class, 'show'])->name('admin.categories.view');
        Route::resource('admin/categories', 'CategoriesController');

        Route::get('/subcategories', [SubcategoriesController::class, 'index'])->name('admin.subcategories');
        Route::get('/subcategories/category/{category_id}', [SubcategoriesController::class, 'category'])->name('admin.subcategories.category');
        Route::get('/subcategories/create/{category_id?}', [SubcategoriesController::class, 'create'])->name('admin.subcategories.create');
        Route::post('/subcategories/store', [SubcategoriesController::class, 'store'])->name('admin.subcategories.store');
        Route::get('/subcategories/edit/{id}', [SubcategoriesController::class, 'edit'])->name('admin.subcategories.edit');
        Route::post('/subcategories/update', [SubcategoriesController::class, 'update'])->name('admin.subcategories.update');
        Route::get('/subcategories/delete/{id}', [SubcategoriesController::class, 'destroy'])->name('admin.subcategories.delete');
        Route::get('/subcategories/view/{id}', [SubcategoriesController::class, 'show'])->name('admin.subcategories.view');
        Route::resource('admin/subcategories', 'SubcategoriesController');

        Route::get('/subsubcategories', [SubsubcategoriesController::class, 'index'])->name('admin.subsubcategories');
        Route::get('/subsubcategories/subcategory/{category_id}/{subcategory_id}', [SubsubcategoriesController::class, 'subcategory'])->name('admin.subsubcategories.subcategory');
        Route::get('/subsubcategories/create/{category_id?}/{subcategory_id?}', [SubsubcategoriesController::class, 'create'])->name('admin.subsubcategories.create');
        Route::post('/subsubcategories/store', [SubsubcategoriesController::class, 'store'])->name('admin.subsubcategories.store');
        Route::get('/subsubcategories/edit/{id}', [SubsubcategoriesController::class, 'edit'])->name('admin.subsubcategories.edit');
        Route::post('/subsubcategories/update', [SubsubcategoriesController::class, 'update'])->name('admin.subsubcategories.update');
        Route::get('/subsubcategories/delete/{id}', [SubsubcategoriesController::class, 'destroy'])->name('admin.subsubcategories.delete');
        Route::get('/subsubcategories/view/{id}', [SubsubcategoriesController::class, 'show'])->name('admin.subsubcategories.view');
        Route::post('/subsubcategories/getsubcategory', [SubsubcategoriesController::class, 'getsubcategory'])->name('admin.subsubcategories.getsubcategory');
        // Route::post('/subsubcategories/{id}/getsubcategory', [SubsubcategoriesController::class,'getsubcategory'])->name('admin.subsubcategories.getsubcategory');
        Route::resource('admin/subsubcategories', 'SubsubcategoriesController');

        Route::get('/products', [ProductsController::class, 'index'])->name('admin.products');
        Route::get('/products/create', [ProductsController::class, 'create'])->name('admin.products.create');
        Route::post('/products/store', [ProductsController::class, 'store'])->name('admin.products.store');
        Route::get('/products/edit/{id}', [ProductsController::class, 'edit'])->name('admin.products.edit');
        Route::post('/products/update', [ProductsController::class, 'update'])->name('admin.products.update');
        Route::get('/products/delete/{id}', [ProductsController::class, 'destroy'])->name('admin.products.delete');
        Route::get('/products/view/{id}', [ProductsController::class, 'show'])->name('admin.products.view');
        Route::post('/products/getsubcategory', [ProductsController::class, 'getsubcategory'])->name('admin.products.getsubcategory');
        Route::post('/products/getfilters', [ProductsController::class, 'getfilters'])->name('admin.products.getfilters'); //03-03-2022
        Route::post('/products/getmightprefer', [ProductsController::class, 'getmightprefer'])->name('admin.products.getmightprefer'); //24-05-2022
        Route::post('/products/getfrequentlybrought', [ProductsController::class, 'getfrequentlybrought'])->name('admin.products.getfrequentlybrought'); //24-05-2022
        Route::post('/products/getsubsubcategory', [ProductsController::class, 'getsubsubcategory'])->name('admin.products.getsubsubcategory');
        Route::post('/products/gethsncodes', [ProductsController::class, 'gethsncodes'])->name('admin.products.gethsncodes');
        Route::post('/products/getproductvariants', [ProductsController::class, 'getproductvariants'])->name('admin.products.getproductvariants');
        Route::post('/products/addproductvariants', [ProductsController::class, 'addproductvariants'])->name('admin.products.addproductvariants');
        Route::get('/products/deleteimage/{id}', [ProductsController::class, 'destroy_image'])->name('admin.products.deleteimage');
        Route::post('/products/delete_product_images', [ProductsController::class, 'destroy_images'])->name('admin.products.deleteproductimages'); //15-07-2022
        Route::post('/products/getbrands', [ProductsController::class, 'getbrands'])->name('admin.products.getbrands');
        Route::get('/products/excel', [ProductsController::class, 'productExcel'])->name('admin.products.excel');
        Route::resource('admin/products', 'ProductsController');

        Route::get('/sellers', [SellersController::class, 'index'])->name('admin.sellers');
        Route::get('/sellers/create', [SellersController::class, 'create'])->name('admin.sellers.create');
        Route::post('/sellers/store', [SellersController::class, 'store'])->name('admin.sellers.store');
        Route::get('/sellers/edit/{id}', [SellersController::class, 'edit'])->name('admin.sellers.edit');
        Route::post('/sellers/update', [SellersController::class, 'update'])->name('admin.sellers.update');
        Route::get('/sellers/delete/{id}', [SellersController::class, 'destroy'])->name('admin.sellers.delete');
        Route::get('/sellers/view/{id}', [SellersController::class, 'show'])->name('admin.sellers.view');
        Route::resource('admin/sellers', 'SellersController');

        Route::get('/manufacturers', [ManufacturersController::class, 'index'])->name('admin.manufacturers');
        Route::get('/manufacturers/create', [ManufacturersController::class, 'create'])->name('admin.manufacturers.create');
        Route::post('/manufacturers/store', [ManufacturersController::class, 'store'])->name('admin.manufacturers.store');
        Route::get('/manufacturers/edit/{id}', [ManufacturersController::class, 'edit'])->name('admin.manufacturers.edit');
        Route::post('/manufacturers/update', [ManufacturersController::class, 'update'])->name('admin.manufacturers.update');
        Route::get('/manufacturers/delete/{id}', [ManufacturersController::class, 'destroy'])->name('admin.manufacturers.delete');
        Route::get('/manufacturers/view/{id}', [ManufacturersController::class, 'show'])->name('admin.manufacturers.view');
        Route::resource('admin/manufacturers', 'ManufacturersController');

        Route::get('/packers', [PackersController::class, 'index'])->name('admin.packers');
        Route::get('/packers/create', [PackersController::class, 'create'])->name('admin.packers.create');
        Route::post('/packers/store', [PackersController::class, 'store'])->name('admin.packers.store');
        Route::get('/packers/edit/{id}', [PackersController::class, 'edit'])->name('admin.packers.edit');
        Route::post('/packers/update', [PackersController::class, 'update'])->name('admin.packers.update');
        Route::get('/packers/delete/{id}', [PackersController::class, 'destroy'])->name('admin.packers.delete');
        Route::get('/packers/view/{id}', [PackersController::class, 'show'])->name('admin.packers.view');
        Route::resource('admin/packers', 'PackersController');

        Route::get('/notifications', [NotificationController::class, 'index'])->name('admin.notification');

        Route::get('/importers', [ImportersController::class, 'index'])->name('admin.importers');
        Route::get('/importers/create', [ImportersController::class, 'create'])->name('admin.importers.create');
        Route::post('/importers/store', [ImportersController::class, 'store'])->name('admin.importers.store');
        Route::get('/importers/edit/{id}', [ImportersController::class, 'edit'])->name('admin.importers.edit');
        Route::post('/importers/update', [ImportersController::class, 'update'])->name('admin.importers.update');
        Route::get('/importers/delete/{id}', [ImportersController::class, 'destroy'])->name('admin.importers.delete');
        Route::get('/importers/view/{id}', [ImportersController::class, 'show'])->name('admin.importers.view');
        Route::resource('admin/importers', 'ImportersController');

        Route::get('/filters', [FiltersController::class, 'filter_by_category'])->name('admin.filters');
        Route::get('/filters/{id}', [FiltersController::class, 'index'])->name('admin.filterscategorylist');
        Route::get('/filters/create/{id}', [FiltersController::class, 'create'])->name('admin.filters.create');
        Route::post('/filters/store', [FiltersController::class, 'store'])->name('admin.filters.store');
        Route::get('/filters/edit/{id}', [FiltersController::class, 'edit'])->name('admin.filters.edit');
        Route::post('/filters/update', [FiltersController::class, 'update'])->name('admin.filters.update');
        Route::get('/filters/delete/{id}', [FiltersController::class, 'destroy'])->name('admin.filters.delete');
        Route::get('/filters/view/{id}', [FiltersController::class, 'show'])->name('admin.filters.view');
        Route::resource('admin/filters', 'FiltersController');

        Route::get('/filtervalues/index/{id}', [FiltervaluesController::class, 'index'])->name('admin.filtervalues');
        Route::get('/filtervalues/create/{id}', [FiltervaluesController::class, 'create'])->name('admin.filtervalues.create');
        Route::post('/filtervalues/store', [FiltervaluesController::class, 'store'])->name('admin.filtervalues.store');
        Route::get('/filtervalues/edit/{id}', [FiltervaluesController::class, 'edit'])->name('admin.filtervalues.edit');
        Route::post('/filtervalues/update', [FiltervaluesController::class, 'update'])->name('admin.filtervalues.update');
        Route::get('/filtervalues/delete/{id}', [FiltervaluesController::class, 'destroy'])->name('admin.filtervalues.delete');
        Route::get('/filtervalues/view/{id}', [FiltervaluesController::class, 'show'])->name('admin.filtervalues.view');
        Route::resource('admin/filtervalues', 'FiltervaluesController');

        Route::get('/filterassign/', [FilterassignController::class, 'index'])->name('admin.filterassign');
        // Route::get('/filterassign/index/{id}', [FilterassignController::class,'index'])->name('admin.filterassign');
        Route::get('/filterassign/firstlevel/{id}', [FilterassignController::class, 'firstlevel'])->name('admin.filterassign.firstlevel');
        Route::get('/filterassign/secondlevel/{id}', [FilterassignController::class, 'secondlevel'])->name('admin.filterassign.secondlevel');
        Route::get('/filterassign/thirdlevel/{id}', [FilterassignController::class, 'thirdlevel'])->name('admin.filterassign.thirdlevel');
        Route::get('/filterassign/create/{id}', [FilterassignController::class, 'create'])->name('admin.filterassign.create');
        Route::post('/filterassign/store', [FilterassignController::class, 'store'])->name('admin.filterassign.store');
        Route::get('/filterassign/edit/{id}', [FilterassignController::class, 'edit'])->name('admin.filterassign.edit');
        Route::post('/filterassign/update', [FilterassignController::class, 'update'])->name('admin.filterassign.update');
        Route::get('/filterassign/delete/{id}', [FilterassignController::class, 'destroy'])->name('admin.filterassign.delete');
        Route::get('/filterassign/view/{id}', [FilterassignController::class, 'show'])->name('admin.filterassign.view');
        Route::get('/filterassign/firstlevel/edit/{id}', [FilterassignController::class, 'first_level_edit'])->name('admin.filterassign.firstlevel.edit');
        Route::post('/filterassign/firstlevel/update', [FilterassignController::class, 'first_level_update'])->name('admin.filterassign.firstlevel.update');
        Route::get('/filterassign/secondlevel/edit/{id}/{sub_id}', [FilterassignController::class, 'second_level_edit'])->name('admin.filterassign.secondlevel.edit');
        Route::post('/filterassign/secondlevel/update', [FilterassignController::class, 'second_level_update'])->name('admin.filterassign.secondlevel.update');
        Route::get('/filterassign/thirdlevel/edit/{id}/{sub_id}/{sub_sub_id}', [FilterassignController::class, 'third_level_edit'])->name('admin.filterassign.thirdlevel.edit');
        Route::post('/filterassign/thirdlevel/update', [FilterassignController::class, 'third_level_update'])->name('admin.filterassign.thirdlevel.update');
        Route::resource('admin/filterassign', 'FilterassignController');

        Route::get('/productlisting/', [ProductlistingController::class, 'index'])->name('admin.productlisting');
        // Route::get('/productlisting/index/{id}', [ProductlistingController::class,'index'])->name('admin.productlisting');
        Route::get('/productlisting/firstlevel/{id}', [ProductlistingController::class, 'firstlevel'])->name('admin.productlisting.firstlevel');
        Route::get('/productlisting/secondlevel/{id}', [ProductlistingController::class, 'secondlevel'])->name('admin.productlisting.secondlevel');
        Route::get('/productlisting/thirdlevel/{id}', [ProductlistingController::class, 'thirdlevel'])->name('admin.productlisting.thirdlevel');
        Route::get('/productlisting/create/{id}', [ProductlistingController::class, 'create'])->name('admin.productlisting.create');
        Route::post('/productlisting/store', [ProductlistingController::class, 'store'])->name('admin.productlisting.store');
        Route::get('/productlisting/edit/{id}', [ProductlistingController::class, 'edit'])->name('admin.productlisting.edit');
        Route::post('/productlisting/update', [ProductlistingController::class, 'update'])->name('admin.productlisting.update');
        Route::get('/productlisting/delete/{id}', [ProductlistingController::class, 'destroy'])->name('admin.productlisting.delete');
        Route::get('/productlisting/view/{id}', [ProductlistingController::class, 'show'])->name('admin.productlisting.view');
        Route::get('/productlisting/firstlevel/edit/{id}', [ProductlistingController::class, 'first_level_edit'])->name('admin.productlisting.firstlevel.edit');
        Route::post('/productlisting/firstlevel/update', [ProductlistingController::class, 'first_level_update'])->name('admin.productlisting.firstlevel.update');
        Route::get('/productlisting/secondlevel/edit/{id}/{sub_id}', [ProductlistingController::class, 'second_level_edit'])->name('admin.productlisting.secondlevel.edit');
        Route::post('/productlisting/secondlevel/update', [ProductlistingController::class, 'second_level_update'])->name('admin.productlisting.secondlevel.update');
        Route::get('/productlisting/thirdlevel/edit/{id}/{sub_id}/{sub_sub_id}', [ProductlistingController::class, 'third_level_edit'])->name('admin.productlisting.thirdlevel.edit');
        Route::post('/productlisting/thirdlevel/update', [ProductlistingController::class, 'third_level_update'])->name('admin.productlisting.thirdlevel.update');
        Route::resource('admin/productlisting', 'ProductlistingController');

        Route::get('/colors', [ColorsController::class, 'index'])->name('admin.colors');
        Route::get('/colors/create', [ColorsController::class, 'create'])->name('admin.colors.create');
        Route::post('/colors/store', [ColorsController::class, 'store'])->name('admin.colors.store');
        Route::get('/colors/edit/{id}', [ColorsController::class, 'edit'])->name('admin.colors.edit');
        Route::post('/colors/update', [ColorsController::class, 'update'])->name('admin.colors.update');
        Route::get('/colors/delete/{id}', [ColorsController::class, 'destroy'])->name('admin.colors.delete');
        Route::get('/colors/view/{id}', [ColorsController::class, 'show'])->name('admin.colors.view');
        Route::resource('admin/colors', 'ColorsController');

        Route::get('/sizes', [SizesController::class, 'index'])->name('admin.sizes');
        Route::get('/sizes/create', [SizesController::class, 'create'])->name('admin.sizes.create');
        Route::post('/sizes/store', [SizesController::class, 'store'])->name('admin.sizes.store');
        Route::get('/sizes/edit/{id}', [SizesController::class, 'edit'])->name('admin.sizes.edit');
        Route::post('/sizes/update', [SizesController::class, 'update'])->name('admin.sizes.update');
        Route::get('/sizes/delete/{id}', [SizesController::class, 'destroy'])->name('admin.sizes.delete');
        Route::get('/sizes/view/{id}', [SizesController::class, 'show'])->name('admin.sizes.view');
        Route::resource('admin/sizes', 'SizesController');

        Route::get('/productvariants/index/{id}', [ProductvariantsController::class, 'index'])->name('admin.productvariants');
        Route::get('/productvariants/create/{id}', [ProductvariantsController::class, 'create'])->name('admin.productvariants.create');
        Route::post('/productvariants/store', [ProductvariantsController::class, 'store'])->name('admin.productvariants.store');
        Route::get('/productvariants/edit/{id}', [ProductvariantsController::class, 'edit'])->name('admin.productvariants.edit');
        Route::post('/productvariants/update', [ProductvariantsController::class, 'update'])->name('admin.productvariants.update');
        Route::get('/productvariants/delete/{id}', [ProductvariantsController::class, 'destroy'])->name('admin.productvariants.delete');
        Route::get('/productvariants/view/{id}', [ProductvariantsController::class, 'show'])->name('admin.productvariants.view');
        Route::get('/productvariants/deleteimage/{id}', [ProductvariantsController::class, 'destroy_image'])->name('admin.productvariants.deleteimage');
        Route::post('/productvariants/delete/all_images', [ProductvariantsController::class, 'destroy_images'])->name('admin.productvariants.delete.all_image');
        Route::resource('admin/productvariants', 'ProductvariantsController');

        Route::get('/cmspages', [CmspagesController::class, 'index'])->name('admin.cmspages');
        Route::get('/cmspages/create', [CmspagesController::class, 'create'])->name('admin.cmspages.create');
        Route::post('/cmspages/store', [CmspagesController::class, 'store'])->name('admin.cmspages.store');
        Route::get('/cmspages/edit/{id}', [CmspagesController::class, 'edit'])->name('admin.cmspages.edit');
        Route::post('/cmspages/update', [CmspagesController::class, 'update'])->name('admin.cmspages.update');
        Route::get('/cmspages/delete/{id}', [CmspagesController::class, 'destroy'])->name('admin.cmspages.delete');
        Route::get('/cmspages/view/{id}', [CmspagesController::class, 'show'])->name('admin.cmspages.view');
        Route::resource('admin/cmspages', 'CmspagesController');

        Route::get('/brands/index/{id}', [BrandsController::class, 'index'])->name('admin.brands');
        Route::get('/brands/create/{id}', [BrandsController::class, 'create'])->name('admin.brands.create');
        Route::post('/brands/store', [BrandsController::class, 'store'])->name('admin.brands.store');
        Route::get('/brands/edit/{id}', [BrandsController::class, 'edit'])->name('admin.brands.edit');
        Route::post('/brands/update', [BrandsController::class, 'update'])->name('admin.brands.update');
        Route::get('/brands/delete/{id}', [BrandsController::class, 'destroy'])->name('admin.brands.delete');
        Route::get('/brands/view/{id}', [BrandsController::class, 'show'])->name('admin.brands.view');
        Route::resource('admin/brands', 'BrandsController');

        Route::get('/sizecharts', [SizechartsController::class, 'index'])->name('admin.sizecharts');
        Route::get('/sizecharts/create', [SizechartsController::class, 'create'])->name('admin.sizecharts.create');
        Route::post('/sizecharts/store', [SizechartsController::class, 'store'])->name('admin.sizecharts.store');
        Route::get('/sizecharts/edit/{id}', [SizechartsController::class, 'edit'])->name('admin.sizecharts.edit');
        Route::post('/sizecharts/update', [SizechartsController::class, 'update'])->name('admin.sizecharts.update');
        Route::get('/sizecharts/delete/{id}', [SizechartsController::class, 'destroy'])->name('admin.sizecharts.delete');
        Route::get('/sizecharts/deleteimage/{id}', [SizechartsController::class, 'destroy_image'])->name('admin.sizecharts.deleteimage');
        Route::get('/sizecharts/view/{id}', [SizechartsController::class, 'show'])->name('admin.sizecharts.view');
        Route::post('/sizecharts/getsizes', [SizechartsController::class, 'getsizes'])->name('admin.sizecharts.getsizes');
        Route::post('/sizecharts/getsizechartchilds', [SizechartsController::class, 'getsizechartchilds'])->name('admin.sizecharts.getsizechartchilds');
        Route::resource('admin/sizecharts', 'SizechartsController');

        Route::get('/sizechartchilds/index/{id}', [SizechartchildsController::class, 'index'])->name('admin.sizechartchilds');
        Route::get('/sizechartchilds/create/{id}', [SizechartchildsController::class, 'create'])->name('admin.sizechartchilds.create');
        Route::post('/sizechartchilds/store', [SizechartchildsController::class, 'store'])->name('admin.sizechartchilds.store');
        Route::get('/sizechartchilds/edit/{id}', [SizechartchildsController::class, 'edit'])->name('admin.sizechartchilds.edit');
        Route::post('/sizechartchilds/update', [SizechartchildsController::class, 'update'])->name('admin.sizechartchilds.update');
        Route::get('/sizechartchilds/delete/{id}', [SizechartchildsController::class, 'destroy'])->name('admin.sizechartchilds.delete');
        Route::get('/sizechartchilds/view/{id}', [SizechartchildsController::class, 'show'])->name('admin.sizechartchilds.view');
        Route::resource('admin/sizechartchilds', 'SizechartchildsController');


        Route::get('/faqs', [FaqsController::class, 'index'])->name('admin.faqs');
        Route::get('/faqs/create', [FaqsController::class, 'create'])->name('admin.faqs.create');
        Route::post('/faqs/store', [FaqsController::class, 'store'])->name('admin.faqs.store');
        Route::get('/faqs/edit/{id}', [FaqsController::class, 'edit'])->name('admin.faqs.edit');
        Route::post('/faqs/update', [FaqsController::class, 'update'])->name('admin.faqs.update');
        Route::get('/faqs/delete/{id}', [FaqsController::class, 'destroy'])->name('admin.faqs.delete');
        Route::get('/faqs/view/{id}', [FaqsController::class, 'show'])->name('admin.faqs.view');
        Route::resource('admin/faqs', 'FaqsController');

        Route::get('/faquestions/index/{id}', [FaquestionsController::class, 'index'])->name('admin.faquestions');
        Route::get('/faquestions/create/{id}', [FaquestionsController::class, 'create'])->name('admin.faquestions.create');
        Route::post('/faquestions/store', [FaquestionsController::class, 'store'])->name('admin.faquestions.store');
        Route::get('/faquestions/edit/{id}', [FaquestionsController::class, 'edit'])->name('admin.faquestions.edit');
        Route::post('/faquestions/update', [FaquestionsController::class, 'update'])->name('admin.faquestions.update');
        Route::get('/faquestions/delete/{id}', [FaquestionsController::class, 'destroy'])->name('admin.faquestions.delete');
        Route::get('/faquestions/view/{id}', [FaquestionsController::class, 'show'])->name('admin.faquestions.view');
        Route::resource('admin/faquestions', 'FaquestionsController');

        Route::get('/sizecharttypes', [SizecharttypesController::class, 'index'])->name('admin.sizecharttypes');
        Route::get('/sizecharttypes/create', [SizecharttypesController::class, 'create'])->name('admin.sizecharttypes.create');
        Route::post('/sizecharttypes/store', [SizecharttypesController::class, 'store'])->name('admin.sizecharttypes.store');
        Route::get('/sizecharttypes/edit/{id}', [SizecharttypesController::class, 'edit'])->name('admin.sizecharttypes.edit');
        Route::post('/sizecharttypes/update', [SizecharttypesController::class, 'update'])->name('admin.sizecharttypes.update');
        Route::get('/sizecharttypes/delete/{id}', [SizecharttypesController::class, 'destroy'])->name('admin.sizecharttypes.delete');
        Route::get('/sizecharttypes/view/{id}', [SizecharttypesController::class, 'show'])->name('admin.sizecharttypes.view');
        Route::resource('admin/sizecharttypes', 'SizecharttypesController');

        Route::get('/homepagesections', [HomepagesectionsController::class, 'index'])->name('admin.homepagesections');
        Route::get('/homepagesections/create', [HomepagesectionsController::class, 'create'])->name('admin.homepagesections.create');
        Route::post('/homepagesections/store', [HomepagesectionsController::class, 'store'])->name('admin.homepagesections.store');
        Route::get('/homepagesections/edit/{id}', [HomepagesectionsController::class, 'edit'])->name('admin.homepagesections.edit');
        Route::post('/homepagesections/update', [HomepagesectionsController::class, 'update'])->name('admin.homepagesections.update');
        Route::get('/homepagesections/delete/{id}', [HomepagesectionsController::class, 'destroy'])->name('admin.homepagesections.delete');
        Route::get('/homepagesections/view/{id}', [HomepagesectionsController::class, 'show'])->name('admin.homepagesections.view');
        Route::post('/homepagesections/setsectionorder', [HomepagesectionsController::class, 'setsectionorder'])->name('admin.homepagesections.setsectionorder');
        Route::resource('admin/homepagesections', 'HomepagesectionsController');

        Route::get('/homepagesectiontypes', [HomepagesectiontypesController::class, 'index'])->name('admin.homepagesectiontypes');
        Route::get('/homepagesectiontypes/create', [HomepagesectiontypesController::class, 'create'])->name('admin.homepagesectiontypes.create');
        Route::post('/homepagesectiontypes/store', [HomepagesectiontypesController::class, 'store'])->name('admin.homepagesectiontypes.store');
        Route::get('/homepagesectiontypes/edit/{id}', [HomepagesectiontypesController::class, 'edit'])->name('admin.homepagesectiontypes.edit');
        Route::post('/homepagesectiontypes/update', [HomepagesectiontypesController::class, 'update'])->name('admin.homepagesectiontypes.update');
        Route::get('/homepagesectiontypes/delete/{id}', [HomepagesectiontypesController::class, 'destroy'])->name('admin.homepagesectiontypes.delete');
        Route::get('/homepagesectiontypes/view/{id}', [HomepagesectiontypesController::class, 'show'])->name('admin.homepagesectiontypes.view');
        Route::resource('admin/homepagesectiontypes', 'HomepagesectiontypesController');

        Route::get('/homepagesectionchilds/index/{id}', [HomepagesectionchildsController::class, 'index'])->name('admin.homepagesectionchilds');
        Route::get('/homepagesectionchilds/create/{id}', [HomepagesectionchildsController::class, 'create'])->name('admin.homepagesectionchilds.create');
        Route::post('/homepagesectionchilds/store', [HomepagesectionchildsController::class, 'store'])->name('admin.homepagesectionchilds.store');
        Route::get('/homepagesectionchilds/edit/{id}', [HomepagesectionchildsController::class, 'edit'])->name('admin.homepagesectionchilds.edit');
        Route::post('/homepagesectionchilds/update', [HomepagesectionchildsController::class, 'update'])->name('admin.homepagesectionchilds.update');
        Route::get('/homepagesectionchilds/delete/{id}', [HomepagesectionchildsController::class, 'destroy'])->name('admin.homepagesectionchilds.delete');
        Route::get('/homepagesectionchilds/view/{id}', [HomepagesectionchildsController::class, 'show'])->name('admin.homepagesectionchilds.view');
        Route::resource('admin/homepagesectionchilds', 'HomepagesectionchildsController');

        Route::get('/homepagefeaturedproducts', [HomepagefeaturedproductsController::class, 'index'])->name('admin.homepagefeaturedproducts');
        Route::get('/homepagefeaturedproducts/create', [HomepagefeaturedproductsController::class, 'create'])->name('admin.homepagefeaturedproducts.create');
        Route::post('/homepagefeaturedproducts/store', [HomepagefeaturedproductsController::class, 'store'])->name('admin.homepagefeaturedproducts.store');
        Route::get('/homepagefeaturedproducts/edit/{id}', [HomepagefeaturedproductsController::class, 'edit'])->name('admin.homepagefeaturedproducts.edit');
        Route::post('/homepagefeaturedproducts/update', [HomepagefeaturedproductsController::class, 'update'])->name('admin.homepagefeaturedproducts.update');
        Route::get('/homepagefeaturedproducts/delete/{id}', [HomepagefeaturedproductsController::class, 'destroy'])->name('admin.homepagefeaturedproducts.delete');
        Route::get('/homepagefeaturedproducts/view/{id}', [HomepagefeaturedproductsController::class, 'show'])->name('admin.homepagefeaturedproducts.view');
        Route::resource('admin/homepagefeaturedproducts', 'HomepagefeaturedproductsController');

        Route::get('/footer', [FooterController::class, 'index'])->name('admin.footer');
        Route::get('/footer/create', [FooterController::class, 'create'])->name('admin.footer.create');
        Route::post('/footer/store', [FooterController::class, 'store'])->name('admin.footer.store');
        Route::get('/footer/edit/{id}', [FooterController::class, 'edit'])->name('admin.footer.edit');
        Route::post('/footer/update', [FooterController::class, 'update'])->name('admin.footer.update');
        Route::get('/footer/delete/{id}', [FooterController::class, 'destroy'])->name('admin.footer.delete');
        Route::post('/footer/getCategory', [FooterController::class, 'getCategory'])->name('admin.footer.getCategory');
        Route::post('/footer/getsubsubcategory', [FooterController::class, 'getsubsubcategory'])->name('admin.footer.getsubsubcategory');
        Route::post('/footer/geteditsubsubcategory', [FooterController::class, 'geteditsubsubcategory'])->name('admin.footer.geteditsubsubcategory');
        Route::resource('admin/footer', 'FooterController');

        Route::get('/coupon', [CouponController::class, 'index'])->name('admin.coupon');
        Route::get('/coupon/create', [CouponController::class, 'create'])->name('admin.coupon.create');
        Route::post('/coupon/store', [CouponController::class, 'store'])->name('admin.coupon.store');
        Route::get('/coupon/edit/{id}', [CouponController::class, 'edit'])->name('admin.coupon.edit');
        Route::post('/coupon/update', [CouponController::class, 'update'])->name('admin.coupon.update');
        Route::get('/coupon/delete/{id}', [CouponController::class, 'destroy'])->name('admin.coupon.delete');
        Route::get('/coupon/view/{id}', [CouponController::class, 'show'])->name('admin.coupon.view');
        Route::resource('admin/coupon', 'CouponController');

        Route::get('/headernotes', [HeadernotesController::class, 'index'])->name('admin.headernotes');
        Route::get('/headernotes/create', [HeadernotesController::class, 'create'])->name('admin.headernotes.create');
        Route::post('/headernotes/store', [HeadernotesController::class, 'store'])->name('admin.headernotes.store');
        Route::get('/headernotes/edit/{id}', [HeadernotesController::class, 'edit'])->name('admin.headernotes.edit');
        Route::post('/headernotes/update', [HeadernotesController::class, 'update'])->name('admin.headernotes.update');
        Route::get('/headernotes/delete/{id}', [HeadernotesController::class, 'destroy'])->name('admin.headernotes.delete');
        Route::get('/headernotes/view/{id}', [HeadernotesController::class, 'show'])->name('admin.headernotes.view');
        Route::resource('admin/headernotes', 'HeadernotesController');

        Route::get('/gst', [GstController::class, 'index'])->name('admin.gst');
        Route::get('/gst/create', [GstController::class, 'create'])->name('admin.gst.create');
        Route::post('/gst/store', [GstController::class, 'store'])->name('admin.gst.store');
        Route::get('/gst/edit/{id}', [GstController::class, 'edit'])->name('admin.gst.edit');
        Route::post('/gst/update', [GstController::class, 'update'])->name('admin.gst.update');
        Route::get('/gst/delete/{id}', [GstController::class, 'destroy'])->name('admin.gst.delete');
        Route::get('/gst/view/{id}', [GstController::class, 'show'])->name('admin.gst.view');
        Route::resource('admin/gst', 'GstController');

        Route::get('/reviews', [ReviewsController::class, 'index'])->name('admin.reviews');
        Route::get('/reviews/action/{id}', [ReviewsController::class, 'action'])->name('admin.action');
        Route::get('/newsletter', [NewslettersController::class, 'index'])->name('admin.newsletter');
        Route::get('/company', [CompanyController::class, 'index'])->name('admin.company');
        Route::get('/company/edit/{id}', [CompanyController::class, 'edit'])->name('admin.company.edit');
        Route::post('/company/update', [CompanyController::class, 'update'])->name('admin.company.update');
        Route::resource('admin/company', 'CompanyController');
        Route::get('/missingpayments', [MissingPaymentsController::class, 'index'])->name('admin.missingpayments');
        Route::get('/missingpayments/convert/{id}', [MissingPaymentsController::class, 'convert'])->name('admin.missingpayments.convert');
        Route::get('/suggestion', [SuggestionsController::class, 'index'])->name('admin.suggestion');
        Route::get('/suggestion/{id}', [SuggestionsController::class, 'view'])->name('admin.suggestion.view');
        Route::get('/suggestion/delete/{id}', [SuggestionsController::class, 'destroy'])->name('admin.suggestion.delete');

        Route::get('/orders', [OrdersController::class, 'index'])->name('admin.orders');
        Route::get('/orders/create', [OrdersController::class, 'create'])->name('admin.orders.create');
        Route::post('/orders/store', [OrdersController::class, 'store'])->name('admin.orders.store');
        Route::get('/orders/edit/{id}', [OrdersController::class, 'edit'])->name('admin.orders.edit');
        Route::post('/orders/update', [OrdersController::class, 'update'])->name('admin.orders.update');
        Route::get('/orders/delete/{id}', [OrdersController::class, 'destroy'])->name('admin.orders.delete');
        Route::get('/orders/view/{id}', [OrdersController::class, 'show'])->name('admin.orders.view');
        Route::get('/orders/viewinvoice/{id}', [OrdersController::class, 'viewInvoice'])->name('admin.viewinvoice');
        Route::get('/orders/details/{id}', [OrdersController::class, 'details'])->name('admin.details');
        Route::get('/orders/invoice/{id}', [OrdersController::class, 'downloadInvoice'])->name('admin.invoice');
        Route::post('/orders/updatecodstatus', [OrdersController::class, 'updatecodstatus'])->name('admin.orders.updatecodstatus');
        Route::post('/orders/updateprogress', [OrdersController::class, 'updateprogress'])->name('admin.orders.updateprogress');
        Route::get('/orders/createpackageorder/{id}', [OrdersController::class, 'create_package_order'])->name('admin.createpackageorder');
        Route::get('/orders/generatepacakgeslips/{id}', [OrdersController::class, 'generate_pacakge_slips'])->name('admin.generatepacakgeslips');
        Route::get('/orders/generateproductlabels/{id}', [OrdersController::class, 'generate_product_labels'])->name('admin.generateproductlabels');
        Route::post('/orders/updatereturnstatus', [OrdersController::class, 'updatereturnstatus'])->name('admin.orders.updatereturnstatus'); //added on 30-06-2022
        Route::get('/orders/cancelorder/{id}', [OrdersController::class, 'cancelorder'])->name('admin.cancelorder'); //01-07-2022
        Route::post('/orders/cancelorderstatus', [OrdersController::class, 'cancelorderstatus'])->name('admin.orders.cancelorderstatus'); //added on 01-07-2022
        Route::get('/orders/delhiverylist', [OrdersController::class, 'delhivery_list'])->name('admin.orders.delhiverylist'); //delhivery list//02-09-2022
        Route::resource('admin/orders', 'OrdersController');

        Route::get('/codmanagement', [CodmanagementController::class, 'index'])->name('admin.codmanagement');
        Route::get('/codmanagement/create', [CodmanagementController::class, 'create'])->name('admin.codmanagement.create');
        Route::post('/codmanagement/store', [CodmanagementController::class, 'store'])->name('admin.codmanagement.store');
        Route::get('/codmanagement/edit/{id}', [CodmanagementController::class, 'edit'])->name('admin.codmanagement.edit');
        Route::post('/codmanagement/update', [CodmanagementController::class, 'update'])->name('admin.codmanagement.update');
        Route::get('/codmanagement/delete/{id}', [CodmanagementController::class, 'destroy'])->name('admin.codmanagement.delete');
        Route::get('/codmanagement/view/{id}', [CodmanagementController::class, 'show'])->name('admin.codmanagement.view');
        Route::resource('admin/codmanagement', 'CodmanagementController');

        Route::get('/orderreturnmanagement', [OrderreturnmanagementController::class, 'index'])->name('admin.orderreturnmanagement');
        Route::get('/orderreturnmanagement/create', [OrderreturnmanagementController::class, 'create'])->name('admin.orderreturnmanagement.create');
        Route::post('/orderreturnmanagement/store', [OrderreturnmanagementController::class, 'store'])->name('admin.orderreturnmanagement.store');
        Route::get('/orderreturnmanagement/edit/{id}', [OrderreturnmanagementController::class, 'edit'])->name('admin.orderreturnmanagement.edit');
        Route::post('/orderreturnmanagement/update', [OrderreturnmanagementController::class, 'update'])->name('admin.orderreturnmanagement.update');
        Route::get('/orderreturnmanagement/delete/{id}', [OrderreturnmanagementController::class, 'destroy'])->name('admin.orderreturnmanagement.delete');
        Route::get('/orderreturnmanagement/view/{id}', [OrderreturnmanagementController::class, 'show'])->name('admin.orderreturnmanagement.view');
        Route::resource('admin/orderreturnmanagement', 'OrderreturnmanagementController');

        Route::get('/report', [ReportsController::class, 'index'])->name('admin.reports');
        Route::get('/report/details', [ReportsController::class, 'details'])->name('admin.reports.details');
        Route::get('/report/orders/excel/{sdate}/{edate}', [ReportsController::class, 'orderExcel'])->name('admin.order.excel');
        Route::get('/report/users/excel/{sdate}/{edate}', [ReportsController::class, 'userExcel'])->name('admin.user.excel');
        Route::get('/report/payments/excel/{sdate}/{edate}', [ReportsController::class, 'paymentExcel'])->name('admin.payment.excel');

        Route::get('/externalusers', [ExternalusersController::class, 'index'])->name('admin.externalusers');
        Route::get('/externalusers/create', [ExternalusersController::class, 'create'])->name('admin.externalusers.create');
        Route::post('/externalusers/store', [ExternalusersController::class, 'store'])->name('admin.externalusers.store');
        Route::get('/externalusers/edit/{id}', [ExternalusersController::class, 'edit'])->name('admin.externalusers.edit');
        Route::post('/externalusers/update', [ExternalusersController::class, 'update'])->name('admin.externalusers.update');
        Route::get('/externalusers/delete/{id}', [ExternalusersController::class, 'destroy'])->name('admin.externalusers.delete');
        Route::get('/externalusers/view/{id}', [ExternalusersController::class, 'show'])->name('admin.externalusers.view');
        Route::resource('admin/externalusers', 'ExternalusersController');
        Route::get('/externalusers/editstatus/{id}', [ExternalusersController::class, 'editstatus'])->name('admin.externalusers.editstatus');
        Route::post('/externalusers/updatestatus', [ExternalusersController::class, 'updatestatus'])->name('admin.externalusers.updatestatus');

        Route::get('/specialdeals', [SpecialDealsController::class, 'index'])->name('admin.specialdeals');
        Route::get('/specialdeals/create', [SpecialDealsController::class, 'create'])->name('admin.specialdeals.create');
        Route::post('/specialdeals/store', [SpecialDealsController::class, 'store'])->name('admin.specialdeals.store');
        Route::get('/specialdeals/edit/{id}', [SpecialDealsController::class, 'edit'])->name('admin.specialdeals.edit');
        Route::post('/specialdeals/update', [SpecialDealsController::class, 'update'])->name('admin.footer.update');
        Route::get('/specialdeals/delete/{id}', [SpecialDealsController::class, 'destroy'])->name('admin.footer.delete');
        Route::post('/specialdeals/getproduct', [SpecialDealsController::class, 'getProduct'])->name('admin.footer.getProduct');
        Route::post('/specialdeals/getsubsubcategory', [SpecialDealsController::class, 'getsubsubcategory'])->name('admin.footer.getsubsubcategory');
        Route::post('/specialdeals/geteditsubsubcategory', [SpecialDealsController::class, 'geteditsubsubcategory'])->name('admin.footer.geteditsubsubcategory');
        Route::post('/products/updateprice', [ProductsController::class, 'updateprice'])->name('admin.products.updateprice');
        Route::get('/specialdeals/deals/{id}', [SpecialDealsController::class, 'deals'])->name('admin.specialdeals.deals');
        Route::resource('admin/specialdeals', 'SpecialDealsController');

        Route::get('/ordercancelmanagement', [OrdercancelmanagementController::class, 'index'])->name('admin.ordercancelmanagement');
        Route::get('/ordercancelmanagement/create', [OrdercancelmanagementController::class, 'create'])->name('admin.ordercancelmanagement.create');
        Route::post('/ordercancelmanagement/store', [OrdercancelmanagementController::class, 'store'])->name('admin.ordercancelmanagement.store');
        Route::get('/ordercancelmanagement/edit/{id}', [OrdercancelmanagementController::class, 'edit'])->name('admin.ordercancelmanagement.edit');
        Route::post('/ordercancelmanagement/update', [OrdercancelmanagementController::class, 'update'])->name('admin.ordercancelmanagement.update');
        Route::get('/ordercancelmanagement/delete/{id}', [OrdercancelmanagementController::class, 'destroy'])->name('admin.ordercancelmanagement.delete');
        Route::get('/ordercancelmanagement/view/{id}', [OrdercancelmanagementController::class, 'show'])->name('admin.ordercancelmanagement.view');
        Route::resource('admin/ordercancelmanagement', 'OrdercancelmanagementController');


        Route::get('/fakeordermanagement', [FakeordermanagementController::class, 'index'])->name('admin.fakeordermanagement');
        Route::get('/fakeordermanagement/create', [FakeordermanagementController::class, 'create'])->name('admin.fakeordermanagement.create');
        Route::post('/fakeordermanagement/store', [FakeordermanagementController::class, 'store'])->name('admin.fakeordermanagement.store');
        Route::get('/fakeordermanagement/edit/{id}', [FakeordermanagementController::class, 'edit'])->name('admin.fakeordermanagement.edit');
        Route::post('/fakeordermanagement/update', [FakeordermanagementController::class, 'update'])->name('admin.fakeordermanagement.update');
        Route::get('/fakeordermanagement/delete/{id}', [FakeordermanagementController::class, 'destroy'])->name('admin.fakeordermanagement.delete');
        Route::get('/fakeordermanagement/view/{id}', [FakeordermanagementController::class, 'show'])->name('admin.fakeordermanagement.view');
        Route::resource('admin/fakeordermanagement', 'FakeordermanagementController');


        Route::get('/dailycodlimit', [DailycodlimitController::class, 'index'])->name('admin.dailycodlimit');
        Route::get('/dailycodlimit/create', [DailycodlimitController::class, 'create'])->name('admin.dailycodlimit.create');
        Route::post('/dailycodlimit/store', [DailycodlimitController::class, 'store'])->name('admin.dailycodlimit.store');
        Route::get('/dailycodlimit/edit/{id}', [DailycodlimitController::class, 'edit'])->name('admin.dailycodlimit.edit');
        Route::post('/dailycodlimit/update', [DailycodlimitController::class, 'update'])->name('admin.dailycodlimit.update');
        Route::get('/dailycodlimit/delete/{id}', [DailycodlimitController::class, 'destroy'])->name('admin.dailycodlimit.delete');
        Route::get('/dailycodlimit/view/{id}', [DailycodlimitController::class, 'show'])->name('admin.dailycodlimit.view');
        Route::resource('admin/dailycodlimit', 'DailycodlimitController');

        Route::get('/metamanage', [MetamanageController::class, 'index'])->name('admin.metamanage');
        Route::get('/metamanage/create', [MetamanageController::class, 'create'])->name('admin.metamanage.create');
        Route::post('/metamanage/store', [MetamanageController::class, 'store'])->name('admin.metamanage.store');
        Route::get('/metamanage/edit/{id}', [MetamanageController::class, 'edit'])->name('admin.metamanage.edit');
        Route::post('/metamanage/update', [MetamanageController::class, 'update'])->name('admin.metamanage.update');
        Route::get('/metamanage/delete/{id}', [MetamanageController::class, 'destroy'])->name('admin.metamanage.delete');
        Route::get('/metamanage/view/{id}', [MetamanageController::class, 'show'])->name('admin.metamanage.view');
        Route::resource('admin/metamanage', 'MetamanageController');





        Route::get('/shippingchargesmanagement', [ShippingchargesmanagementController::class, 'index'])->name('admin.shippingchargesmanagement');
        Route::get('/shippingchargesmanagement/create', [ShippingchargesmanagementController::class, 'create'])->name('admin.shippingchargesmanagement.create');
        Route::post('/shippingchargesmanagement/store', [ShippingchargesmanagementController::class, 'store'])->name('admin.shippingchargesmanagement.store');
        Route::get('/shippingchargesmanagement/edit/{id}', [ShippingchargesmanagementController::class, 'edit'])->name('admin.shippingchargesmanagement.edit');
        Route::post('/shippingchargesmanagement/update', [ShippingchargesmanagementController::class, 'update'])->name('admin.shippingchargesmanagement.update');
        Route::get('/shippingchargesmanagement/delete/{id}', [ShippingchargesmanagementController::class, 'destroy'])->name('admin.shippingchargesmanagement.delete');
        Route::get('/shippingchargesmanagement/view/{id}', [ShippingchargesmanagementController::class, 'show'])->name('admin.shippingchargesmanagement.view');
        Route::resource('admin/shippingchargesmanagement', 'ShippingchargesmanagementController');

        Route::get('/orderdeliverymanagement', [OrderdeliverymanagementController::class, 'index'])->name('admin.orderdeliverymanagement');
        Route::get('/orderdeliverymanagement/create', [OrderdeliverymanagementController::class, 'create'])->name('admin.orderdeliverymanagement.create');
        Route::post('/orderdeliverymanagement/store', [OrderdeliverymanagementController::class, 'store'])->name('admin.orderdeliverymanagement.store');
        Route::get('/orderdeliverymanagement/edit/{id}', [OrderdeliverymanagementController::class, 'edit'])->name('admin.orderdeliverymanagement.edit');
        Route::post('/orderdeliverymanagement/update', [OrderdeliverymanagementController::class, 'update'])->name('admin.orderdeliverymanagement.update');
        Route::get('/orderdeliverymanagement/delete/{id}', [OrderdeliverymanagementController::class, 'destroy'])->name('admin.orderdeliverymanagement.delete');
        Route::get('/orderdeliverymanagement/view/{id}', [OrderdeliverymanagementController::class, 'show'])->name('admin.orderdeliverymanagement.view');
        Route::resource('admin/orderdeliverymanagement', 'OrderdeliverymanagementController');

        Route::get('/materials', [MaterialsController::class, 'index'])->name('admin.materials');
        Route::get('/materials/create', [MaterialsController::class, 'create'])->name('admin.materials.create');
        Route::post('/materials/store', [MaterialsController::class, 'store'])->name('admin.materials.store');
        Route::get('/materials/edit/{id}', [MaterialsController::class, 'edit'])->name('admin.materials.edit');
        Route::post('/materials/update', [MaterialsController::class, 'update'])->name('admin.materials.update');
        Route::get('/materials/delete/{id}', [MaterialsController::class, 'destroy'])->name('admin.materials.delete');
        Route::get('/materials/view/{id}', [MaterialsController::class, 'show'])->name('admin.materials.view');
        Route::resource('admin/materials', 'MaterialsController');

        Route::get('/hsncodes', [HsncodesController::class, 'index'])->name('admin.hsncodes');
        Route::get('/hsncodes/create', [HsncodesController::class, 'create'])->name('admin.hsncodes.create');
        Route::post('/hsncodes/store', [HsncodesController::class, 'store'])->name('admin.hsncodes.store');
        Route::get('/hsncodes/edit/{id}', [HsncodesController::class, 'edit'])->name('admin.hsncodes.edit');
        Route::post('/hsncodes/update', [HsncodesController::class, 'update'])->name('admin.hsncodes.update');
        Route::get('/hsncodes/delete/{id}', [HsncodesController::class, 'destroy'])->name('admin.hsncodes.delete');
        Route::get('/hsncodes/view/{id}', [HsncodesController::class, 'show'])->name('admin.hsncodes.view');
        Route::resource('admin/hsncodes', 'HsncodesController');

        Route::get('/ordercancelreasons', [OrdercancelreasonsController::class, 'index'])->name('admin.ordercancelreasons');
        Route::get('/ordercancelreasons/create', [OrdercancelreasonsController::class, 'create'])->name('admin.ordercancelreasons.create');
        Route::post('/ordercancelreasons/store', [OrdercancelreasonsController::class, 'store'])->name('admin.ordercancelreasons.store');
        Route::get('/ordercancelreasons/edit/{id}', [OrdercancelreasonsController::class, 'edit'])->name('admin.ordercancelreasons.edit');
        Route::post('/ordercancelreasons/update', [OrdercancelreasonsController::class, 'update'])->name('admin.ordercancelreasons.update');
        Route::get('/ordercancelreasons/delete/{id}', [OrdercancelreasonsController::class, 'destroy'])->name('admin.ordercancelreasons.delete');
        Route::get('/ordercancelreasons/view/{id}', [OrdercancelreasonsController::class, 'show'])->name('admin.ordercancelreasons.view');
        Route::resource('admin/ordercancelreasons', 'OrdercancelreasonsController');

        Route::get('/orderreturnreasons', [OrderreturnreasonsController::class, 'index'])->name('admin.orderreturnreasons');
        Route::get('/orderreturnreasons/create', [OrderreturnreasonsController::class, 'create'])->name('admin.orderreturnreasons.create');
        Route::post('/orderreturnreasons/store', [OrderreturnreasonsController::class, 'store'])->name('admin.orderreturnreasons.store');
        Route::get('/orderreturnreasons/edit/{id}', [OrderreturnreasonsController::class, 'edit'])->name('admin.orderreturnreasons.edit');
        Route::post('/orderreturnreasons/update', [OrderreturnreasonsController::class, 'update'])->name('admin.orderreturnreasons.update');
        Route::get('/orderreturnreasons/delete/{id}', [OrderreturnreasonsController::class, 'destroy'])->name('admin.orderreturnreasons.delete');
        Route::get('/orderreturnreasons/view/{id}', [OrderreturnreasonsController::class, 'show'])->name('admin.orderreturnreasons.view');
        Route::resource('admin/orderreturnreasons', 'OrderreturnreasonsController');

        Route::get('/frontendimages', [FrontendImagesController::class, 'index'])->name('admin.frontendimages');
        Route::get('/frontendimages/edit/{id}', [FrontendImagesController::class, 'edit'])->name('admin.frontendimages.edit');
        Route::post('/frontendimages/update', [FrontendImagesController::class, 'update'])->name('admin.frontendimages.update');
        Route::resource('admin/frontendimages', 'FrontendImagesController');

        Route::get('/hotoffers', [HotoffersController::class, 'index'])->name('admin.hotoffers');
        Route::get('/hotoffers/create', [HotoffersController::class, 'create'])->name('admin.hotoffers.create');
        Route::post('/hotoffers/store', [HotoffersController::class, 'store'])->name('admin.hotoffers.store');
        Route::get('/hotoffers/edit/{id}', [HotoffersController::class, 'edit'])->name('admin.hotoffers.edit');
        Route::post('/hotoffers/update', [HotoffersController::class, 'update'])->name('admin.hotoffers.update');
        Route::get('/hotoffers/delete/{id}', [HotoffersController::class, 'destroy'])->name('admin.hotoffers.delete');
        Route::resource('admin/hotoffers', 'HotoffersController');

        //Download App
        Route::get('/downloadapp', [DownloadappsController::class, 'index'])->name('admin.downloadapp');
        Route::get('/downloadapp/create', [DownloadappsController::class, 'create'])->name('admin.downloadapp.create');
        Route::post('/downloadapp/store', [DownloadappsController::class, 'store'])->name('admin.downloadapp.store');
        Route::get('/downloadapp/edit/{id}', [DownloadappsController::class, 'edit'])->name('admin.downloadapp.edit');
        Route::post('/downloadapp/update', [DownloadappsController::class, 'update'])->name('admin.downloadapp.update');
        Route::resource('admin/downloadapp', 'DownloadappsController');

        Route::get('/loginmanagement', [LoginmanagementController::class, 'index'])->name('admin.loginmanagement');
        Route::get('/loginmanagement/create', [LoginmanagementController::class, 'create'])->name('admin.loginmanagement.create');
        Route::post('/loginmanagement/store', [LoginmanagementController::class, 'store'])->name('admin.loginmanagement.store');
        Route::get('/loginmanagement/edit/{id}', [LoginmanagementController::class, 'edit'])->name('admin.loginmanagement.edit');
        Route::post('/loginmanagement/update', [LoginmanagementController::class, 'update'])->name('admin.loginmanagement.update');
        Route::get('/loginmanagement/delete/{id}', [LoginmanagementController::class, 'destroy'])->name('admin.loginmanagement.delete');
        Route::get('/loginmanagement/view/{id}', [LoginmanagementController::class, 'show'])->name('admin.loginmanagement.view');
        Route::resource('admin/loginmanagement', 'LoginmanagementController');

        Route::get('/sitemanagement/up', [SitemanagementController::class, 'up'])->name('admin.sitemanagement.up'); //07-07-2022
        Route::get('/sitemanagement/down', [SitemanagementController::class, 'down'])->name('admin.sitemanagement.down'); //07-07-2022

        Route::get('/custompagetitles', [CustompagetitlesController::class, 'index'])->name('admin.custompagetitles');
        Route::get('/custompagetitles/create', [CustompagetitlesController::class, 'create'])->name('admin.custompagetitles.create');
        Route::post('/custompagetitles/store', [CustompagetitlesController::class, 'store'])->name('admin.custompagetitles.store');
        Route::get('/custompagetitles/edit/{id}', [CustompagetitlesController::class, 'edit'])->name('admin.custompagetitles.edit');
        Route::post('/custompagetitles/update', [CustompagetitlesController::class, 'update'])->name('admin.custompagetitles.update');
        Route::get('/custompagetitles/delete/{id}', [CustompagetitlesController::class, 'destroy'])->name('admin.custompagetitles.delete');
        Route::get('/custompagetitles/view/{id}', [CustompagetitlesController::class, 'show'])->name('admin.custompagetitles.view');
        Route::resource('admin/custompagetitles', 'CustompagetitlesController');

        Route::get('/trafficsource', [TrafficsourceController::class, 'index'])->name('admin.trafficsource');


        Route::get('/paymentmode', [PaymentModeController::class, 'index'])->name('admin.paymentmode');
        Route::get('/paymentmode/create', [PaymentModeController::class, 'create'])->name('admin.paymentmode.create');
        Route::post('/paymentmode/store', [PaymentModeController::class, 'store'])->name('admin.paymentmode.store');
        Route::get('/paymentmode/edit/{id}', [PaymentModeController::class, 'edit'])->name('admin.paymentmode.edit');
        Route::post('/paymentmode/update', [PaymentModeController::class, 'update'])->name('admin.paymentmode.update');
        Route::get('/paymentmode/delete/{id}', [PaymentModeController::class, 'destroy'])->name('admin.paymentmode.delete');
        Route::get('/paymentmode/view/{id}', [PaymentModeController::class, 'show'])->name('admin.paymentmode.view');
        
        Route::get('/newsletter/delete/{id}', [NewslettersController::class, 'delete'])->name('admin.newsletter.delete');
    });
});


route::get('/view-page/{cms_slug}',[HomeController::class, 'viewPages'])->name('viewPage');

require __DIR__.'/auth.php';
