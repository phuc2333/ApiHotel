<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $dataUser = User::all();
        return view('admin.users.lists', compact('dataUser'));
    }

    public function viewadd()
    {
        $nameGroup = Groups::all();
        return view('admin.users.add', compact('nameGroup'));
    }

    public function Useradd(Request $request)
    {
        $obj = new User;
        $obj->name = $request->name;
        $obj->email = $request->email;
        $obj->password = Hash::make($request->password);
        $obj->group_id = $request->group_id;
        $obj->user_id = $request->user_id;
        $obj->save();
        return redirect()->back();
    }

    public function edit($id)
    {
       // dd($user);
        $obj = User::find($id)->get();
        $group = Groups::all();
        return view('admin.users.edit', compact('obj', 'group'));
    }

    public function userEdit(Request $request,$id)
    {
        $obj = User::find($id)->first();
        $obj->name = $request->name;
        $obj->email = $request->email;
        $obj->group_id = $request->group_id;
        $obj->update();
        return redirect()->back();
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return redirect()->back();
    }
}
