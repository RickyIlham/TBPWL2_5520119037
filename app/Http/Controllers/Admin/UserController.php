<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
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
    public function index()
    {
        $user = Auth::user();
        $Users = user::all();
        return view('admin.user', compact('Users'));
    }

    public function submit_user(Request $req){
        $user = new User;

        $user->name = $req->get('name');
        $user->username = $req->get('username');
        $user->email = $req->get('email');
        $user->password = $req->get('password');
        $user->roles_id = $req->get('roles_id');

        if ($req->hasFile('photo')) {
            $extension = $req->file('photo')->extension();

            $filename = 'photo_user_'.time().'.'.$extension;

            $req->file('photo')->storeAs(
                'public/photo_user', $filename
            );
            
           
            $user->photo = $filename;
        }

        $user->save();
        $notification = array(
            'message' => 'Data Kategori berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('user.submit')->with($notification);
    }


    // ajax prosess
    public function getDataUser($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    // update user
    public function update_user(Request $req)
    {
        $user = User::find($req->get('id'));

        $user->name = $req->get('name');
        $user->username = $req->get('username');
        $user->email = $req->get('email');
        $user->password = $req->get('password');
        $user->roles_id = $req->get('roles_id');

        if ($req->hasFile('photo')) {
            $extension = $req->file('photo')->extension();

            $filename = 'photo_user_'.time().'.'.$extension;

            $req->file('photo')->storeAs(
                'public/photo_user', $filename
            );
            
            Storage::delete('public/photo_user/'.$req->get('old_photo'));
            $user->photo = $filename;
        }

        $user->save();

        $notification = array(
            'message' => 'Data Kategori berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('user.update')->with($notification);
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