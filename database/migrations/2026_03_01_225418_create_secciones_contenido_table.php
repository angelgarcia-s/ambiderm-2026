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
        Schema::create('secciones_contenido', function (Blueprint $table) {
            $table->id();
            $table->string('pagina', 50);
            $table->string('seccion', 80);
            $table->string('titulo_admin', 150);
            $table->json('contenido');
            $table->unsignedInteger('orden')->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->unique(['pagina', 'seccion']);
            $table->index(['pagina', 'orden']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secciones_contenido');
    }
};
