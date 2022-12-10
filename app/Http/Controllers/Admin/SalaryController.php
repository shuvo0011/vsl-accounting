<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\CashInHand;
use App\Models\GlHead;
use App\Models\Officer;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Spatie\FlareClient\Glows\Glow;

class SalaryController extends Controller
{
    public function salary_index()
    {


        $salary = Salary::orderBy('officer_id')->get();
        // dd($salary);
        // $officer_data = Officer::where('status', '=', 'Y')->get();
        $officer_data = Officer::all();
        $expense_total = Account::where('type', '=', 'E')->sum('amount');
        $income_total = Account::where('type', '=', 'I')->sum('amount');
        $cashinhand_total = CashInHand::sum('amount');
        $account_money = $income_total -  $expense_total - $cashinhand_total ;

        return view('admin.salary.salaryview', compact('salary', 'officer_data'))->with('account_money',$account_money);
    }

    public function salary_insert(Request $req)
    {
        // $validate = $req->validate([
        //     'salary_month' => 'required',
        //     'salary_amount' => 'required|max:20',
        //     'pay_amount' => 'required|max:20',
        //     'pay_date' => 'required|max:100',
        //     'total_due' => 'required|max:100',
        //     'remark' => 'required|max:100',
        // ]);
        // dd($req);

        // $new_entry = new Salary();
        // $new_entry->officer_name = Officer::select('officer_name')->where('id', $req->officer)->first()->officer_name;
        // $new_entry->officer_id = $req->officer;
        // $new_entry->salary_month = $req->salary_month;
        // $new_entry->salary_amount = $req->salary_amount;
        // $new_entry->payment_amount = $req->payment_amount;
        // $new_entry->payment_date = $req->payment_date;
        // $new_entry->total_due = $req->salary_amount - $req->payment_amount;
        // $new_entry->remark = $req->remark;
        // $result = $new_entry->save();

        $result = Salary::where('officer_id', '=', $req->officer)->where('salary_month', '=', $req->salary_month)
            ->update([
                // 'salary_month' => $req->salary_month,
                // 'salary_amount' => $req->salary_amount,
                'payment_amount' => $req->payment_amount,
                'payment_date' => $req->payment_date,
                'total_due' => $req->due_amount - $req->payment_amount,
                'remark' => $req->remark,
                'user_id' => Auth::user()->id,
            ]);

        if ($result) {
// ...................................... data save in expense at account table ................
            $gl = GlHead::where('glhead','=','Salary')->first(['glcode'])['glcode'];
            $acc_entry = new Account();
            $acc_entry->officer_id = $req->officer;
            $acc_entry->gl_code = $gl;
            $acc_entry->amount = $req->payment_amount;
            $acc_entry->date = $req->payment_date;
            $acc_entry->month = date('Fy');
            $acc_entry->remark = $req->remark;
            $acc_entry->type = "E";
            $acc_entry->user_id = Auth::user()->id;
            $acc_result = $acc_entry->save();

            $value = GlHead::where('glcode', '=', $gl)->first(['balance'])['balance'];
            GlHead::where('glcode', '=', $gl)->update([ 'balance'=> $value+$req->payment_amount ]);


            $req->session()->flash('msg', 'Data Successfully Save');
            return redirect('/admin/salary');
        } else {
            $req->session()->flash('msg', 'Data Do Not Save Successfully');
            return redirect('/admin/salary');
        }
    }


    public function salary_edit($id)
    {
        $data = Salary::where('id', $id)->first();
        return view('admin.salary.salaryEdit', compact('data'))->with('id', $id);
    }

    public function salary_update(Request $req)
    {
        $result = Salary::where('id', '=', $req->id)
            ->update([
                'officer_name' => $req->officer_name,
                'officer_id' => $req->officer_id,
                'salary_month' => $req->salary_month,
                'salary_amount' => $req->salary_amount,
                'payment_amount' => $req->payment_amount,
                'payment_date' => $req->payment_date,
                'remark' => $req->remark,
                'user_id' => Auth::user()->id,
            ]);
        if ($result) {
            $req->session()->flash('msg', 'Data Successfully Save');
            return redirect('/admin/salary');
        } else {
            $req->session()->flash('msg', 'Data Do Not Save Successfully');
            return redirect('/admin/salary');
        }
    }



    public function salaryMonth(Request $req)
    {
        $id = $req->officer_id;
        $salary_month = Salary::where('officer_id', '=', $id)->where('total_due', '<>', '0')->get('salary_month');
        return $salary_month;
    }


    public function salaryAmount(Request $req)
    {
        //dd($req);
        $id = $req->month_id;
        $officer_id =  $req->officer_id;
        $salary_amount = Salary::where('salary_month', '=', $id)->where('officer_id', "=", $officer_id)->get(['salary_amount', 'total_due']);
        return $salary_amount;
    }


    public function generate()
    {
        $current_month = Carbon::now()->format('Fy');
        $salary_m = Salary::where('salary_month', '=', $current_month)->get()->count();
        if ($salary_m > 0) {
            session()->flash('msg', 'Salary ALl Ready Generate ');
            return redirect('/admin/salary');
        } else {
            $current_salary = Officer::where('status', '=', 'Y')->get();
            foreach ($current_salary as $row) {
                $new_entry = new Salary();
                $new_entry->officer_id = $row->id;
                $new_entry->salary_month = $current_month;
                $new_entry->salary_amount = $row->fixed_salary;
                $new_entry->total_due = $row->fixed_salary;
                $new_entry->user_id = Auth::user()->id;
                $new_entry->save();
            }
            session()->flash('msg', 'Salary Generate');
            return redirect('/admin/salary');
        }
    }
}
