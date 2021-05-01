<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\brands;
use App\Categories;
use App\product;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $productsco = Product::count();
        $categoriesco = Categories::count();
        $brandsco = brands::count();
        $usersco = User::count();
        $products = Product::all();
        $categories = Categories::all();
        $brands= brands::all();
        $users = User::all();
        return view('admin.index',compact('productsco','brandsco','categoriesco','usersco', 'products', 'brands', 'categories', 'users'));
    }
}