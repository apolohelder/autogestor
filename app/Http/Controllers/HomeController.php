<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller{
    public function index() {

        $products = Product::with('category')->inRandomOrder()->get();

        return view('home', compact('products'));
    }
}