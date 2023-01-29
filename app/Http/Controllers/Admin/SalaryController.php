<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashInHand;
use App\Models\GlHead;
use App\Models\Officer;
use App\Models\Salary;
use App\Models\Transaction;
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
        $officer_data = Officer::all();
        $account_money = GlHead::where('glhead','=','Account')->first('balance')['balance'];
        return view('admin.salary.salaryview', compact('salary', 'officer_data'))->with('account_money',$account_money);
    }

    public function salary_insert(Request $req)
    {
        $req->validate([
            'salary_month' => 'required',
            'payment_amount' => 'required|max:20',
            'payment_date' => 'required|max:100',
            'remark' => 'required',
        ]);
 
        $result = Salary::where('officer_id', '=', $req->officer)->where('salary_month', '=', $req->salary_month)
            ->update([
                'payment_amount' => $req->payment_amount,
                'payment_date' => $req->payment_date,
                'total_due' => $req->due_amount - $req->payment_amount,
                'remark' => $req->remark,
                'user_id' => Auth::user()->id,
            ]);

        if ($result) {
            // ...................................... salary entry tranasaction table add krlm ................
            $gl = GlHead::where('glhead','=','Salary')->first(['glcode'])['glcode'];
            $acc_entry = new Transaction();
            $acc_entry->officer_id = $req->officer;
            $acc_entry->gl_code = $gl;
            $acc_entry->amount = $req->payment_amount;
            $acc_entry->date = $req->payment_date;
            $acc_entry->month = date('Fy');
            $acc_entry->remark = $req->remark;
            $acc_entry->acc_flag = "E";
            $acc_entry->tr_mood = "A";
            $acc_entry->user_id = Auth::user()->id;
            $acc_entry->save();

            //salary tk gl head jog krlm 
            $value = GlHead::where('glcode', '=', $gl)->first(['balance'])['balance'];
            GlHead::where('glcode', '=', $gl)->update([ 'balance'=> $value+$req->payment_amount ]);
            
            // salary tk account theke kete nilam 
            $acc_value = GlHead::where('glhead', '=', 'Account')->first(['balance'])['balance'];
            GlHead::where('glhead', '=','Account')->update([ 'balance'=> $acc_value - $req->payment_amount ]);

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

    // ..................... Due Amount ..........................
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
