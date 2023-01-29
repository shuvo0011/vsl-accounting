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
        Schema::create('account_pays', function (Blueprint $table) {
            $table->id();
            $table->string('entry_date',15);
            $table->string('expense_month',30);
            $table->string('officer',30);
            $table->string('glhead',30);
            $table->double('amount');
            $table->string('status',5);
            $table->integer('remark');
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
        Schema::dropIfExists('account_pays');
    }
};
