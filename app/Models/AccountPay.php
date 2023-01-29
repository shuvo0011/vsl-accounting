<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountPay extends Model 
{
    use HasFactory;

    public function glname(){
        return $this->belongsTo(GlHead::class,'glhead');
    }

    public function officerid(){
        return $this->belongsTo(Officer::class,'officer');
    }

}
