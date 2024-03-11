<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_paciente',
        'genero',
        'morada',
        'nif',
        'data_nascimento',
        'telemovel',
        'email',
    ];


}
