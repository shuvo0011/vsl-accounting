<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GlHead;
use App\Models\Officer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{

    public function index()
    {
        $officer_data = Officer::all(); 
        $gldata = GlHead::where('gltype', '<>', 'E')->get();
        $income = Transaction::where('acc_flag', '=', 'I')->orderBy('id', 'desc')->take(5)->get();
        $account_total = GlHead::where('glhead','=','Account')->first('balance')['balance'];

        return view('admin.income.incomeForm', compact('officer_data', 'gldata', 'income'))->with('account_total',$account_total);
    }

    public function entry(Request $req)
    {
        $req->validate([
            'officer' => 'required|max:20',
            'gl_head' => 'required|max:20',
            'amount' => 'required|numeric',
            'month' => 'required|max:20',
            'date' => 'required',
            'tr_type' => 'required',
            'tr_mood' => 'required',
            'remark' => 'required',
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
        $new_entry = new Transaction();
        $new_entry->officer_id = $req->officer;
        $new_entry->gl_code = $req->gl_head;
        $new_entry->amount = $req->amount;
        $new_entry->month = $req->month;
        $new_entry->date = $req->date;
        $new_entry->acc_flag = "I";
        $new_entry->tr_type = $req->tr_type;
        $new_entry->tr_mood = $req->tr_mood;
        $new_entry->remark = $req->remark;
        $new_entry->user_id = Auth::user()->id;
        $result = $new_entry->save();

        if ($result) {
            // dd($req->gl_head);
            if($req->tr_type == 'D'){
                // gl head balanse incremnet 
                $value = GlHead::where('glcode', '=', $req->gl_head)->first(['balance'])['balance'];
                GlHead::where('glcode', '=', $req->gl_head)->update([ 'balance'=> $value+$req->amount ]);

                //account sum 
                $acc_value = GlHead::where('glhead', '=', 'Account')->first(['balance'])['balance'];
                GlHead::where('glhead', '=','Account')->update([ 'balance'=> $acc_value + $req->amount ]);

                $req->session()->flash('msg', 'Data Successfully Save');
                return redirect('/admin/income');
            }else if($req->tr_type == 'W'){
                $value = GlHead::where('glcode', '=', $req->gl_head)->first(['balance'])['balance'];
                GlHead::where('glcode', '=', $req->gl_head)->update([ 'balance'=> $value - $req->amount ]);

                $acc_value = GlHead::where('glhead', '=', 'Account')->first(['balance'])['balance'];
                GlHead::where('glhead', '=','Account')->update([ 'balance'=> $acc_value - $req->amount ]);

                $req->session()->flash('msg', 'Data Successfully Save');
                return redirect('/admin/income');    
            }
        } else {
            $req->session()->flash('msg', 'Data cannot Save Successfully');
            return redirect('/admin/income');
        }
    } 

    public function report()
    {
        $account_total = GlHead::where('glhead','=','Account')->first('balance')['balance'];
        $income_list = Transaction::where('acc_flag', '=', 'I')->orderBy('id', 'desc')->get();
        return view('admin.income.incomeReport', compact('income_list'))->with('end')->with('start');
    }

    public function reportSearch(Request $req){
    //  dd($req);
       $account_total = GlHead::where('glhead','=','Account')->first('balance')['balance'];
        $income_list = Transaction::whereBetween('date', [$req->start, $req->end])->where('acc_flag', '=', 'I')->get();
        // /dd($income_list);
        return view('admin.income.incomeReport', compact('income_list'))->with('end',$req->end)->with('start',$req->start);
    }


    public function todayreport()
    {
        $income = Transaction::where('acc_flag', '=', 'I')->where('date', '=', date('%d/%m/%y'))->orderBy('id', 'desc')->get();
        return view('admin.income.incomeReport', compact('income'));
    }

    public function monthreport()
    {
        $income = Transaction::where('acc_flag', '=', 'I')->where('month', '=', date('F y'))->orderBy('id', 'desc')->get();
        return view('admin.income.incomeReport', compact('income'));
    }
}
