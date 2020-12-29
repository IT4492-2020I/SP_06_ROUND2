<?php
namespace Dung\User;
use Carbon\Laravel\ServiceProvider;
use Dung\Cart\Models\Cart;
use Dung\Product\Models\Product;
use Session;
class UserServiceProviders extends ServiceProvider{
    public function boot () {
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php");
        $this->loadViewsFrom(__DIR__ ."/views", 'user');
        $this->publishes([
            __DIR__.'/config/user.php' => config_path('user.php'),
        ]);
        $this->publishes([
            __DIR__.'/public' => public_path('user'),
        ], 'public');
        view()->composer(["user::layoutUser.header","user::User.cart"],function($view){
            if(Session("id_cart")){
                $id_Cart=Session::get('id_cart');
                $cart=(new Cart())->get_cart($id_Cart);
                $cartdetail=(new Cart())->get_order_detail($id_Cart);
                $product=[];
                $totalQty=0;
                $totalPrice=$cart[0]->total;
                foreach($cartdetail as $cart){
                    $p=Product::find($cart->product_id);
                    $totalQty+=$cart->quantity;
                    array_push($product,$p);
                }
                $view->with(["cart"=>$cart,"product_cart"=>$product,"totalPrice"=>$totalPrice,"totalQty"=>$totalQty]);
            }
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/user.php', 'user'
        );
    }
}

?>
