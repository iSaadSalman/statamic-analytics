<?php
Route::get('/statamic-analytics', 'DashboardController@index')->name('statamic-analytics.index');

Route::get('/statamic-analytics/api/top-pages', 'Api\TopPagesController@fetch')->name('statamic-analytics.api.top-pages');

Route::get('/statamic-analytics/api/top-referrers', 'Api\TopReferrersController@fetch')->name('statamic-analytics.api.top-referrers');

Route::get('/statamic-analytics/api/top-browsers', 'Api\TopBrowsersController@fetch')->name('statamic-analytics.api.top-browsers');

Route::get('/statamic-analytics/api/top-countries', 'Api\TopCountriesController@fetch')->name('statamic-analytics.api.top-countries');

Route::get('/statamic-analytics/api/timeseries', 'Api\TimeseriesController@fetch' )->name('statamic-analytics.api.timeseries');


Route::get('/statamic-analytics/api/aggregates', 'Api\AggregatesController@fetch')->name('statamic-analytics.api.aggregates');