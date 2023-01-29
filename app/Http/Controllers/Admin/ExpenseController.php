<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GlHead;
use App\Models\Officer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $officer_data = Officer::all();
        $gldata = GlHead::all();
        $account_total = GlHead::where('glhead', '=', 'Account')->first('balance')['balance'];

        // $expense = Transaction::where('acc_flag', '=', 'E')->where('tr_mood', '<>', 'C')->orderBy('id', 'desc')->take(5)->get();
        $expense = Transaction::where('acc_flag', '=', 'E')->orderBy('id', 'desc')->take(5)->get();

        $cash_total = GlHead::where('glhead', '=', 'Cash In Hand')->first('balance')['balance'];

        return view('admin.expense.expenseForm', compact('officer_data', 'gldata', 'expense'))->with('account_total', $account_total)->with('cash_total', $cash_total);
    }

    public function entry(Request $req)
    {
        $req->validate([
            'officer' => 'required|max:20',
            'gl_head' => 'required|max:20',
            'amount' => 'required|numeric',
            'date' => 'required|max:20',
            'month' => 'required|max:20',
            'tr_mood' => 'required',
            'tr_type' => 'required',
            'remark' => 'required',
        ]);

        //  ...................   taka cost from account  ........... 
        if ($req->tr_mood ==  'A') {
            $new_entry = new Transaction();
            $new_entry->officer_id = $req->officer;
            $new_entry->gl_code = $req->gl_head;
            $new_entry->amount = $req->amount;
            $new_entry->month = $req->month;
            $new_entry->date = $req->date;
            $new_entry->acc_flag = "E";
            $new_entry->tr_mood = $req->tr_mood;
            $new_entry->tr_type = $req->tr_type;
            $new_entry->remark = $req->remark;
            $new_entry->user_id = Auth::user()->id;
            $result = $new_entry->save();

            if ($result) {
                if ($req->tr_type == 'D') {
                    // gl head balanse incremnet 
                    $value = GlHead::where('glcode', '=', $req->gl_head)->first(['balance'])['balance'];
                    GlHead::where('glcode', '=', $req->gl_head)->update(['balance' => $value + $req->amount]);

                    //account sum 
                    $acc_value = GlHead::where('glhead', '=', 'Account')->first(['balance'])['balance'];
                    GlHead::where('glhead', '=', 'Account')->update(['balance' => $acc_value - $req->amount]);

                    $req->session()->flash('msg', 'Data Successfully Save');
                    return redirect('/admin/expense');
                } else if ($req->tr_type == 'W') {
                    $value = GlHead::where('glcode', '=', $req->gl_head)->first(['balance'])['balance'];
                    GlHead::where('glcode', '=', $req->gl_head)->update(['balance' => $value + $req->amount]);

                    $acc_value = GlHead::where('glhead', '=', 'Account')->first(['balance'])['balance'];
                    GlHead::where('glhead', '=', 'Account')->update(['balance' => $acc_value + $req->amount]);

                    $req->session()->flash('msg', 'Data Successfully Save');
                    return redirect('/admin/expense');
                }
            }
            // cash in hand  money update 
        } else if ($req->tr_mood ==  'C') {
            $new_entry = new Transaction();
            $new_entry->officer_id = $req->officer;
            $new_entry->gl_code = $req->gl_head;
            $new_entry->amount = $req->amount;
            $new_entry->month = $req->month;
            $new_entry->date = $req->date;
            $new_entry->acc_flag = "E";
            $new_entry->tr_mood = $req->tr_mood;
            $new_entry->tr_type = $req->tr_type;
            $new_entry->remark = $req->remark;
            $new_entry->user_id = Auth::user()->id;
            $result = $new_entry->save();
            if ($result) {
                if ($req->tr_type == 'D') {
                    // gl head balanse incremnet 
                    $value = GlHead::where('glcode', '=', $req->gl_head)->first(['balance'])['balance'];
                    GlHead::where('glcode', '=', $req->gl_head)->update(['balance' => $value + $req->amount]);

                    //account sum 
                    $acc_value = GlHead::where('glhead', '=', 'Cash In Hand')->first(['balance'])['balance'];
                    GlHead::where('glhead', '=', 'Cash In Hand')->update(['balance' => $acc_value - $req->amount]);

                    $req->session()->flash('msg', 'Data Successfully Save');
                    return redirect('/admin/expense');
                } else if ($req->tr_type == 'W') {
                    $value = GlHead::where('glcode', '=', $req->gl_head)->first(['balance'])['balance'];
                    GlHead::where('glcode', '=', $req->gl_head)->update(['balance' => $value - $req->amount]);

                    $acc_value = GlHead::where('glhead', '=', 'Cash In Hand')->first(['balance'])['balance'];
                    GlHead::where('glhead', '=', 'Cash In Hand')->update(['balance' => $acc_value + $req->amount]);

                    $req->session()->flash('msg', 'Data Successfully Save');
                    return redirect('/admin/expense');
                }
            }
        }
    }

    public function report()
    {
        // $code = GlHead::where('glhead', '=', 'Cash In Hand')->first('glcode')['glcode'];
        // $expense = Transaction::where('acc_flag', '=', 'E')->where('gl_code', '<>', $code)->get();
        $expense = Transaction::where('acc_flag', '=', 'E')->get();

        $account_total = GlHead::where('glhead', '=', 'Account')->first('balance')['balance'];
        $cash_in_total = GlHead::where('glhead', '=', 'Cash In Hand')->first('balance')['balance'];
        $minus = $account_total - $cash_in_total;

        // return view('admin.expense.expenseReport', compact('expense'))->with('minus', $minus)->with('account_total', $account_total)->with('cash_total', $cash_in_total);
        return view('admin.expense.expenseReport', compact('expense'))->with('end')->with('start');
    }

    public function serachReport(Request $req)
    {
        // dd($req->end);

        $expense = Transaction::where('acc_flag', '=', 'E')->whereBetween('date', [$req->start, $req->end])->get();

        // $account_total = GlHead::where('glhead', '=', 'Account')->first('balance')['balance'];
        // $cash_in_total = GlHead::where('glhead', '=', 'Cash In Hand')->first('balance')['balance'];
        // $minus = $account_total - $cash_in_total;

        // return view('admin.expense.expenseReport', compact('expense'))->with('minus', $minus)->with('account_total', $account_total)->with('cash_total', $cash_in_total);
        return view('admin.expense.expenseReport', compact('expense'))->with('end',$req->end)->with('start',$req->start);
    }


    public function total_amount(Request $req)
    {
        if ($req->tr_mood == 'A') {
            $account_total = GlHead::where('glhead', '=', 'Account')->first('balance')['balance'];
            return $account_total;
        } else {
            $cash_in_total = GlHead::where('glhead', '=', 'Cash In Hand')->first('balance')['balance'];
            return $cash_in_total;
        }
    }
}













