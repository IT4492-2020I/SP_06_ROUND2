<?php

namespace Dung\Cart\Http\Controller;

use App\Http\Controllers\Controller;
use Dung\Cart\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductStoreRequest;
use Dung\Product\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Redirector;
use Session;

class CartController extends Controller
{
    protected Cart $cart;
    protected Product $product;
    public function __construct(Cart $cart, Product $product)
    {
        $this->cart = $cart;
        $this->product = $product;
    }

    public function add_cart(Request $request,$id)
    {
        if (Gate::allows('customer')) {
            $product = Product::find($id);
            $id_cart = Session("id_cart") ? session::get('id_cart') : null;
            $user_id = Auth::id();
            if ($id_cart == null) {
                $id_cart = $this->cart->add_new_cart($user_id, $product);
                $request->session()->put("id_cart", $id_cart);
            } else {
                $cart = $this->cart->add_cart($id_cart, $product);
            }
            return redirect()->back();
        } else {
            return redirect()->route('home');
        }
    }

    public function show_cart($cart_id){
        if (Gate::allows('customer')) {
            $cart=$this->cart->get_cart($cart_id);
            $cartdetail=$this->cart->get_order_detail($cart_id);
            $productcart=[];
            $totalQty=0;
            $totalPrice=$cart[0]->total;
            foreach($cartdetail as $cart){
                $p=Product::find($cart->product_id);
                $totalQty+=$cart->quantity;
                $p->quantity=$cart->quantity;
                array_push($productcart,$p);
                }
		    return view("cart::User.cart",compact("totalPrice","cartdetail","productcart","totalQty","cart_id"));
        } else {
            return redirect(route('home'));
        }
    }

    public function delete_cart(Request $request, $id_cart, $id)
    {
        $this->cart->remove_item($id_cart, $id);
        return redirect()->back();
    }

    public function update_cart(Request $request)
    {
        $cart_id = $request->cart_id;
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $result = $this->cart->up_cart($cart_id, $product_id, $quantity);
        return number_format($result,0 ,'.' ,'.');
    }
}
