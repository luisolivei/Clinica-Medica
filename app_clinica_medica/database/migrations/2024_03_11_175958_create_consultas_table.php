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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pacientes');
            $table->foreign('id_pacientes')->references('id')->on('pacientes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('NumeroConsulta')->nullable();
            $table->date('data_consulta')->default(date('Y-m-d'));
            $table->time('hora_consulta')->default(date('H:i:s'));
            $table->enum('status_consulta', ['Agendada', 'Cancelada', 'Realizada']);
            $table->string('descricao_consulta', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
