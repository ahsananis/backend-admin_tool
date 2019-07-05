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
            $table->time('clock_in')->Default(0);
            $table->time('clock_out')->Default(0);
            $table->time('late')->Default(0);
            $table->time('early')->Default(0);
            $table->string('absent')->Default(0);
            $table->time('ot_time')->Default(0);
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
