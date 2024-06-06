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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('telefone');
            $table->string('telefone_emergencia');
            $table->string('bi_cedula');
            $table->integer('idade_gestacional');
            $table->float('peso');
            $table->float('altura');
            $table->text('historico');
            $table->text('alergias');
            $table->time('horario_admissao');
            $table->dateTime('inicio_trabalho_oarto');
            $table->text('contracoes');
            $table->text('batimentos');
            $table->text('medicamentos');
            $table->text('exame');
            $table->text('observacoes');
            $table->text('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
