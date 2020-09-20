<?php

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale',$locale);
    DB::table('site_settings')->update(['language'=>$locale]);
    Pharma::activities("Changes", "Language", "Change language to ".$locale);
    return redirect()->back();
});

Route::get('404', function () {
    return view('frontend.404');
})->name('404');

Route::get('/', 'front\FrontController@index')->name('home');