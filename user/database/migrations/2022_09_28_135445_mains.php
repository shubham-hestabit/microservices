<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mains', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 150)->unique();
            $table->text('address');
            $table->string('profile_picture')->nullable();
            $table->string('current_school');
            $table->string('previous_school');
            $table->unsignedBigInteger('r_id')->default(3);
            $table->foreign('r_id')->references('r_id')->on('roles');
            $table->integer('approval_status')->default(0);
            $table->string('password', 150);
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
        Schema::dropIfExists('mains');
    }
}