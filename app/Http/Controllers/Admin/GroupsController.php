<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\Modules;
use App\Models\User;

use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function index()
    {
        $datagroup = Groups::all();
        return view('admin.groups.lists', compact('datagroup'));
    }

    public function viewadd()
    {
        $nameGroup = Groups::all();
        return view('admin.groups.add', compact('nameGroup'));
    }

    public function Groupadd(Request $request)
    {
        $obj = new Groups;
        $obj->name = $request->name;
        $obj->permission = $request->permission;
        $obj->user_id = $request->user_id;
        $obj->save();
        return redirect()->back();
    }

    public function edit($id)
    {
        $obj = Groups::where('id', $id)->get();
        return view('admin.groups.edit', compact('obj'));
    }

    public function GroupEdit(Request $request, $id)
    {
        $obj = Groups::where('id', $id)->first();
        $obj->name = $request->name;
        $obj->user_id = $request->user_id;
        $obj->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        $group = Groups::where('id', $id)->first();
        $group->delete();
        return redirect()->back();
    }

    public function permission($id)
    {
        $group = Groups::where('id', $id)->get();
        $modules = Modules::all();
        $roleListsArr = [
            'view' => 'Xem',
            'add' => 'Thêm',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
        ];
        foreach ($group as $key => $value) {
            if (!empty($value)) {
                $roleArr = json_decode($value->permission, true);
            } else {
                $roleArr = [];
            }
        }
        return view('admin.groups.permission', compact('group', 'modules', 'roleListsArr', 'roleArr'));
    }

    public function postPermission(Request $request)
    {
        if (!empty($request->role)) {
            $roleArr = $request->role;
        } else {
            $roleArr = [];
        }

        $groupRole = Groups::where('id', $request->id_group)->first();
        $roleJson = json_encode($roleArr);
        $groupRole->permission = $roleJson;
        $groupRole->update();
        return redirect()->back();
    }
}
