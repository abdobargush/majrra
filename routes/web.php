<?php

use Illuminate\Support\Facades\Route;

/*
 * Auth
 */
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/auth/{provider}', 'Auth\SocialAuthController@redirect')->name('socialAuth');
Route::get('/auth/{provider}/callback', 'Auth\SocialAuthController@callback');
Route::post('/auth/check', 'Auth\RegisterController@check');

/*
 * Home
 */
Route::get('', 'HomeController')->name('home');

/*
 *	Search
 */
Route::get('search', 'SearchController')->name('search');

/*
 *	Profile
 */
Route::get('@{username}', 'ProfileController@show')->name('profile');
Route::get('profile/edit', 'ProfileController@edit')->middleware('auth')->name('profile.edit');
Route::patch('profile/edit/{user}/info', 'ProfileController@updateInfo')->middleware('auth')->name('profile.updateInfo');
Route::patch('profile/edit/{user}/settings', 'ProfileController@updateSettings')->middleware('auth')->name('profile.updateSettings');
Route::patch('profile/edit/{user}/password', 'ProfileController@updatePassword')->middleware('auth')->name('profile.updatePassword');

/*
 * Tools
 */
Route::resource('tools', 'ToolController')->only([
    'index', 'show'
]);

/*
 * Tutorials
 */
Route::post('tutorials/{tutorial}/upvote', 'TutorialController@upvote')->name('tutorials.upvote');
Route::post('submit/check', 'SubmittedTutorialController@check');
Route::post('submit', 'SubmittedTutorialController@store')->name('tutorials.store');


/*
 * Bookmarks
 */
Route::get('bookmarks', 'BookmarkController@index')->name('bookmarks');
Route::post('bookmark/{tutorial}', 'BookmarkController@update')->name('bookmarks.update');

/*
 * Pages
 */
Route::get('pages/{page}', 'PageController')->name('page');