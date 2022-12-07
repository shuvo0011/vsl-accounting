<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\CashInHand;
use App\Models\Expense;
use App\Models\GlHead;
use App\Models\Income;
use App\Models\Officer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $officer_data = Officer::all();
        $gldata = GlHead::all();
        return view('admin.expense.expenseForm', compact('officer_data', 'gldata'));
    }

    public function entry(Request $req)
    {

        $validate = $req->validate([
            'officer' => 'required|max:20',
            'gl_head' => 'required|max:20',
            'amount' => 'required|numeric',
            'date' => 'required|max:20',
            'expense_month' => 'required|max:20',
        ]);

        //   off 
        // $new_entry = new Expense();
        // $new_entry->officer = $req->officer;
        // $new_entry->gl_head = $req->gl_head;
        // $new_entry->amount = $req->amount;
        // $new_entry->expense_month = $req->expense_month;
        // $new_entry->date = $req->date;
        // $new_entry->type = "E";
        // $new_entry->remark = $req->remark;
        // $new_entry->remark = Auth::user()->id;
        // $result = $new_entry->save();

        //  ...................new data input in Account ........... 
        if ($req->gl_head ==  GlHead::where('glhead', '=', 'Cash In Hand')->first('glcode')['glcode']) {
            $new_entry = new CashInHand();
            $new_entry->month = $req->expense_month;
            $new_entry->date = $req->date;
            $new_entry->amount = $req->amount;
            $new_entry->user_id = Auth::user()->id;
            $gl_result = $new_entry->save();
            if ($gl_result) {
                $req->session()->flash('msg', 'Data Successfully Save');
                return redirect('/admin/expense');
            } else {
                $req->session()->flash('msg', 'Data Do Not Save Successfully');
                return redirect('/admin/expense');
            }
        } else {
            $new_entry = new Account();
            $new_entry->officer_id = $req->officer;
            $new_entry->gl_code = $req->gl_head;
            $new_entry->amount = $req->amount;
            $new_entry->month = $req->expense_month;
            $new_entry->date = $req->date;
            $new_entry->type = "E";
            $new_entry->remark = $req->remark;
            $new_entry->flag = $req->flag;
            $new_entry->user_id = Auth::user()->id;
            $result = $new_entry->save();
            if ($result) {
                $req->session()->flash('msg', 'Data Successfully Save');
                return redirect('/admin/expense');
            } else {
                $req->session()->flash('msg', 'Data Do Not Save Successfully');
                return redirect('/admin/expense');
            }
        }
    }

    public function report()
    {
        $code = GlHead::where('glhead', '=', 'Cash In Hand')->first('glcode')['glcode'];
        $expense = Account::where('type', '=', 'E')->where('gl_code', '<>', $code)->get();

//   .................. akhane total income and expense khoroch ber kora hoice
        $expense_total = Account::where('type', '=', 'E')->sum('amount');  // sob khoroch account table 
        $income_total = Account::where('type', '=', 'I')->sum('amount');

//   ................. akhane cashInHand er ammont bahir kora hoice 
        $cash_total = CashInHand::sum('amount');   // total cash in hand table sum of amount 
        $cash_cost = Account::where('type', '=', 'E')->where('flag','=','2')->sum('amount'); // account table theke cashInHand theke  a ja khoroch hoice oi gula 
        $cash_in_total =  $cash_total - $cash_cost;

        $minus = $income_total -  $expense_total - $cash_total ;

        return view('admin.expense.expenseReport', compact('expense'))->with('minus', $minus)->with('expense_total', $expense_total)->with('cash_total', $cash_in_total) ;
    }


    public function total_amount(Request $req){
        if($req->flag == 1){
            $expense_total = Account::where('type', '=', 'E')->sum('amount');
            $income_total = Account::where('type', '=', 'I')->sum('amount');
            $cashinhand_total = CashInHand::sum('amount');
            $minus = $income_total -  $expense_total - $cashinhand_total ;
            return $minus;
        }else{
            $cashinhand_total = CashInHand::sum('amount');
            $cashinhand_cost = Account::where('type', '=', 'E')->where('flag','=','2')->sum('amount');
            $cashinhand = $cashinhand_total -  $cashinhand_cost;
            return $cashinhand;
        }
    }

}
