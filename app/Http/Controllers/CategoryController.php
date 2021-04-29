<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $categories = category::all();
        return view('category', compact('categories'));
    }

    public function submit_category(Request $req){
        $category = new Category;

        $category->name = $req->get('name');
        $category->description = $req->get('description');

        $category->save();

        $notification = array(
            'message' => 'Data Kategori berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('category')->with($notification);
    }


    // ajax prosess
    public function getDataCategory($id)
    {
        $category = Category::find($id);

        return response()->json($category);
    }

    // update category
    public function update_category(Request $req)
    {
        $category = Category::find($req->get('id'));

        $category->name = $req->get('name');
        $category->description = $req->get('description');

        $category->save();

        $notification = array(
            'message' => 'Data Kategori berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('category')->with($notification);
    }

    public function delete_category(Request $req)
    {
        $category = Category::find($req->get('id'));

        $category->delete();

        $notification = array(
            'message' => 'Data Kategori berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('category')->with($notification);
    }
}