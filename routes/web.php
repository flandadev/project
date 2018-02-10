<?php
// MAIN PAGE
use App\Event;

Route::get('/', 'PagesController@index')->name('home');

Route::get('/api/check', 'ActiveUserController@store');
Route::get('/api/stats', 'ActiveUserController@show');

// PAYMENTS
Route::get('checkout/{event_id}', 'PagesController@checkout')->name('checkout');
Route::post('charge/{event_id}', 'PaymentsController@store')->name('charge');

// Resources
Route::resource('admin/events', 'EventsController');
Route::resource('admin/users', 'AdminUsersController');
Route::resource('admin/customers', 'CustomersController');
Route::resource('admin/bus', 'BusLineController');

// REDIRECTIONS
Route::redirect('/admin/events/new', '/admin/events/create');
Route::redirect('admin/new', 'admin/users/create');

// AUTH
Route::get('admin', 'AdminController@index')->name('dashboard');

Route::get('admin/login', 'AdminController@login')->name('login');

Route::get('admin/forgot', 'AdminController@showForgot')->name('forgot');
Route::post('admin/forgot', 'AdminController@forgot');
Route::post('admin/authenticate', 'AdminController@authenticate');
Route::post('admin/register', 'AdminController@store');

Route::get('admin/reset', 'AdminController@showReset')->name('resetPassword');
Route::get('admin/reset/{user_id}', 'AdminController@checkReset');
Route::post('admin/reset', 'AdminController@reset');

Route::get('admin/logout', 'AdminController@logout')->name('signup');
Route::get('admin/settings', 'SettingsController@index')->name('settings');

Route::post('admin/settings/maintence', 'SettingsController@toggleMaintence');
// TICKETS
Route::get('admin/tickets', 'EventsController@tickets')->name('checkTickets');
Route::get('admin/tickets/{event_token}/{value}', 'EventsController@checkTicket');
Route::post('admin/tickets', 'EventsController@post_tickets');

// RESOURCE SAMPLE WITH EVENT
// get           path/to/the/resource                  -> index
// get           path/to/the/resource/create           -> create
// post          path/to/the/resource/                 -> store
// get           path/to/the/resource/{id}             -> show
// get           path/to/the/resource/{id}/edit        -> edit
// put/patch     path/to/the/resource/{id}             -> update
// delete        path/to/the/resource/{id}             -> destroy
