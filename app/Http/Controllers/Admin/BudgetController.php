<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BudgetLog;
use App\Models\GlHead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
{
    
    public function budgetchange(){
        $data = GlHead::all();
        return view('admin.budget.budgetchange',compact('data'));
    }

    public function budgetupdate(Request $req ){

        $data = GlHead::where('glcode',$req->id)->first();
        //dd($req);
        $entry = new BudgetLog();
        $entry->glhead = $data->glcode;
        $entry->glbudget = $data->glbudget;
        $entry->month = date('Fy');
        $entry->save();

        GlHead::where('glcode',$req->id)->update(['glbudget'=>$req->input]);
    }

    public function report_search(){
        $reportdata = [];
        return view('admin.budget.budgetreport',compact('reportdata'));
    }

    public function report_view(Request $req){
       //dd($req->month);

        if($req->month == date('Fy')){
            $reportdata = DB::select("SELECT gl.glhead, sum(tr.amount) as amount, gl.glbudget as budget, tr.month ,tr.acc_flag FROM transactions as tr left join gl_heads as gl on tr.gl_code=gl.glcode where tr.month = '$req->month' and tr.tr_type = 'D'  GROUP by tr.gl_code");
            //dd($data);
            return view('admin.budget.budgetreport',compact('reportdata'));
        }else{
            $reportdata = DB::select("SELECT gl.glhead, sum(tr.amount) as amount, bg.glbudget as budget,tr.month, tr.acc_flag FROM transactions as tr  left join budget_logs as bg on tr.gl_code=bg.glhead  left JOIN gl_heads as gl on tr.gl_code=gl.glcode where tr.month='$req->month' and tr.tr_type = 'D' GROUP by tr.gl_code;");
           // dd($data);
           return view('admin.budget.budgetreport',compact('reportdata'));
        }

    }


    // SELECT 	gl.glhead, sum(tr.amount) as Amount, bg.glbudget as budget, tr.acc_flag FROM transactions as tr  left join 	budget_logs as bg on tr.gl_code=bg.glhead  left JOIN 	gl_heads as gl on tr.gl_code=gl.glcode  where 	tr.month = 'January23' and tr.tr_type = 'D'  GROUP by 	tr.gl_code;
}
