<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Brands;
use App\Product;
use App\User;
use App\Role;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.home');
    } 

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

    public function products(Request $req)
    {
        $user = Auth::user();
        $products = Product::all();
        $brands = Brands::all();
        $categories = Categories::all();
        return view('product', compact('user', 'products', 'brands', 'categories'));
    }

    public function submit_product(Request $req){
        $product = new Product;

        $product->name = $req->get('name');
        $product->qty = $req->get('qty');
        $product->brands_id = $req->get('brands_id');
        $product->categories_id = $req->get('categories_id');
        $product->photo = $req->get('photo');

        if($req->hasFile('photo')){
            $extension = $req->file('photo')->extension();
            $filename = 'photo_product' . time() . '.' . $extension;

            $req->file('photo')->storeAs(
                'public/photo_product', $filename
            );

            $product->photo = $filename;
        }

        $product->save();

        $notification = array(
            'message' => 'Data Produk berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('product')->with($notification);
    }

    // ajax prosess
    public function getDataProduct($id)
    {
        $product = Product::find($id);

        return response()->json($product);
    }

    // update Product
    public function update_product(Request $req)
    {
        $product = Product::find($req->get('id'));

        $product->name = $req->get('name');
        $product->qty = $req->get('qty');
        $product->brands_id = $req->get('brands_id');
        $product->categories_id = $req->get('categories_id');

        if($req->hasFile('photo')){
            $extension = $req->file('photo')->extension();
            $filename = 'photo_product'.time().'.'. $extension;

            $req->file('photo')->storeAs(
                'public/photo_product', $filename
            );
            Storage::delete('public/photo_product/'.$req->get('old_product'));
            $product->photo = $filename;
        }

        $product->save();

        $notification = array(
            'message' => 'Data Produk berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('product')->with($notification);
    }

    public function delete_product(Request $req)
    {
        $product = Product::find($req->get('id'));

        Storage::delete('public/photo_product/'.$req->get('old_photo'));

        $product->delete();

        $notification = array(
            'message' => 'Data Produk berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('product')->with($notification);
    }

    public function users(Request $req)
    {
        $user = Auth::user();
        $users = User::all();
        $roles = Role::all();
        return view('user', compact('user', 'users', 'roles'));
    }

    public function submit_user(Request $req){
        $this->validate($req, [
            'username' => 'unique:users',
            'email' => 'email|unique:users'
        ]);
        $data['name'] = $req->name;
        $data['username'] = $req->username;
        $data['email'] = $req->email;
        $data['password'] = bcrypt($req->password);
        $data['roles_id'] = $req->roles_id;
        
        if($req->photo != null){
            $photo = $req->file('photo');
            $size = $photo->getSize();
            $namePhoto = time() . "_" . $photo->getClientOriginalName();
            $path = 'storage/photo_user';
            $photo->move($path, $namePhoto);
            $data['photo'] =  $namePhoto;
        }
        $user = User::create($data);
        return redirect(route('user'))->with('success','Berhasil ditambahkan');
    }

    // ajax user
    public function getDataUser($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    public function update_user(Request $request){
        
        $user = User::find($request->get('id'));
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['roles_id'] = $request->role_id;
        
        if($request->photo != null){
            $imgWillDelete = public_path() . '/storage/photo_user/'.$user->photo;
            Storage::delete($imgWillDelete);

            $photo = $request->file('photo');
            $size = $photo->getSize();
            $namePhoto = time() . "_" . $photo->getClientOriginalName();
            $path = '/storage/photo_user/';
            $photo->move($path, $namePhoto);
            $data['photo'] =  $namePhoto;
        }
        if($request->password != null){
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        return redirect(route('user'))->with('success','Berhasil diubah');
    }

   
}