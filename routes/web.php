<?php

use App\Jobs\sendEmail;
use App\Models\User;
use App\Services\Storage\Contracts\StorageInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace'=>'FrontEnd' , 'as'=>'web.'],function (){
    Route::get('/','ProductsController@index')->name('products.index');
    Route::get('/basket','BasketController@index')->name('basket.index');
    Route::get('/basket/add/{product}','BasketController@add')->name('basket.add');
    Route::post('/basket/update/{product}','BasketController@update')->name('basket.update');
    Route::get('/basket/checkout','BasketController@checkoutForm')->name('basket.checkout.form');
    Route::post('basket/checkout', 'BasketController@checkout')->name('basket.checkout');



    Route::get('/basket/clear',function (){
        $session =resolve(StorageInterface::class);
        $session->clear();
    });
});


/*Route::get('/sss', function () {
$notification  = resolve(\App\Services\Notifications\Notification::class);*/
    // sendEmail::dispatch(User::find(1),new \App\Mail\UserRegister );
 //$notification->sendTelegram(User::find(1),new \App\Mail\UserRegister );
   /* $notification->sendSms(User::find(1),'hello');
});*/



Route::group(['prefix'=>'auth','namespace'=>'Auth'],function (){
    Route::get('register','RegisterController@showRegistrationForm')->name('auth.register.form');
    Route::post('register','RegisterController@register')->name('auth.register');
    Route::get('login','LoginController@showLoginForm')->name('auth.login.form');
    Route::post('login','LoginController@login')->name('auth.login');
    Route::get('logout','LoginController@logout')->name('auth.logout');
    Route::get('email/send-verification','VerificationController@send')->name('auth.email.send.verification');
    Route::get('email/verify','VerificationController@verify')->name('auth.email.verify');
    Route::get('password/forget','ForgotPasswordController@showForgetForm')->name('auth.password.forget.form');
    Route::post('password/forget','ForgotPasswordController@sendResetLink')->name('auth.password.forget');
    Route::get('password/reset','ResetPasswordController@showResetForm')->name('auth.password.reset.form');
});
/*Route::get('/auth/logout','Auth\LoginController@logout')->name('auth.logout');*/
/*Route::get('logout', function () {
    Auth::logout();
})->name('logout');*/



Route::group(['prefix'=>'ticket-admin'],function (){
    Route::get('register','TicketAdminController@showRegistrationForm')->name('admin.register.form');
    Route::post('register','TicketAdminController@register')->name('admin.register');

    Route::get('login','TicketAdminController@showLoginForm')->name('admin.login.form');
    Route::post('login','TicketAdminController@login')->name('admin.login');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'tickets'],function (){
    Route::get('/', 'TicketController@index')->name('ticket.index');
    Route::get('new', 'TicketController@newTicket')->name('ticket.new');
    Route::post('create', 'TicketController@storeTicket')->name('ticket.create');
    Route::get('show/{ticket}', 'TicketController@showTicket')->name('ticket.show');
    Route::get('close/{ticket}','TicketController@closeTicket')->name('ticket.close');

    Route::post('reply/{ticket}', 'ReplyController@create')->name('ticket.reply');


});

