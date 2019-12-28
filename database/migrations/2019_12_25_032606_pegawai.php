<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('nik');
            $table->string('nama');
            $table->string('alamat');
            $table->string('jkel');
            $table->string('telp');
            $table->unsignedInteger('jabatan_id');
            $table->unsignedInteger('sekolah_id');
            $table->timestamps();
            
            $table->foreign('jabatan_id')->references('id')->on('jabatan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sekolah_id')->references('id')->on('sekolah')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
}
