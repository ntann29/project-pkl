<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tanggapans', function (Blueprint $table) {
            $table->increments('id');
            $table->text('isi_tanggapan');
            $table->string('foto_bukti')->nullable();
            
            $table->unsignedBigInteger('id_pengaduansaran');
            $table->foreign('id_pengaduansaran')->references('id')->on('pengaduansarans')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggapans');
    }
};
