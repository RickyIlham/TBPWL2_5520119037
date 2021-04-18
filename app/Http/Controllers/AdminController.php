<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use PDF;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }

    public function submit_product(Request $req)
    {
        $product = new Product;

        $product->nama = $req->get('nama');
        $product->categories_id = $req->get('categories_id');
        $product->brands_id = $req->get('brands_id');
        $product->harga = $req->get('harga');
        $product->stok = $req->get('stok');

        if ($req->hasFile('foto')) {
            $extension = $req->file('foto')->extension();

            $filename = 'foto_barang' . time() . '.' . $extension;
            $req->file('foto')->storeAs(
                'public/foto_barang',
                $filename
            );

            $product->foto = $filename;
        }
        $product->save();

        $notification = array(
            'message' => 'Data buku berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.products')->with($notification);
    }

public function update_product(Request $req)
    {
        $product = Product::find($req->get('id'));

        $product->nama = $req->get('nama');
        $product->categories_id = $req->get('categories_id');
        $product->brands_id = $req->get('brands_id');
        $product->harga = $req->get('harga');
        $product->stok = $req->get('stok');

        if ($req->hasFile('foto')) {
            $extension = $req->file('foto')->extension();

            $filename = 'foto_barang' . time() . '.' . $extension;
            $req->file('foto')->storeAs(
                'public/foto_barang',
                $filename
            );
            Storage::delete('public/foto_barang/'.$req->get('old_foto'));

            $product->foto = $filename;
        }
        $product->save();

        $notification = array(
            'message' => 'Data Barang berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.products')->with($notification);
    }

    public function delete_book(Request $req)
    {
        $product = Product::find($req->get('id'));

        storage::delete('public/foto_barang/'.$req->get('old_foto'));

        $product->delete();

        $notification = array(
            'message' => 'Data Barang Berhasil Dihapus',
            'alert-type' => 'succes'
        );

        return redirect()->route('admin.products')->with($notification);
    }


    public function print_books(){
        $books = Book::all();

        $pdf = PDF::loadview('print_books', ['books' => $books]);
        return $pdf->download('data_buku.pdf');
    }

}
