<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    //

    public function home() {
        return view('client.home');
    }

    public function shop() {

        
        $products = DB::table('products')
                    ->where('status', '1')
                    ->get();

        $manageProducts = view('client.shop')
                    ->with('products', $products);

        return view('layout.app')
                    ->with('client.shop', $manageProducts);
    }

    /*
    public function cart() {
        return view('client.cart');
    }
    */
    /*public function payment() {
        return view('client.payment');
    }
    */
}
