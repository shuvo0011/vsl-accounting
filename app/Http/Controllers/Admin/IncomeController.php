<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\GlHead;
use App\Models\Income;
use App\Models\Officer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{

    public function index(){

        $officer_data=Officer::all();
        $gldata = GlHead::all();
        $income = Account::where('type','=','I')->orderBy('id', 'desc')->take(5)->get();
        return view('admin.income.incomeForm',compact('officer_data','gldata','income'));
    }

    public function entry(Request $req){
            $validate = $req->validate([
                'officer' => 'required|max:20',
                'gl_head' => 'required|max:20',
                'amount' => 'required|numeric',
                'month' => 'required|max:20',
            ]);
            // $new_entry = new Income;
            // $new_entry->officer = $req->officer;
            // $new_entry->gl_head = $req->gl_head;
            // $new_entry->amount = $req->amount;
            // $new_entry->month = $req->month;
            // $new_entry->date = $req->date;
            // $new_entry->remark = $req->remark;
            // $result = $new_entry->save();

//   ................... all income  data save in account table ..................
            $new_entry = new Account();
            $new_entry->officer_id = $req->officer;
            $new_entry->gl_code = $req->gl_head;
            $new_entry->amount = $req->amount;
            $new_entry->month = $req->month;
            $new_entry->date = $req->date;
            $new_entry->type = "I";
            $new_entry->remark = $req->remark;
            $new_entry->user_id = Auth::user()->id;
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
        
        $income = Account::where('type','=','I')->orderBy('id', 'desc')->get();
        return view('admin.income.incomeReport',compact('income'));
    }

    public function todayreport(){
        $income = Account::where('type','=','I')->where('date','=',date('%d/%m/%y'))->orderBy('id', 'desc')->get();
        return view('admin.income.incomeReport',compact('income'));
    }

    public function monthreport(){
        $income = Account::where('type','=','I')->where('month','=',date('F y'))->orderBy('id', 'desc')->get();
        return view('admin.income.incomeReport',compact('income'));
    }


}
