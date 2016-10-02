<?php
	
	/**************
	** Login & Registeration 
	*/		
		Route::get('/', [
			'uses' => 'HomeController@getIndex',
			'as'   => 'home', 
		]);
		Route::get('/signup', [
			'uses' => 'AuthController@getSignup',
			'as'   => 'auth.signup',
			'middleware'=>['guest'],
		]);

		Route::post('/signup', [
			'uses' => 'AuthController@postSignup',
			'middleware'=>['guest'],
		]);
		// sign in
		Route::get('/signin', [
			'uses' => 'AuthController@getSignin',
			'as' => 'auth.signin',
			'middleware'=>['guest'],
		]);
		Route::post('/signin', [
			'uses' => 'AuthController@postSignin',
			'middleware'=>['guest'],
		]);

		Route::get('/signout', [
			'uses' => 'AuthController@getSignout',
			'as' => 'auth.signout',
		]);
	
	/****************
	** Posts 
	*/
		Route::group(['middleware'=> 'auth'], function(){
			Route::post('/status',[
				'uses' => 'PostController@postStatus',
				'as'=>'status.post',
			]);
			Route::post('/status/reply',[
				'uses' => 'PostController@postReply',
				'as'=>'status.reply',
			]);

		});
	
	/****************
	** Noty
	*/
		Route::post('/notify',  'NotyController@store');
		Route::put('/notify/{noty}', 'NotyController@update');
		
