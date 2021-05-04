<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => [
        config('backpack.base.web_middleware', 'web'),
        config('backpack.base.middleware_key', 'admin'),
    ],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('tool', 'ToolCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('profile', 'ProfileCrudController');
    Route::crud('page', 'PageCrudController');

    Route::crud('submittedtutorial', 'SubmittedTutorialCrudController');
    Route::get('submittedtutorial/{id}/publish', 'SubmittedTutorialCrudController@publish');
    Route::crud('tutorial', 'TutorialCrudController');
    Route::crud('category', 'CategoryCrudController');
}); // this should be the absolute last line of this file