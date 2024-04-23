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
        Schema::create('kategoribuku_relasis', function (Blueprint $table) {
            $table->bigInteger('id_buku')->unsigned();
            $table->bigInteger('id_kategori')->unsigned();
            $table->foreign('id_buku')->references('id')->on('bukus')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id')->on('kategoribukus')->onDelete('cascade');
            $table->primary(['id_buku', 'id_kategori']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoribuku_relasis');
    }
};
