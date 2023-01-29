<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public function roleName(){
        return $this->belongsTo(Role::class,'role_id');
    }

    public function userName(){
        return $this->belongsTo(User::class,'user_id');
    }
}
