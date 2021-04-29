<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::count();
        $categories = Category::count();
        $brands = Brand::count();
        return view('user.index',compact('products','brands','categories'));
    }
}
