<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShoppingCart;
use App\PayPal;
use App\Order;

class PaymentsController extends Controller
{
    public function __construct(){
        $this->middleware('shoppingcart');
    }

    public function store(Request $request){
        print($request->get('paymentId'));
        print($request->paymentId);
        print($request->input('paymentId'));
        $shopping_cart = $request->shopping_cart;

        $paypal = new Paypal($shopping_cart);

        $response = $paypal->execute($request->get('paymentId'), $request->PayerID);


        if ($response->state == "approved") {
            \Session::remove("shopping_cart_id");
            $order = Order::createFromPayPalResonse($response, $shopping_cart);
            $shopping_cart->approve();
        }



        return view("shopping_carts.completed", ["shopping_cart" => $shopping_cart, "order" => $order]);


    }
}
