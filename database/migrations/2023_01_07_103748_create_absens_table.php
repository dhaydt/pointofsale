<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absens', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 100);
            $table->string('outlet_id', 100);
            $table->string('shift', 100)->nullable();
            $table->dateTime('jam_masuk')->nullable();
            $table->string('lokasi_masuk', 300)->nullable();
            $table->dateTime('jam_pulang')->nullable();
            $table->string('lokasi_pulang', 300)->nullable();
            $table->string('keterangan', 255)->nullable();
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
        Schema::dropIfExists('absens');
    }
}
