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
        Schema::create('apars', function (Blueprint $table) {
            $table->id('apar_id');
            $table->string('bulan');
            $table->year('tahun');
            $table->string('apar_hasil');
            $table->unsignedBigInteger('sub_uraian_id')->index();
            $table->timestamps();

            $table->foreign('sub_uraian_id')->references('sub_uraian_id')->on('sub_uraians');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apars');
    }
};
