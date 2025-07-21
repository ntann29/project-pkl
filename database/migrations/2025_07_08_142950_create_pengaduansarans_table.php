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
        Schema::create('pengaduansarans', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->string('status_user')->nullable();
            $table->string('jenis');
            $table->string('kategori');
            $table->text('deskripsi');
            $table->string('foto_bukti')->nullable();
            $table->string('status')->nullable();
            $table->unsignedTinyInteger('rating')->nullable(); // dari 1 sampai 5

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduansarans');
    }
};
