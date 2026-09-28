<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('participantes', function (Blueprint $table) {

            $table->string('rol_familiar', 30)
                ->nullable()
                ->after('telefono');

            $table->string('municipio', 100)
                ->nullable()
                ->after('rol_familiar');

            $table->string('zona', 100)
                ->nullable()
                ->after('municipio');

            $table->decimal('latitud', 10, 7)
                ->nullable()
                ->after('zona');

            $table->decimal('longitud', 10, 7)
                ->nullable()
                ->after('latitud');

            $table->string('ubicacion_metodo', 20)
                ->nullable()
                ->after('longitud');
        });
    }

    public function down(): void
    {
        Schema::table('participantes', function (Blueprint $table) {

            $table->dropColumn([
                'rol_familiar',
                'municipio',
                'zona',
                'latitud',
                'longitud',
                'ubicacion_metodo',
            ]);

        });
    }
};