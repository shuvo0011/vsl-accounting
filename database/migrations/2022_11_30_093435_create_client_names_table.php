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
        Schema::create('client_names', function (Blueprint $table) {
            $table->id();
            $table->string('vsl_client',30);
            $table->string('first_client_cor')->nullable();
            $table->string('first_cor_mobile',15)->nullable();
            $table->string('second_client_cor')->nullable();
            $table->string('second_cor_mobile',15)->nullable();
            $table->string('vsl_rmo');
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
        Schema::dropIfExists('client_names');
    }
};
