<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashInHand;
use App\Models\ClientName;
use App\Models\GlHead;
use App\Models\Officer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParameterController extends Controller
{




    //   ..................  cash in hand ....................
    public function cash_index()
    {
        $cash = CashInHand::all();
        // dd($cash);
        return view('admin.cashinhand.cashview', compact('cash'));
    }

    public function cash_insert(Request $req)
    {
        $req->validate([
            'amount' => 'required|numeric',
            'date' => 'required|max:20',
            'month' => 'required|max:20',
        ]);

        $new_entry = new CashInHand();
        $new_entry->amount = $req->amount;
        $new_entry->month = $req->month;
        $new_entry->date = $req->date;
        $new_entry->user_id = Auth::user()->id;
        $result = $new_entry->save();

        if ($result) {
            $req->session()->flash('msg', 'Data Successfully Save');
            return redirect('/admin/cashinhand');
        } else {
            $req->session()->flash('msg', 'Data Do Not Save Successfully');
            return redirect('/admin/cashinhand');
        }
    }






    // ................................................................................
    //  ................. gl head ......................... ............................
    public function gl_index()
    {
        $gldata = GlHead::all();
        return view('admin.glhead.glview', compact('gldata'));
    }
    public function gl_insert(Request $req)
    {
        $req->validate([
            'glhead' => 'required',

        ]);
        $new_entry = new GlHead();
        $new_entry->glhead = $req->glhead;
        $new_entry->gltype = $req->gltype;
        $new_entry->user_id = Auth::user()->id;
        $result = $new_entry->save();
        if ($result) {
            $req->session()->flash('msg', 'Data Successfully Save');
            return redirect('/admin/glhead');
        } else {
            $req->session()->flash('msg', 'Data Do Not Save Successfully');
            return redirect('/admin/glhead');
        }
    }






    //  .................................................................................................................
    // ----------------  clients Name  ................................................................................................
    public function client_index()
    {
        $client_data = ClientName::all();
        return view('admin.officer.officerview', compact('client_data'));
    }

    public function client_insert(Request $req)
    {
        $req->validate([
            'client' => 'required',
            'f_client_cor' => 'required',
            'f_cor_mobile' => 'required',
            'sec_client_cor' => 'required',
            'sec_cor_mobile' => 'required',
            'rmo' => 'required',
        ]);

        $new_entry = new ClientName();
        $new_entry->vsl_client = $req->client;
        $new_entry->first_client_cor = $req->f_client_cor;
        $new_entry->first_cor_mobile = $req->f_cor_mobile;
        $new_entry->second_client_cor = $req->sec_client_cor;
        $new_entry->second_cor_mobile = $req->sec_cor_mobile;
        $new_entry->vsl_rmo = $req->rmo;
        $new_entry->user_id = Auth::user()->id;
        $result = $new_entry->save();

        if ($result) {
            $req->session()->flash('msg', 'Data Successfully Save');
            return redirect('/admin/officer');
        } else {
            $req->session()->flash('msg', 'Data Do Not Save Successfully');
            return redirect('/admin/officer');
        }
    }
}
