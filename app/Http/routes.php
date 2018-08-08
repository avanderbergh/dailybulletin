<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['web']], function() {
    Route::get('application', 'AnnouncementsController@index');
});

Route::group(['prefix'=>'api', 'middleware' => ['web']], function(){
    Route::get('announcements', 'AnnouncementsController@index');
    Route::get('announcements/grade/{id}', 'AnnouncementsController@index');
    Route::post('announcements', 'AnnouncementsController@store');
    Route::get('announcements/create', 'AnnouncementsController@create');
    Route::get('announcements/{id}/edit', 'AnnouncementsController@edit');
    Route::patch('announcements/{id}', 'AnnouncementsController@update');
    Route::delete('announcements/{id}', 'AnnouncementsController@destroy');
});

Route::get('cookie-preload', function(){
    $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Loading App...</title>
            </head>
            <body>
                <p>Loading application...</p>
                <script type="text/javascript">
                    self.close();
                </script>
            </body>
        </html>';
    $response = new Illuminate\Http\Response($html);
    $response->withCookie(cookie('name', 'value', 5));
    return $response;
});