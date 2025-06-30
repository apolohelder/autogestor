<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller{
    public function index() {
        $users = User::all(); 
        return view('auth.dashboard', [
            'userCount' => User::count(),
            'categoriesCount' => Category::count(),
            'productsCount' => Product::count(),
            'brandsCount' => Brand::count(),
        ]);
    }
}
