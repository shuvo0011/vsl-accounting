<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountRec extends Model
{
    use HasFactory;


    public function glname(){
        return $this->belongsTo(GlHead::class,'income_head');
    }

    public function client(){
        return $this->belongsTo(ClientName::class,'client_name');
    }
}
