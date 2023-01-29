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
        Schema::create('account_recs', function (Blueprint $table) {
            $table->id();
            $table->string('entry_date',15);
            $table->string('tentative_income_m',30);
            $table->string('client_name',30);
            $table->string('income_head',30);
            $table->double('amount');
            $table->string('status',15);
            $table->integer('details');
            $table->string('payment_plan');
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
        Schema::dropIfExists('account_recs');
    }
};
