<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pacientes',
        'NumeroConsulta',
        'data_consulta',
        'hora_consulta',
        'status_consulta',
        'descricao_consulta',
    ];

    
}
