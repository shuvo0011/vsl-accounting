<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AccountPay;
use App\Models\GlHead;
use App\Models\Officer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountPayController extends Controller
{
    public function accountpayable(){

        $officerdata = Officer::where('status','=','Y')->get();
        $incomedata= GlHead::where('gltype','=','E')->get();
        $data = AccountPay::all();
        return view("admin.accountpayable.accountpayview",compact('officerdata','incomedata','data'));
    }

    public function accountinsert(Request $req){
        $req->validate([
            'month' => 'required',
            'officerName' => 'required', 
            'glhead' => 'required',
            'amount' => 'required',
            'status' => 'required',
            'remark' => 'required',
        ]);

       // dd($req);

        $new_entry = new AccountPay();
        $new_entry->entry_date = date("d-m-Y");
        $new_entry->expense_month = $req->month;
        $new_entry->officer = $req->officerName;
        $new_entry->glhead = $req->glhead;
        $new_entry->amount = $req->amount;
        $new_entry->status = $req->status;
        $new_entry->remark = $req->remark;
        $result = $new_entry->save();

        if ($result) {
            $req->session()->flash('msg', 'Data Successfully Save');
            return redirect('/admin/accountpayable');
        } else {
            $req->session()->flash('msg', 'Data Do Not Save Successfully');
            return redirect('/admin/accountpayable');
        }
    }


    public function accountPayUpdate(Request $req){

        $result = AccountPay::where('id',$req->id)->update(['status'=>"P"]);

        if($result){
            $new_entry = new Transaction();
            $new_entry->officer_id = Auth::user()->id;
            $new_entry->gl_code = $req->glcode;
            $new_entry->amount = $req->amount;
            $new_entry->month = date("Fy");
            $new_entry->date = date("d-m-Y");
            $new_entry->acc_flag = "E";
            $new_entry->tr_type = "D";
            $new_entry->tr_mood = "A";
            $new_entry->remark = $req->remark;
            $new_entry->user_id = Auth::user()->id;
            $rslt = $new_entry->save();
            if($rslt){
                $value = GlHead::where('glcode', '=', $req->glcode)->first(['balance'])['balance'];
                GlHead::where('glcode', '=', $req->glcode)->update([ 'balance'=> $value+$req->amount ]);

                //account sum 
                $acc_value = GlHead::where('glhead', '=', 'Account')->first(['balance'])['balance'];
                GlHead::where('glhead', '=','Account')->update([ 'balance'=> $acc_value - $req->amount ]);

                return "successfull";
            }
        }
        
    }
}
