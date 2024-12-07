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
        Schema::create('p3ks', function (Blueprint $table) {
            $table->id('p3k_id');
            $table->string('bulan');
            $table->year('tahun');
            $table->string('p3k_hasil');
            $table->unsignedBigInteger('uraian_id')->index();
            $table->timestamps();

            $table->foreign('uraian_id')->references('uraian_id')->on('uraians');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p3ks');
    }
};
