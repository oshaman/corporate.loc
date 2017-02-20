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

Route::resource('/','IndexController',[
									'only' =>['index'],
									'names' => [
										'index'=>'home'
									]
									]);								

Route::resource('portfolios','PortfolioController',[
													
													'parameters' => [
													
														'portfolios' => 'alias'
													
													]
													
													]);

Route::resource('articles','ArticlesController',[
												'names' =>
                                                    [
                                                        'index' => 'articless.index',
                                                        'show' => 'articless.show'
                                                    
                                                    ],
												'parameters'=>[
												
													'articles' => 'alias'
												
												]
												
												]);	
Route::get('articles/cat/{cat_alias?}',['uses'=>'ArticlesController@index','as'=>'articlesCat'])->where('cat_alias','[\w-]+');   


Route::resource('comment','CommentController',['only'=>['store']]);

Route::match(['get','post'],'/contacts',['uses'=>'ContactsController@index','as'=>'contacts']);

//php artisan make:auth
Route::get('login',['uses'=>'Auth\AuthController@showLoginForm', 'as' => 'login']);

Route::post('login','Auth\AuthController@login');

Route::get('logout',['uses' => 'Auth\AuthController@logout', 'as' => 'logout']);
//admin
Route::group(['prefix' => 'admin','middleware'=> 'auth'],function() {
	
	//admin
	Route::get('/',['uses' => 'Admin\IndexController@index','as' => 'adminIndex']);
	
	Route::resource('articles','Admin\ArticlesController');
    Route::resource('/permissions','Admin\PermissionsController');
    Route::resource('/menus','Admin\MenusController');
    Route::resource('/users','Admin\UsersController');
	
}); 

																						
                                                    
/* Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index'); */
