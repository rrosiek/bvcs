<?php

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::resource('content', 'Content');
    Route::resource('events', 'Event');
    Route::resource('mail', 'Correspondence', ['only' => ['create', 'store']]);
    Route::resource('members', 'Member', ['except' => ['show']]);

    Route::get('content/{id}/mail', 'Correspondence@createNewsletter')->name('mail.newsletter');
    Route::post('content/{id}/mail', 'Correspondence@sendNewsletter')->name('mail.newsletter');

    Route::get('/', 'Content@index')->name('content');

});

Route::get('calendar/{year?}/{month?}', 'Calendar@index')->name('calendar');
Route::get('newsletter', 'Content@newsletter')->name('newsletter');
Route::get('{slug}/pdf', 'Pdf@show')->name('pdf');

Route::get('/', 'Content@news')->name('home');

Route::get('{slug}', function ($slug) {
    $content = \App\Content::where('slug', $slug)->first();

    if ($content) {
        $title = $content->title;

        return view('page', compact('title', 'content'));
    } else {
        return redirect('/');
    }
})->where(['slug' => '.*']);
