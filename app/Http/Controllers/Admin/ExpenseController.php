<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\GlHead;
use App\Models\Income;
use App\Models\Officer;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(){

        $officer_data = Officer::all();
        $gldata = GlHead::all();
        return view('admin.expense.expenseForm',compact('officer_data','gldata'));
    }

    public function entry(Request $req){

            $validate = $req->validate([
                'officer' => 'required|max:20',
                'gl_head' => 'required|max:20',
                'amount' => 'required|numeric',
                'date' => 'required|max:20',
                'expense_month' => 'required|max:20',
                'remark' => 'required|max:100',
            ]);

            $new_entry = new Expense();

            $new_entry->officer = $req->officer;
            $new_entry->gl_head = $req->gl_head;
            $new_entry->amount = $req->amount;
            $new_entry->expense_month = $req->expense_month;
            $new_entry->date = $req->date;
            $new_entry->remark = $req->remark;
            $result = $new_entry->save();
            
            if($result){
                $req->session()->flash('msg', 'Data Successfully Save');
                return redirect('/admin/expense');
            }else{
                $req->session()->flash('msg', 'Data Do Not Save Successfully');
                return redirect('/admin/expense');
            }
    }

    public function report(){
        
        $expense = Expense::all();
        $expense_total = Expense::sum('amount');
        $income_total = Income::sum('amount');
        $minus = $income_total -  $expense_total;
        return view('admin.expense.expenseReport',compact('expense'))->with('minus', $minus)->with('expense_total', $expense_total);
    }

}
