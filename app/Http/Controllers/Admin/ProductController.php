<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products',compact('products','brands','categories'));
    }
    public function check(Request $request)
    {
        $data["product_id"] = $request->id;
        $data["user_id"] = $request->user_id;
        $data["type"] = $request->type;
        $data["check_in"] = $request->check_in;
        $data["check_out"] = $request->check_out;
        $data["description"] = $request->description;
        Attendance::create($data);
        return redirect(route('admin.products.index'))->with('success','Berhasil melakukan penambahan check in atau check out
        ');
    }
    public function show($id)
    {
        $products = Product::find($id);
        return view('admin.products.show',compact('products'));
    }
    public function edit($id)
    {
        $products = Product::find($id);
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.edit',compact('products','brands','categories'));
    }
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.create',compact('brands','categories'));
    }
    public function delete($id)
    {
        $products = Product::find($id)->delete();
        return redirect()->back()->with('success','Berhasil dihapus');
    }
    public function store(Request $request)
    {
        $products = new Product;
        $products->name = $request->get('name');
        $products->categories_id = $request->get('categories_id');
        $products->brands_id = $request->get('brands_id');
        
        $products->qty = $request->get('qty');
        
        if ($request->hasFile('photo')) {
            $extension = $request->file('photo')->extension();

            $filename = 'photo_barang_'.time().'.'.$extension;

            $request->file('photo')->storeAs(
                'public/photo_barang', $filename
            );

            $products->photo = $filename;
        }

        
        $products->save();
        return redirect(route('admin.products.index'))->with('success','Berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'unique:products,name,'.$request->id,
        ]);
        $products = Product::find($request->id);
        $data['name'] = $request->name;
        $data['qty'] = $request->qty;
        $data['brand_id'] = $request->brand_id;
        $data['category_id'] = $request->category_id;
        
        if($request->photo != null){
            $imgWillDelete = public_path() . '/images/'.$products->photo;
            File::delete($imgWillDelete);

            $photo = $request->file('photo');
            $size = $photo->getSize();
            $namePhoto = time() . "_" . $photo->getClientOriginalName();
            $path = 'images';
            $photo->move($path, $namePhoto);
            $data['photo'] =  $namePhoto;
        }
        $products->update($data);
        return redirect(route('admin.products.index'))->with('success','Berhasil diubah');
    }
}