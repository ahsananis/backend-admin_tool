<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no');
            $table->string('name');
            $table->dateTime('date');
            $table->string('timetable');
            $table->time('on_duty');
            $table->time('off_duty');
            $table->time('clock_in');
            $table->time('clock_out');
            $table->time('late');
            $table->time('early');
            $table->string('absent');
            $table->time('ot_time');
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
        Schema::dropIfExists('sheets');
    }
}
