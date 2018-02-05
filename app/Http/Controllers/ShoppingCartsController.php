<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShoppingCart;
use App\InShoppingCart;
use App\PayPal;
use App\Order;

class ShoppingCartsController extends Controller
{
    public function __construct(){
        $this->middleware('shoppingcart');
    }

    public function show($id){
        $shopping_cart = ShoppingCart::where('customid', $id)->first();

        $order = $shopping_cart->order();

        return view("shopping_carts.completed", ["shopping_cart" => $shopping_cart, "order" => $order]);
    }

    public function index(Request $request){

        $shopping_cart = $request->shopping_cart;

        $inShoppingCart = InShoppingCart::where("shopping_cart_id", "=", $shopping_cart->id);

        $products = $shopping_cart->products()->get();

        $total = $shopping_cart->total();

        $inShoppingCarts = InShoppingCart::where("shopping_cart_id", "=", $shopping_cart->id);

        return view("shopping_carts.index", ["total" => $total, "inShoppingCarts" => $inShoppingCarts, "products" => $products]);
    }

    public function checkout(Request $request){
        $shopping_cart = $request->shopping_cart;

        $paypal = new Paypal($shopping_cart);

        $payment = $paypal->generate();

        return redirect($payment->getApprovalLink());
    }
}
