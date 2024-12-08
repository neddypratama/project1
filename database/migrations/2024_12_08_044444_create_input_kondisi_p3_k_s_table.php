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
        Schema::create('input_kondisi_p3ks', function (Blueprint $table) {
            $table->id('input_kondisi_id');
            $table->unsignedBigInteger('kondisi_id')->index();
            $table->enum('hasil_check', ['Sesuai', 'Tidak Sesuai']);
            $table->text('tindakan_perbaikan');
            $table->unsignedBigInteger('p3k_id')->index();
            $table->timestamps();

            $table->foreign('kondisi_id')->references('kondisi_id')->on('kondisi_p3ks');
            $table->foreign('p3k_id')->references('p3k_id')->on('p3ks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_kondisi_p3ks');
    }
};
