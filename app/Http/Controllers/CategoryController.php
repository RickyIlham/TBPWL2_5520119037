<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\categories;
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
     public function categories()
    {
        $user = Auth::user();
        $categories = Categories::all();
        return view('categories', compact('user', 'categories'));
    }

    public function submit_categories(Request $req)
    {
        $cate = new categories;

        $cate->name = $req->get('name');
        $cate->description = $req->get('description');

        $cate->save();

        $notification = array(
            'message' => 'Data Categories berhasil ditambahkan',
            'alert-type' => 'succes'
        );

        return redirect()->route('admin.categories')->with($notification);
    }

    // AJAX PROCESS CATEGORIES
    public function getDataCategories($id)
    {
        $cate = Categories::find($id);

        return response()->json($cate);
    }

    public function update_categories(Request $req)
    {
        $cate = Categories::find($req->get('id'));

        $cate->name = $req->get('name');
        $cate->description = $req->get('description');

        $cate->save();

        $notification = array(
            'message' => 'Data Categories berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.categories')->with($notification);
    }

    public function delete_categories(Request $req)
    {
        $cate = Categories::find($req->get('id'));

        $cate->delete();

        $notification = array(
            'message' => 'Data Buku Berhasil Dihapus',
            'alert-type' => 'succes'
        );

        return redirect()->route('admin.categories')->with($notification);
    }
}