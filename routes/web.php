<?php

use App\Events\ProductLiked;
use Gloudemans\Shoppingcart\Facades\Cart;
use \App\Panier;
use App\Product;
use App\User;
use Doctrine\DBAL\Events;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Notification;
use TCG\Voyager\Facades\Voyager;


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
// Auth::routes();

// voyager route
// Auth::routes();
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::post('resend/verification-email', function (\Illuminate\Http\Request $request) {
    $user = User::where('email',$request->input('email'))->first();

    $user->sendEmailVerificationNotification();

    return;
})->middleware('throttle:6,1')->name('resend.email.verify');


Route::group(['prefix' => 'broadcasting'], function () {
    Broadcast::routes();
});

// 	// EXPORT CSV FROM DB
Route::get('/tasks/members', 'TaskController@exportCsv');
Route::get('/tasks/products', 'TaskController@exportCsvProducts');

//payment callback
Route::get('/payment/callback', 'Api\PaymentController@callback');
Route::post('/payment/callback', 'Api\PaymentController@callback');

Route::any('/{vue_capture}', function () {
    return view('layouts.app');
})->where('vue_capture', '(?!api).*$')
->where('vue_capture', '^(?!admin).*$')
->where('vue_capture', '^(?!broadcasting).*$')
->where('vue_capture', '^(?!laravel-websockets).*$')
->where('vue_capture', '^(?!tasks/members).*$')
->where('vue_capture', '^(?!tasks/products).*$')
->where('vue_capture', '^(?!payment/callback).*$')
->where('vue_capture', '^(?!notify).*$');


// Route::get('/notify', function (){
//     $product= Product::first();
//     $user= User::first();
//     // dd($user);
//     Broadcast(new ProductLiked($product, $user));
// });

// Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
// Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');
// Route::get('auth/facebook', 'Auth\FacebookController@redirectToFacebook');
// Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');


// Route::get('userslist', function(){
// 	return datatables()->of(\DB::table('users')->select('*'))
// 	->make(true);
// })->name('userslist');
// Route::get('notify/index', 'NotificationController@index');
// Route::get('/privacy', 'PrivacyController@index');

// Route::get('/', 'HomeController@index')->name('home');
// //route patisseries
// Route::get('/patisseries', 'CakeController@index')->name('cake.index');
// Route::get('/patisseries/achat', 'CakeController@store')->name('cake.store');
// Route::get('/patisseries/{name}', 'CakeController@show')->name('cake.show');
// Route::get('/category', 'CategoryController@index')->name('category.index');

// // FUTURE SIMPLE USER DASHBOARD MAKE CRUD
// Route::get('create_store', 'StoreController@index')->name('store.create');
// Route::resource('shop', 'ShopController');

// Route::get('/reservation', 'BilletController@index')->name('reservation.index');
// Route::get('/reservation/{name}', 'BilletController@show')->name('reservation.show');
// Route::post('/reservation/store', 'BilletController@store')->name('reservation.store');
// Route::post('/reservation/search', 'BilletController@search')->name('reservation.search');

// Route::patch('reservation/update', 'BilletController@update')->name('reservation.update');
// Route::get('empty', function(){

// 	if (auth()->user()) {
// 		# code...
// 		foreach (Cart::instance('default')->content() as $item) {
// 			Panier::where('user_id', auth()->user()->id)->where('product_id', $item->id)->delete();
// 		}
// 	}

// 	Cart::destroy();

// 	return redirect()->route('cart.index')->with('success_message', 'Vous avez retirer tous les produits de vôtre panier<br><br><a class="btn btn-primary" href="/category">Retour au shopping</a><br><br>');

// });

// Route::get('/cart', 'CartController@index')->name('cart.index');
// Route::post('/cart', 'CartController@store')->name('cart.store');
// Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
// Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
// Route::get('show/{product}', 'ShopController@show')->name('cart.show');
// Route::post('cart/switchToSaveForLater/{id}', 'CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');
// Route::delete('saveForLater/{id}', 'saveForLaterController@destroy')->name('saveForLater.destroy');
// Route::post('saveForLater/switchToSaveForLater/{id}', 'saveForLaterController@switchToCart')->name('saveForLater.switchToCart');
// Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
// Route::delete('/couponDestroy', 'CouponsController@destroy')->name('coupon.destroy');
// Route::get('/search', 'SearchController@search')->name('search.search');


