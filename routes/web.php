<?php

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


Route::get('/Login', 'UserController@login');

Route::post('/Login', 'UserController@loginPost');

Route::get('/Register', 'UserController@register');

Route::post('/Register', 'UserController@registerPost');

Route::get('/ConFirm/{token}', 'UserController@conFirm');

Route::get('/Logout', 'UserController@logOut');



Route::get('/SettingUser', 'UserController@settingUser');

Route::get('/ProductTypeManagement', 'ProductController@showProductType');

Route::post('/AddProductType', 'ProductController@addProductType');

Route::get('/DeleteProductType/{id}', 'ProductController@deleteProductType');

Route::get('/UserManagement', 'UserController@getAllUser');

Route::get('/ProductManagement', 'ProductController@showProductManagement');

Route::get('/CreateProduct', 'ProductController@createProduct');

Route::post('/CreateProduct', 'ProductController@createProductPost');

Route::get('/DeleteProduct/{id}', 'ProductController@deleteProduct');

Route::get('/EditProduct/{id}', 'ProductController@editProduct');

Route::post('/EditProduct/{id}', 'ProductController@editProductPost');

Route::get('/ProductByProductType/{id}', 'ProductController@productByProductType');

Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'UserController@home')->name('home');
    Route::get('/BuyProduct/{id}', 'ProductController@buyProduct');
});

Route::get('/CartPayment', 'ProductController@cartPayment');

Route::get('/AddProductSession/{id}', 'ProductController@addProductSession');

Route::get('/MinusProductSession/{id}', 'ProductController@minusProductSession');

Route::get('/RemoveProductSession/{id}', 'ProductController@removeProductSession');

Route::get('/Payment', 'PaymentController@payment');

Route::get('/CartPaymentManagement', 'PaymentController@showAllCartPayment');

Route::get('/DetailCartPaymentManagement/{id}', 'PaymentController@detailCartPaymentManagement');

Route::get('/CountAllAtHouse', 'PaymentController@CountHome');

Route::get('/NotificationTypeManagement', 'NotificationTypeController@notificationTypeManagement');

Route::post('/AddNotificationType', 'NotificationTypeController@addNotificationType');

Route::get('/DeleteNotificationType/{id}', 'NotificationTypeController@deleteNotificationType');

Route::get('/NotificationManagement', 'NotificationController@notificationManagement');

Route::get('/CreateNotification', 'NotificationController@createNotification');

Route::post('/CreateNotification', 'NotificationController@createNotificationPost');

Route::get('/DeleteNotification/{id}', 'NotificationController@deleteNotification');

Route::get('/EditNotification/{id}', 'NotificationController@editNotification');

Route::post('/EditNotification/{id}', 'NotificationController@editNotificationPost');

Route::get('/DetailNotification/{id}', 'NotificationController@DetailNotification');

Route::get('/Notification', 'NotificationController@getAllNotificationUser');

Route::get('/ShowNotification/{id}', 'NotificationController@showNotification');

Route::get('/NotificationByNotificationType/{id}', 'NotificationController@notificationByNotificationType');

Route::get('/SearchProduct', 'ProductController@searchProduct');

Route::get('/SearchNotification', 'NotificationController@searchNotification');