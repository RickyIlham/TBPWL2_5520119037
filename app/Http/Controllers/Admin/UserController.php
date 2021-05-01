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

        $user = new User;
        $user['name'] = $req->name;
        $user['username'] = $req->username;
        $user['email'] = $req->email;
        $user['password'] = bcrypt($req->password);
        $user['roles_id'] = $req->roles_id;
        $user['photo'] = $req->photo;
        
        if($req->photo != null){
            $photo = $req->file('photo');
            $size = $photo->getSize();
            $namePhoto = 'photo_user'.time() . "_" . $photo->getClientOriginalName();
            $path = 'storage/photo_user';
            $photo->move($path, $namePhoto);
            $user['photo'] =  $namePhoto;
        }
        $user = User::create($user);
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
        $user['name'] = $request->name;
        $user['username'] = $request->username;
        $user['email'] = $request->email;
        $user['roles_id'] = $request->role_id;
        
        if($request->photo != null){
            $imgWillDelete = public_path() . '/storage/photo_user/'.$user->photo;
            Storage::delete($imgWillDelete);

            $photo = $request->file('photo');
            $size = $photo->getSize();
            $namePhoto = 'photo_user'.time() . "_" . $photo->getClientOriginalName();
            $path = '/storage/photo_user/';
            $photo->move($path, $namePhoto);
            $user['photo'] =  $namePhoto;
        }
        if($request->password != null){
            $user['password'] = bcrypt($request->password);
        }
        $user->update($user);
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