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
            $table->string('dokumentasi');
            $table->date('tanggal');
            $table->enum('status', ['Setuju', 'Revisi']);
            $table->string('tanda_tangan');
            $table->unsignedBigInteger('user_id')->index();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users');
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
