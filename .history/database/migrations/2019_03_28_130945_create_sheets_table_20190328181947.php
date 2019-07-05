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
            $table->bigIncrements('id');
            $table->integer('no');
            $table->string('name');
            $table->timedate('date');
            $table->string('timetable');
            $table->time('on_duty');
            $table->time('off_duty');
            $table->time('clock_in');
            $table->time('clock_out');
            $table->string('late');
            $table->string('early');
            $table->string('absent');
            $table->string('ot_time');
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
