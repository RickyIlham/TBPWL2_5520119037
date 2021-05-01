<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\brands;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
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
    public function brands()
    {
        $user = Auth::user();
        $brands = Brands::all();
        return view('brands', compact('user', 'brands'));
    }

    public function submit_brands(Request $req)
    {
        $br = new brands;

        $br->name = $req->get('name');
        $br->description = $req->get('description');

        $br->save();

        $notification = array(
            'message' => 'Data Categories berhasil ditambahkan',
            'alert-type' => 'succes'
        );

        return redirect()->route('admin.brands')->with($notification);
    }

    // AJAX PROCESS BRANDS
    public function getDataBrands($id)
    {
        $br = Brands::find($id);

        return response()->json($br);
    }

    public function update_brands(Request $req)
    {
        $br = Brands::find($req->get('id'));

        $br->name = $req->get('name');
        $br->description = $req->get('description');

        $br->save();

        $notification = array(
            'message' => 'Data Categories berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.brands')->with($notification);
    }

    public function delete_brands(Request $req)
    {
        $br = Brands::find($req->get('id'));

        $br->delete();

        $notification = array(
            'message' => 'Data Buku Berhasil Dihapus',
            'alert-type' => 'succes'
        );

        return redirect()->route('admin.brands')->with($notification);
    }
}