// test code 








// public function entry(Request $req)
// {
//     $req->validate([
//         'officer' => 'required|max:20',
//         'gl_head' => 'required|max:20',
//         'amount' => 'required|numeric',
//         'date' => 'required|max:20',
//         'month' => 'required|max:20',
//         'remark' => 'required',
//     ]);

//     //  ...................new data input in Account ........... 
//     if ($req->gl_head ==  GlHead::where('glhead', '=', 'Cash In Hand')->first('glcode')['glcode']) {
//         $new_entry = new CashInHand();
//         $new_entry->month = $req->month;
//         $new_entry->date = $req->date;
//         $new_entry->amount = $req->amount;
//         $new_entry->cash_flag = $req->tr_type;
//         $new_entry->user_id = Auth::user()->id;
//         $gl_result = $new_entry->save();
//         if ($gl_result) {
//             if ($req->tr_type == 'D') {
//                 $acc_value = GlHead::where('glhead', '=', 'Account')->first(['balance'])['balance'];
//                 GlHead::where('glhead', '=', 'Account')->update(['balance' => $acc_value - $req->amount]);

//                 $acc_value = GlHead::where('glcode', '=', $req->gl_head)->first(['balance'])['balance'];
//                 GlHead::where('glcode', '=', $req->gl_head)->update(['balance' => $acc_value + $req->amount]);
//             } else if ($req->tr_type == 'W') {
//                 $acc_value = GlHead::where('glhead', '=', 'Account')->first(['balance'])['balance'];
//                 GlHead::where('glhead', '=', 'Account')->update(['balance' => $acc_value + $req->amount]);

