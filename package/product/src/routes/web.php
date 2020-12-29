<?php

Route::group(['namespace' => "Dung\Product\Http\Controller", 'middleware' => ['web']], function(){
    Route::get("/home", "ProductController@list")->name("home");
    Route::get("productdetail/{t}",["as"=>"productdetail","uses"=>"ProductController@product_detail"]);
    Route::get("category/{t}",["as"=>"category","uses"=>"ProductController@products_by_category"]);
    Route::get("sreach",["as"=>"sreach","uses"=>"ProductController@search_product"]);
});
Route::group(['namespace' => "Dung\Product\Http\Controller", 'prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    //Product
    Route::resource('products', 'ProductController');
    Route::resource('categorys', 'CategoryController')->except(['edit', 'update']);

});

?>
