<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->String("roles_id",30)->nullable();
            $table->String("bookkeeping",5)->nullable();
            $table->String("paramsetup",5)->nullable();
            $table->String("salary",5)->nullable();
            $table->String("budget",5)->nullable();
            $table->String("account_rec",5)->nullable();
            $table->String("account_pay",5)->nullable();
            $table->String("setting",5)->nullable();
            $table->String("backup",5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
