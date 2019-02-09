<?php

Route::group(['namespace' => 'JeroenG\Facilitator\Http\Controllers', 'middleware' => 'web', 'prefix' => 'facilitator', 'as' => 'facilitator::'], function () {
    Route::get('/hallo', function () {
        echo 'wereld';
    });

    Route::get('facilities', 'FacilityController@index')->name('index');
    Route::get('facilities/{facility}/{id}', 'FacilityController@show')->name('facilities.show');
    Route::get('facilities/{facility}/create', 'FacilityController@create')->name('facilities.create');
    Route::post('facilities/{facility}/store', 'FacilityController@store')->name('facilities.store');
    Route::get('facilities/{facility}/edit', 'FacilityController@edit')->name('facilities.edit');
    Route::put('facilities/{facility}/edit', 'FacilityController@update')->name('facilities.update');
});
