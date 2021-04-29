<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::count();
        $categories = Category::count();
        $brands = Brand::count();
        $users = User::count();
        return view('admin.index',compact('products','brands','categories','users'));
    }
}