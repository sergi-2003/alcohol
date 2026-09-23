<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recursos_contenido', function (Blueprint $table) {

            $table->id();

            $table->foreignId('contenido_id')
                ->constrained('contenidos')
                ->cascadeOnDelete();

            $table->string('tipo', 30)->default('imagen');

            $table->string('titulo', 255)->nullable();

            $table->string('ruta', 500)->nullable();

            $table->string('url', 500)->nullable();

            $table->json('configuracion')->nullable();

            $table->unsignedInteger('orden')->default(0);

            $table->boolean('activo')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recursos_contenido');
    }
};