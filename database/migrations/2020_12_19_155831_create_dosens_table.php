<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->string('no_telp')->unique();
            $table->unsignedBigInteger('id_matkul');
            $table->timestamps();
            $table->foreign('id_matkul')->references('id')->on('mata_kuliahs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosens');
    }
}
