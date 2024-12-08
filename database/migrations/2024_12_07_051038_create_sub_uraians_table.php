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
        Schema::create('sub_uraians', function (Blueprint $table) {
            $table->id('sub_uraian_id');
            $table->string('sub_uraian_nama');
            $table->enum('sub_uraian_tipe', ['text', 'select']);
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
        Schema::dropIfExists('sub_uraians');
    }
};
