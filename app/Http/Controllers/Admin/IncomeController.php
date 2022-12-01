<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GlHead;
use App\Models\Income;
use App\Models\Officer;
use Illuminate\Http\Request;

class IncomeController extends Controller
{

    public function index(){

        $officer_data=Officer::all();
        $gldata = GlHead::all();
        return view('admin.income.incomeForm',compact('officer_data','gldata'));
    }

    public function entry(Request $req){

            $validate = $req->validate([
                'officer' => 'required|max:20',
                'gl_head' => 'required|max:20',
                'amount' => 'required|numeric',
                'date' => 'required|max:20',
                'month' => 'required|max:20',
                'remark' => 'required|max:100',
            ]);

            $new_entry = new Income;

            $new_entry->officer = $req->officer;
            $new_entry->gl_head = $req->gl_head;
            $new_entry->amount = $req->amount;
            $new_entry->month = $req->month;
            $new_entry->date = $req->date;
            $new_entry->remark = $req->remark;
            $result = $new_entry->save();
            
            if($result){
                $req->session()->flash('msg', 'Data Successfully Save');
                return redirect('/admin/income');
            }else{
                $req->session()->flash('msg', 'Data Do Not Save Successfully');
                return redirect('/admin/income');
            }
    }

    public function report(){
        
        $income = Income::all();
        return view('admin.income.incomeReport',compact('income'));
    }


}
