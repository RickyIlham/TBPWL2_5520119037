<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $products = Product::all();
        return view('product', compact('user', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $product = new Product;

        $product->nama = $req->get('nama');
        $product->categories_id = $req->get('categories_id');
        $product->brands_id = $req->get('brands_id');
        $product->harga = $req->get('harga');
        $product->stok = $req->get('stok');

        if ($req->hasFile('foto')) {
            $extension = $req->file('foto')->extension();

            $filename = 'cover_buku_'.time().'.'.$extension;

            $req->file('foto')->storeAs(
                'public/foto_barang', $filename
            );

            $product->foto = $filename;
        }

        $product->save();

        $notification = array(
            'message' => 'Data product berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.products')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function getDataPruduk($id)
    {
        $product = Product::find($id);

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        $product = Product::find($req->get('id'));

        $product->nama = $req->get('nama');
        $product->categories_id = $req->get('categories_id');
        $product->brands_id = $req->get('brands_id');
        $product->harga = $req->get('harga');
        $product->stok = $req->get('stok');

        if ($req->hasFile('foto')) {
            $extension = $req->file('foto')->extension();

            $filename = 'foto_barang_'.time().'.'.$extension;

            $req->file('foto')->storeAs(
                'public/foto_barang', $filename
            );

            Storage::delete('public/foto_barang/'.$req->get('old_foto'));

            $product->foto = $filename;
        }

        $product->save();

        $notification = array(
            'message' => 'Data product berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.products')->with($notification);

    }
    public function destroy(Request $req)
    {
        $product = Product::find($req->id);
        Storage::delete('public/foto_barang/'.$req->get('old_foto'));
        $product->delete();
     
        $notification = array(
            'message' => 'Data Barang berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.products')->with($notification);

    }
    

}
