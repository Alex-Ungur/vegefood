<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function admin() {
        return view('admin.dashboard');
    }

    public function ajoutCategorie() {
        return view('admin.ajoutCategorie');
    }
    
    public function ajoutProduit() {
        return view('admin.ajoutProduit');
    }

    public function ajoutSlider() {
        return view('admin.ajoutSlider');
    }

    public function categories() {
        return view('admin.categories');
    }

    public function produits() {
        return view('admin.produits');
    }

    public function sliders() {
        return view('admin.sliders');
    }
}
