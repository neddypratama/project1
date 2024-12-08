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
        Schema::create('input_isi_p3ks', function (Blueprint $table) {
            $table->id('input_isi_id');
            $table->unsignedBigInteger('isi_id')->index();
            $table->integer('jumlah_aktual');
            $table->date('tanggal_kadaluarsa');
            $table->text('keterangan');
            $table->unsignedBigInteger('p3k_id')->index();
            $table->timestamps();

            $table->foreign('isi_id')->references('isi_id')->on('isi_p3ks');
            $table->foreign('p3k_id')->references('p3k_id')->on('p3ks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_isi_p3ks');
    }
};
