<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 100);
            $table->string('isbn', 20);
            $table->integer('anopublicacao');
            $table->text('descricao');
            $table->integer('paginas');

            $table->foreignId('idautor')
                ->constrained('autors')
                ->onDelete('cascade');

            $table->foreignId('idcategoria')
                ->constrained('categorias')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};