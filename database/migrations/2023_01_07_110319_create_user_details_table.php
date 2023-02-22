<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('img', 255)->nullable();
            $table->string('user_id', 30);
            $table->string('full_name', 255)->nullable();
            $table->string('nik', 20)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir', 50)->nullable();
            $table->string('kelamin', 20)->nullable();
            $table->string('agama', 20)->nullable();
            $table->string('alamat_lengkap', 300)->nullable();
            $table->string('alamat_domisili', 300)->nullable();
            $table->string('kewarganegaraan', 50)->nullable();
            $table->string('nama_ibu', 100)->nullable();
            $table->string('pendidikan', 20)->nullable();
            $table->string('penempatan_kerja', 255)->nullable();
            $table->string('jabatan', 50)->nullable();
            $table->string('outlet_id', 50)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('ktp_img', 255)->nullable();
            $table->string('no_kk', 30)->nullable();
            $table->string('rekening', 100)->nullable();
            $table->string('status', 20)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('user_details');
    }
}
