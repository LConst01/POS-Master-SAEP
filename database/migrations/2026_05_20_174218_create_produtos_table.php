<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150);
            $table->string('categoria', 100);
            $table->string('marca', 100);
            $table->string('codigo_barras', 100)->unique();
            $table->string('cor', 50);
            $table->string('material', 100);
            $table->string('compatibilidade', 255);
            $table->decimal('preco', 10, 2);
            $table->integer('quantidade_atual')->default(0);
            $table->integer('estoque_minimo')->default(0);
            $table->boolean('garantia_estendida')->default(false);
            $table->text('descricao')->nullable();
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};