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
        Schema::create('asientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPelicula');
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->integer('asiento_numero');
            $table->enum('estado', ['libre', 'ocupado'])->default('libre');
            $table->string('nombre_pelicula'); // Agregar el campo 'nombre_pelicula'
            $table->timestamps();

            $table->foreign('idPelicula')->references('id')->on('peliculas')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asientos');
    }
};
