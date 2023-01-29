<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountRec;
use App\Models\ClientName;
use App\Models\GlHead;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountRecController extends Controller
{
    public function accountreceivale(){

        $clientdata = ClientName::all();
        $incomedata= GlHead::where('gltype','=','I')->get();
        $data = AccountRec::all();
        return view("admin.accountreceivable.accountrecview",compact('clientdata','incomedata','data'));
    }

    public function accountinsert(Request $req){
        $req->validate([
            'month' => 'required',
            'clientName' => 'required',
            'incomehead' => 'required',
            'amount' => 'required',
            'status' => 'required',
            'details' => 'required',
            'plan' => 'required',
        ]);

        $new_entry = new AccountRec();
        $new_entry->entry_date = date("d-m-Y");
        $new_entry->tentative_income_m = $req->month;
        $new_entry->client_name = $req->clientName;
        $new_entry->income_head = $req->incomehead;
        $new_entry->amount = $req->amount;
        $new_entry->status = $req->status;
        $new_entry->details = $req->details;
        $new_entry->payment_plan = $req->plan;
        $result = $new_entry->save();

        if ($result) {
            $req->session()->flash('msg', 'Data Successfully Save');
            return redirect('/admin/accountreceivale');
        } else {
            $req->session()->flash('msg', 'Data Do Not Save Successfully');
            return redirect('/admin/accountreceivale');
        }
    }


    public function accountRecUpdate(Request $req){
        // dd($req);
        $result = AccountRec::where('id',$req->id)->update(['status'=>"P"]);
        if($result){
            $new_entry = new Transaction();
            $new_entry->officer_id = Auth::user()->id;
            $new_entry->gl_code = $req->glcode;
            $new_entry->amount = $req->amount;
            $new_entry->month = date("Fy");
            $new_entry->date = date("d-m-Y");
            $new_entry->acc_flag = "I";
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
                GlHead::where('glhead', '=','Account')->update([ 'balance'=> $acc_value + $req->amount ]);

                return "successfull";
            }
        }
    }


}
