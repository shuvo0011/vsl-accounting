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
        Schema::create('gl_heads', function (Blueprint $table) {
            $table->id('glcode')->startingValue(900001);
            $table->string('glhead');
            $table->string('gltype',5)->nullable();
            $table->double('balance')->nullable();
            $table->double('budget')->nullable();
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
        Schema::dropIfExists('gl_heads');
    }
};
