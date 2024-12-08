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
        Schema::create('uraians', function (Blueprint $table) {
            $table->id('uraian_id');
            $table->string('uraian_nama');
            $table->unsignedBigInteger('apar_id')->index();
            $table->timestamps();

            $table->foreign('apar_id')->references('apar_id')->on('apars');
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uraians');
    }
};
