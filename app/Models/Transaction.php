<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function office(){
        return $this->belongsTo(Officer::class,'officer_id');
    }

    public function glname(){
        return $this->belongsTo(GlHead::class,'gl_code');
    }
}