//                 $acc_value = GlHead::where('glcode', '=', $req->gl_head)->first(['balance'])['balance'];
//                 GlHead::where('glcode', '=', $req->gl_head)->update(['balance' => $acc_value - $req->amount]);
//             }

//             $req->session()->flash('msg', 'Data Successfully Save');
//             return redirect('/admin/expense');
//         } else {
//             $req->session()->flash('msg', 'Data can Save Successfully');
//             return redirect('/admin/expense');
//         }
//     } else {
//         $new_entry = new Transaction();
//         $new_entry->officer_id = $req->officer;
//         $new_entry->gl_code = $req->gl_head;
//         $new_entry->amount = $req->amount;
//         $new_entry->month = $req->month;
//         $new_entry->date = $req->date;
//         $new_entry->acc_flag = "E";
//         $new_entry->tr_mood = $req->tr_mood;
//         $new_entry->tr_type = $req->tr_type;
//         $new_entry->remark = $req->remark;
//         $new_entry->user_id = Auth::user()->id;
//         $result = $new_entry->save();
//         if ($result) {
//             if ($req->tr_mood == 'A') {
//                 if ($req->tr_type == 'D') {
//                     $acc_value = GlHead::where('glhead', '=', 'Account')->first(['balance'])['balance'];
//                     GlHead::where('glhead', '=', 'Account')->update(['balance' => $acc_value - $req->amount]);

//                     $acc_value = GlHead::where('glcode', '=', $req->gl_head)->first(['balance'])['balance'];
//                     GlHead::where('glcode', '=', $req->gl_head)->update(['balance' => $acc_value + $req->amount]);
//                 } else if ($req->tr_type == 'W') {
//                     $acc_value = GlHead::where('glhead', '=', 'Account')->first(['balance'])['balance'];
//                     GlHead::where('glhead', '=', 'Account')->update(['balance' => $acc_value + $req->amount]);

//                     $acc_value = GlHead::where('glcode', '=', $req->gl_head)->first(['balance'])['balance'];
//                     GlHead::where('glcode', '=', $req->gl_head)->update(['balance' => $acc_value - $req->amount]);
//                 }
//             } else if ($req->tr_mood == 'C') {
//                 if ($req->tr_type == 'D') {
//                     $acc_value = GlHead::where('glhead', '=', 'Cash In Hand')->first(['balance'])['balance'];
//                     GlHead::where('glhead', '=', 'Cash In Hand')->update(['balance' => $acc_value - $req->amount]);

//                     $acc_value = GlHead::where('glcode', '=', $req->gl_head)->first(['balance'])['balance'];
//                     GlHead::where('glcode', '=', $req->gl_head)->update(['balance' => $acc_value + $req->amount]);
//                 } else if ($req->tr_type == 'W') {
//                     $acc_value = GlHead::where('glhead', '=', 'Cash In Hand')->first(['balance'])['balance'];
//                     GlHead::where('glhead', '=', 'Cash In Hand')->update(['balance' => $acc_value + $req->amount]);

//                     $acc_value = GlHead::where('glcode', '=', $req->gl_head)->first(['balance'])['balance'];
//                     GlHead::where('glcode', '=', $req->gl_head)->update(['balance' => $acc_value - $req->amount]);
//                 }
//             }

//             $req->session()->flash('msg', 'Data Successfully Save');
//             return redirect('/admin/expense');
//         } else {
//             $req->session()->flash('msg', 'Data Do Not Save Successfully');
//             return redirect('/admin/expense');
//         }
//     }
// }