// // route vers profile utilisateur

// Auth::routes(['verify' => true]);
// Route::middleware('auth')->group(function () {
// 	Route::post('addFavoris/{rowId}', 'CartController@switchToSaveForLater')->name('saveForLater');
// 	// Route::get('wishlist', function () {
// 	// 	return view('favoris');
// 	// });
// 	Route::get('/compte', 'UserController@edit')->name('users.edit');
// 	Route::patch('/compte', 'UserController@update')->name('users.update');
// 	Route::get('/mes-commmandes', 'OrdersController@index')->name('orders.index');
// 	Route::get('/mes-commmandes/{order}', 'OrdersController@show')->name('orders.show');
// 	Route::get('/plans', 'PlanController@index')->name('plans.index');
// 	Route::get('/plan/{plan}', 'PlanController@show')->name('plans.show');
// 	Route::post('/subscription', 'SubscriptionController@create')->name('subscription.create');
// 	Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
// 	Route::get('/callback/{provider}', 'SocialController@callback');
// 	Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
// 	Route::get('/guestCheckout', 'CheckoutController@index')->name('guestCheckout.index');
// 	Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
// 	Route::post('/confirmation', 'CheckoutController@confirmPayment')->name('confirmPayment');
// 	Route::post('/paypal-checkout', 'CheckoutController@paypalCheckout')->name('checkout.paypal');
// 	Route::post('/momo-paiement', 'CheckoutController@momoPay')->name('checkout.momoPay');
// 	Route::post('addFavoris/{rowId}', 'CartController@switchToSaveForLater')->name('saveForLater');

// 	Route::put('/products/{id}/like', 'ProductsLikesController@store');
// 	Route::delete('/products/{id}/like', 'ProductsLikesController@destroy');
	
// 	// voyager route
// 	Route::group(['prefix' => 'admin'], function () {
// 		Voyager::routes();
// 	});
	
// 	// EXPORT CSV FROM DB
// 	Route::get('/tasks/members', 'TaskController@exportCsv');
// 	Route::get('/tasks/products', 'TaskController@exportCsvProducts');

// 	// folowing route
// 	Route::get('profile/{profileId}/follow', 'ProfileController@followUser')->name('user.follow');
// 	Route::post('/{profileId}/unfollow', 'ProfileController@unFollowUser')->name('user.unfollow');


// 	//SEND SMS
// 	Route::get('/verify/otp', 'WirepickController@show')->name('wirepick');

// 	Route::post('/otp/verify/phone', 'WirepickController@verify')->name('otp.verify');

// 	Route::get('/delivery', function () {
// 		return view('orderDeliver');
// 	});
// 	Route::get('/diffusion', 'ContactController@index');
// 	Route::patch('/delivery/{product}', 'OrdersController@update')->name('order.update');

// });


// Route::get('/store', function () {
// 	return view('shop.show');
// });


// // thank you page
// Route::get('/merci', function(){
// 	return view('merci')->with('success_message', 'Merci d\'avoir passé votre commande chez nous, votre commande à bien été accepter!');
// });

// // Page de reglement et de politique 
// Route::get('/contact', function () {
// 	return view('contact');
// });

// Route::get('/reglement', function () {
// 	return view('reglement');
// });

// Route::get('/aide', function () {
// 	return view('aide');
// });

// Route::get('/about', function () {
// 	return view('about');
// });

// Route::get('/vendre', function () {
// 	return view('vendre');
// });

// Route::get('/adminSignUp', function () {
// 	return view('auth/admin/register');
// });

// Route::post('create/store', 'ProfileController@store')->name('store.register');

// // Route qui permet de connaître la langue active
// Route::get('locale', 'LocalizationController@getLang')->name('getlang');

// // Route qui permet de modifier la langue
// Route::get('locale/{lang}', 'LocalizationController@setLang')->name('setlang');

// Route::get('/{slug}', 'StoreController@show')->name('store.show');

// Route::get('contact-us', 'ContactController@getContact');
// Route::post('contact-us', 'ContactController@saveContact');

//  Route::post('notifications', 'ContactController@sendNotification');


