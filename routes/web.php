<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

	Route::resource('/projects', 'ProjectController');
    Route::get('/projects/{project}/{version}', 'ProjectController@show')->name('projects.show.ver');
	Route::get('/projects/active/{project}', 'ProjectController@active')->name('projects.active');
	Route::get('/projects/deactive/{project}', 'ProjectController@deactive')->name('projects.deactive');
	Route::get('/projects/reportRoute/{project}/{version}', 'ProjectController@reportRoute')->name('projects.reportRoute');
	Route::get('/projects/downloadPdfRoute/{project}/{version}', 'ProjectController@downloadPdfRoute')->name('projects.downloadPdfRoute');

	Route::resource('/versions', 'VersionController');
    Route::post('/version/show/select', 'VersionController@showSelect')->name('versions.show.select');
    Route::get('/version/{project}', 'VersionController@index')->name('versions.index.pro');

    Route::resource('/folders', 'FolderController');
    Route::get('/folder/{version}', 'FolderController@index')->name('folders.index.ver');
    Route::get('/folder/destroy/{folder}', 'FolderController@destroy')->name('folders.destroy.get');

	Route::resource('/routes', 'RouteController');
	Route::get('/route/{version}', 'RouteController@index')->name('routes.index.ver');
	Route::get('/route/details/{route}', 'RouteController@details')->name('routes.details.ver');
	Route::get('/routes/active/{route}', 'RouteController@active')->name('routes.active');
	Route::get('/routes/deactive/{route}', 'RouteController@deactive')->name('routes.deactive');

	Route::resource('/headers', 'HeaderController');
	Route::get('/header/{route}', 'HeaderController@index')->name('headers.index.route');
	Route::get('/headers/active/{header}', 'HeaderController@active')->name('headers.active');
	Route::get('/headers/deactive/{header}', 'HeaderController@deactive')->name('headers.deactive');

	Route::resource('/requests', 'RequestController');
	Route::get('/request/{route}', 'RequestController@index')->name('requests.index.route');
	Route::get('/requests/active/{request}', 'RequestController@active')->name('requests.active');
	Route::get('/requests/deactive/{request}', 'RequestController@deactive')->name('requests.deactive');

	Route::resource('/responses', 'ResponseController');
	Route::get('/responses/route/{route}', 'ResponseController@index')->name('responses.index.route');
	Route::get('/responses/active/{response}', 'ResponseController@active')->name('responses.active');
	Route::get('/responses/deactive/{response}', 'ResponseController@deactive')->name('responses.deactive');

	Route::resource('/comments', 'CommentController');
	Route::get('/comments/route/{route}', 'CommentController@index')->name('comments.index.route');
	Route::get('/comments/active/{comment}', 'CommentController@active')->name('comments.active');
	Route::get('/comments/deactive/{comment}', 'CommentController@deactive')->name('comments.deactive');

});


