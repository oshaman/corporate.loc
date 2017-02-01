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
												
												'parametres'=>[
												
													'articles' => 'alias'
												
												]
												
												]);

Route::get('articles/cat/{cat_alias?}',['uses'=>'ArticleController@index','as'=>'articlesCat']);

                                                
                                                    
/* Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index'); */
