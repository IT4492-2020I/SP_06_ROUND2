<?php

Route::group(['namespace' => "Dung\User\Http\Controller", 'middleware' => ['web', 'auth']], function(){
    Route::get("user/{t}",["as"=>"user","uses"=>"UserController@get_user"])->middleware('login');
    Route::post("changeinfo",["as"=>"changeinfo","uses"=>"UserController@change_info"])->middleware('login');

});
Route::group(['namespace' => "Dung\User\Http\Controller", 'prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    Route::get('/', 'UserController@index')->name('admin');
    Route::resource('users', 'UserController');
});

?>
