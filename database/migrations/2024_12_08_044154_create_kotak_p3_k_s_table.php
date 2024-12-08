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
        Schema::create('kotak_p3ks', function (Blueprint $table) {
            $table->id('kotak_id');
            $table->string('lokasi');
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
        Schema::dropIfExists('kotak_p3ks');
    }
};
