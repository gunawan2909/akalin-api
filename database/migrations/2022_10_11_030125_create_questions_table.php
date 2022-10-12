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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('costomer_id')->nullable();
            $table->foreignId('consultant_id')->nullable();
            $table->string('kind');
            $table->string('status');
            $table->time('date')->nullable();
            $table->string('university');
            $table->string('course');
            $table->string('study_program');
            $table->foreignId('answer_id');
            $table->string('file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
