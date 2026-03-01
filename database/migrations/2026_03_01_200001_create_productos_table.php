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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('slug', 170)->unique();
            $table->string('subtitulo', 255)->nullable();
            $table->string('material', 80)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('imagen', 255)->nullable();
            $table->json('caracteristicas')->nullable();
            $table->json('etiquetas')->nullable();
            $table->text('presentacion')->nullable();
            $table->text('certificaciones')->nullable();
            $table->string('url_tienda', 255)->nullable();
            $table->string('url_ficha_tecnica', 255)->nullable();
            $table->boolean('activo')->default(true);
            $table->boolean('destacado')->default(false);
            $table->unsignedInteger('orden')->default(0);
            $table->timestamps();

            $table->index(['activo', 'orden']);
            $table->index('destacado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
