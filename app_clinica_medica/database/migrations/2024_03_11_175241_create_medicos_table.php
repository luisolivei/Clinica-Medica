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
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_medico');
            $table->date('data_nascimento');
            $table->string('telemovel', 9)->unique()->nullable();
            $table->string('email')->unique();
            $table->string('imagem', 30)->nullable()->comment('Imagem do medico');
            $table->unsignedBigInteger('id_especialidades');
            $table->foreign('id_especialidades')->references('id')->on('medicos')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};
