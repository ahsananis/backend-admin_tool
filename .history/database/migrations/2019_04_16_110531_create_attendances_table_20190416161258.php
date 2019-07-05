<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('date');
            $table->time('on_duty');
            $table->time('off_duty');
            $table->string('clock_in')->default(0);
            $table->string('clock_out')->default(0);
            $table->string('late')->default(0);
            $table->string('early')->default(0);
            $table->string('absent')->default(0);
            $table->string('ot_time')->default(0);
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
        Schema::dropIfExists('attendances');
    }
}
