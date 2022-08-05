<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\FlashsaleController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\SearchController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Kalisso API v1
Route::group(['prefix' => 'v1'], function () {
    
    // Route::post('/', 'Api\HomeController@index');
    // [UserProfileController::class, 'show']

    // AUTHENTICATION
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::post('/check', [UserController::class, 'checkUser']);
    Route::post('/loginWithOtp', [UserController::class, 'loginWithOtp']);
    Route::post('/sendOtp', [UserController::class, 'sendOtp']);
    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/category', [CategoryController::class, 'index']);

    //PRODUCT CONTROLLER
    Route::post('general/getRelatedProduct', [ProductController::class, 'getRelatedProduct']); 
    Route::post('general/getReview', [ProductController::class, 'getReview']);
    Route::post('home/getHomeTrending', [ProductController::class, 'getHomeTrending']);
    Route::post('home/getLastSearch', [ProductController::class, 'getLastSearch']);
    Route::post('home/getLastSearchInfinite', [ProductController::class, 'getLastSearchInfinite']);
    Route::post('home/getRecomendedProduct', [ProductController::class, 'getRecomendedProduct']);
    Route::post('getProductInfo', [ProductController::class, 'getProductInfo']);


    //CATEGORY CONTROLLER
    Route::post('home/category/getCategory', [CategoryController::class, 'getCategory']);
    Route::post('home/category/getCategoryAllProduct', [CategoryController::class, 'getCategoryAllProduct']);
    Route::post('home/category/getCategoryBanner', [CategoryController::class, 'getCategoryBanner']);
    Route::post('home/category/getCategoryForYou', [CategoryController::class, 'getCategoryForYou']);
    Route::post('home/category/getCategoryTrendingProduct', [CategoryController::class, 'getCategoryTrendingProduct']);
    Route::post('home/category/getCategoryNewProduct', [CategoryController::class, 'getCategoryNewProduct']);

    //SEARCH CONTROLLER
    Route::post('home/search/getSearch', [SearchController::class, 'getSearch']);
    Route::post('home/search/getSearchProduct', [SearchController::class, 'getSearch']);
    Route::post('search/getSearchProduct', [SearchController::class, 'getSearch']);

    //COUPON CONTROLLER
    Route::post('home/getCoupon', [CouponController::class, 'getCoupon']);
    Route::post('home/getCouponDetail', [CouponController::class, 'getCouponDetail']);

    //FLASH SALE CONTROLLER
    Route::post('home/getFlashsale', [FlashSaleController::class, 'getFlashsale']);

    //BANNER CONTROLLER
    Route::get('home/getHomeBanner', [BannerController::class, 'getHomeBanner']);

    //HOME CONTROLLER
    Route::get('getCountries', [HomeController::class, 'getCountries']);

    //Store CONTROLLER
    Route::post('getStoreInfo', [StoreController::class, 'getStoreInfo']);
    Route::get('getAllStore', [StoreController::class, 'getAllStore']);
    Route::get('followStore', [StoreController::class, 'getAllStore']);
    Route::get('request/fetch/data/payment/getEpayData', [PaymentController::class, 'getEpayData']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        //USER CONTROLLER
        Route::get('/logout', [UserController::class, 'logout']);
        Route::get('/user', [UserController::class, 'getCurrentUser']);
        Route::post('account/user/manage/store', [UserController::class, 'getUserStore']);
        Route::post('account/user/update/profile', [UserController::class, 'updatePictureProfile']);
        Route::post('account/user/update/profile/global', [UserController::class,'update']);
        Route::post('account/user/product/addToLastSeen', [UserController::class,'addProductLastSeen']);
        Route::post('/account/user/save/search', [UserController::class, 'saveSearch']);
        Route::post('account/getLastSeen', [UserController::class, 'getLastSeen']);
        Route::post('account/getOrderList', [UserController::class, 'getOrderList']);
        //ADDRESS ZONE CONTROLLER 
        Route::post('account/user/addAddress', [UserController::class, 'addAddress']);
        Route::post('account/user/getDefaultAddress', [UserController::class, 'getDefaultAddress']);
        Route::post('account/user/editAddress', [UserController::class, 'editAddress']);
        Route::post('account/user/deleteAddress', [UserController::class, 'deleteAddress']);
        Route::post('account/user/setDefaultAddress', [UserController::class, 'setDefaultAddress']);
       
        //ORDER AND LAST SEEN  ZONE
        Route::post('account/user/set/new/order', [CheckoutController::class, 'store']);
       
        //SHOPPING CART CONTROLLER
        Route::post('shopping_cart/getShoppingCart', [CartController::class, 'getShoppingCart']);
        Route::post('account/cart/addToCart', [CartController::class, 'create']);
        Route::post('account/cart/update', [CartController::class, 'update']);
        Route::post('account/cart/delete', [CartController::class, 'destroy']);

        //WISHLIST ZONE CONTROLLER
        Route::post('account/user/addToWishList', [WishlistController::class, 'create']);
        Route::post('account/user/checkWishList', [WishlistController::class, 'check']);
        Route::post('account/user/removeFromWishList', [WishlistController::class, 'destroy']);

        //PRODUCT ZONE CONTROLLER
        Route::post('account/user/store/add-new-product', [ProductController::class, 'store']);
        Route::post('/account/user/new/product/review', [ProductController::class,'productReview']);
        Route::post('/store/product/update', [ProductController::class, 'update']);

        //WISHLIST CONTROLLER
        Route::post('wishlist/getWishlist', [WishlistController::class, 'getWishlist']);

        // /account/user/store/plan/subscription
        Route::post('/account/user/store/plan/subscription', [StoreController::class, 'checkoutPlanSubscription']);
        Route::post('create/new/store', [StoreController::class, 'createStore']);
    });
});