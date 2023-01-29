<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    ## Dashboard section
    public function dashBoard() {
        $per = Auth::user()->id;
       // dd($per);
        // $id = DB::select("SELECT * FROM roles as rl left join permissions as per on rl.id=per.role_id LEFT join users as u on per.user_id=u.id where u.id=?",[$per]);

        // dd($id);
        return view('admin.dashboard');
    }

}



// SELECT rl.bookkeeping FROM `roles` as rl left join permissions as per on rl.id=per.role_id LEFT join users as u on per.user_id=u.id where u.id=4;