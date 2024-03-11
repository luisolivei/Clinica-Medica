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
            $table->string('nome_paciente', 255);
            $table->enum('genero', ['Masculino', 'Femenino']);
            $table->string('morada', 255);
            $table->string('codigopostal', 9);
            $table->string('nif', 9)->unique();
            $table->string('imagem', 255)->nullable()->comment('Imagem do paciente');
            $table->date('data_nascimento');
            $table->string('telemovel', 26)->unique();
            $table->string('email')->unique();
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
