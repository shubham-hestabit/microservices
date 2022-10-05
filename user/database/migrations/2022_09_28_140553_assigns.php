<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Assigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigns', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('student_id')->unique()->default(0);
            $table->foreign('student_id')->references('s_id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('assigned_teacher_id')->default(0);
            $table->foreign('assigned_teacher_id')->references('t_id')->on('teachers')->onDelete('cascade');
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
        Schema::dropIfExists('assigns');
    }
}
