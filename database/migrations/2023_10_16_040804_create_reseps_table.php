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
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('ingredients');
            $table->string('step');
            $table->string('name');
            // $table->unsignedBigInteger('name'); // Kolom untuk asosiasi dengan pengguna
            // $table->foreign('name')->references('id')->on('users');
            $table->boolean('is_bookmarked')->default(false);
            $table->boolean('is_approve')->default(false);
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
        Schema::dropIfExists('reseps');
    }
};
