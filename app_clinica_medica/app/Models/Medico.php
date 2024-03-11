<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_medico',
        'data_nascimento',
        'telemovel',
        'email',
        'id_especialidades',


    ];
}
