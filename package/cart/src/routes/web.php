<?php

Route::group(['namespace' => "Dung\Cart\Http\Controller", 'middleware' => ['web', 'auth']], function(){
    Route::get("add_cart/{t}",["as"=>"add_cart","uses"=>"CartController@add_cart"])->middleware('login');
    Route::get("deletecart/{cart_id}/{id}",["as"=>"delete_cart","uses"=>"CartController@delete_cart"])->middleware('login');
    Route::get("cart/{t}",["as"=>"order","uses"=>"CartController@show_cart"])->middleware('login');
    Route::post("updatecart",["as"=>"updatecart","uses"=>"CartController@update_cart"]);
});

?>
