<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Product;
use Illuminate\Support\Facades\Auth;

use App\User;



class MainController extends Controller{

  public function home(){

        $products = Product::latest()->paginate(16);

        if (Auth::check()) {
            $isadmin = User::find(Auth::user()->id)->isadmin;
        }else {
            $isadmin = false;
        }



        return view('main.home', ['products'=> $products, 'isadmin' => $isadmin]);
    }
}
