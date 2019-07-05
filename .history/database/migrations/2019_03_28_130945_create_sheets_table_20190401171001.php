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
        Schema::dropIfExists('sheets');
    }
}
