<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
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


    public function delete_user(Request $req)
    {
        $user = User::find($req->get('id'));

        $user->delete();

        $notification = array(
            'message' => 'Data Kategori berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('user.delete')->with($notification);
    }
}