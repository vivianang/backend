<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komplains', function (Blueprint $table) {
            $table->increments('id_komplain');
            $table->foreignId('id_pengguna');
            $table->string('alamat');
            $table->string('berkas');
            $table->string('foto');
            $table->string('isi');
            $table->string('kategori');
            $table->bigInteger('no_komplain');
            $table->date('tanggal');
            $table->string('status');
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
        Schema::dropIfExists('komplains');
    }
};
