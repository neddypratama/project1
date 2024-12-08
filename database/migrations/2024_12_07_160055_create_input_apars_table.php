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
        Schema::create('input_apars', function (Blueprint $table) {
            $table->id('input_apar_id');
            $table->unsignedBigInteger('sub_uraian_id')->index();
            $table->string('hasil_apar');
            $table->text('revisi');
            $table->unsignedBigInteger('apar_id')->index();
            $table->timestamps();

            $table->foreign('apar_id')->references('apar_id')->on('apars');
            $table->foreign('sub_uraian_id')->references('sub_uraian_id')->on('sub_uraians');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_apars');
    }
};
