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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('officer_id');
            $table->integer('gl_code');
            $table->string('amount',15);
            $table->string('date',15);
            $table->string('month',15);
            $table->string('remark',150);
            $table->integer('acc_flag');
            $table->string('tr_type',5);
            $table->string('tr_mood',5);
            $table->integer('user_id');
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
        Schema::dropIfExists('transactions');
    }
};
