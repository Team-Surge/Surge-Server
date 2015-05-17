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

Route::get('/', 'MainController@index');

Route::get('/test', 'TestController@index');

Route::any('/auth', 'AuthController@process');

Route::any('/post', 'PostController@process');

Route::get('/data', 
function()
{
    return redirect('/data/tables');
}
);

Route::get('/data/tables', 'Data\TableController@index');
Route::post('/data/tables/{table?}', 'Data\TableController@process');

Route::resource(
'/data/users',
'Data\UserController',
['only' => ['index', 'destroy', 'show']]
);

Route::resource(
'/data/posts',
'Data\PostController',
['only' => ['index', 'destroy', 'show']]
);

Route::resource(
'/data/comments',
'Data\CommentController',
['only' => ['index', 'destroy', 'show']]
);
