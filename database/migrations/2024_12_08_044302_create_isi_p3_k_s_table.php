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
        Schema::create('isi_p3ks', function (Blueprint $table) {
            $table->id('isi_id');
            $table->string('isi_nama');
            $table->integer('jumlah_standar');
            $table->unsignedBigInteger('p3k_id')->index();
            $table->timestamps();

            $table->foreign('p3k_id')->references('p3k_id')->on('p3ks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isi_p3ks');
    }
};
