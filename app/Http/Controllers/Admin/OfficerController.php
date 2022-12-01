<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Officer;
use Illuminate\Http\Request;

class OfficerController extends Controller
{


    public function officer_index()
    {
        $officer_data = Officer::all();
        return view('admin.officer.officerview', compact('officer_data'));
    }

    public function officer_insert(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'salary' => 'required',
            'remark' => 'required',
            'status' => 'required',
        ]);

        $new_entry = new Officer();
        $new_entry->officer_name = $req->name;
        $new_entry->fixed_salary = $req->salary;
        $new_entry->remark = $req->remark;
        $new_entry->status = $req->status;
        $result = $new_entry->save();

        if ($result) {
            $req->session()->flash('msg', 'Data Successfully Save');
            return redirect('/admin/officer');
        } else {
            $req->session()->flash('msg', 'Data Do Not Save Successfully');
            return redirect('/admin/officer');
        }
    }


    public function delete($id){

        $result = Officer::where('id',$id)->delete();
            return redirect('/admin/officer');
    }

}
