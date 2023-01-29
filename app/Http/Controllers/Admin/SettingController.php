<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{

    // ................... user  .....................
    public function usercreate()
    {
        $userdata = User::all();
        $role = Role::all();
        return view("admin.user.usercreateview", compact('userdata', 'role'));
    }

    public function userinsert(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required',
            'pwd1' => 'required',
        ]);

        $new_entry = new User();
        $new_entry->name = $req->name;
        $new_entry->email = $req->email;
        $new_entry->password =Hash::make($req->pwd1);
        $result = $new_entry->save();

        if ($result) {
            // $new_entry = new Permission();
            // $new_entry->name = $req->name;
            // $new_entry->email = $req->email;
            // $new_entry->password = $req->pwd1;
            // $result = $new_entry->save();

            $req->session()->flash('msg', 'Data Successfully Save');
            return back();
        } else {
            $req->session()->flash('msg', 'Data Do Not Save Successfully');
            return back();
        }
    }

    public function userrule()
    {
        return view("admin.user.userrule");
    }

    public function userpermission()
    {
        $data = User::all();
        return view('admin.user.userpermission',compact('data'));
    }


////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////

    //  ................ roles ..................
    public function rolecreate()
    {
        $roledata = Role::all();
        return view("admin.role.roleview", compact('roledata'));
    }

    public function roleinsert(Request $req)
    {
        //dd($req);
        $req->validate([
            'role' => 'required',
        ]);

        $new_entry = new Role();
        $new_entry->roles_id = $req->role;
        $new_entry->bookkeeping = $req->bookkeeping;
        $new_entry->paramsetup = $req->paramsetup;
        $new_entry->salary = $req->salary;
        $new_entry->budget = $req->budget;
        $new_entry->account_rec = $req->account_rec;
        $new_entry->account_pay = $req->account_pay;
        $new_entry->setting = $req->setting;
        $new_entry->backup = $req->backup;
        $result = $new_entry->save();
        if ($result) {
            $req->session()->flash('msg', 'Data Successfully Save');
            return back();
        } else {
            $req->session()->flash('msg', 'Data Do Not Save Successfully');
            return back();
        }
    }

    public function roleassign()
    {
        $userdata = User::all();
        $roledata = Role::all();
        $data = Permission::all();
        //dd($data);
        return view('admin.role.roleassign', compact('userdata', 'roledata', 'data'));
    }

    public function permission(Request $req)
    {
        // dd($req);
        $post = Permission::where('user_id', $req->user)->first();
      
        // dd($post);
        if (!$post) {
            $new_entry = new Permission();
            $new_entry->role_id = $req->role;
            $new_entry->user_id = $req->user;
            $result = $new_entry->save();

            if ($result) {
                $req->session()->flash('msg', 'Data Successfully Save');
                return back();
            } else {
                $req->session()->flash('msg', 'Data Do Not Save Successfully');
                return back();
            }
        }
        $req->session()->flash('msg', 'Data Do Not Save Successfully');
        return back();
    }
}
