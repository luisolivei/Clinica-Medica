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

    public function rules()
    {
        return [
            'nome_medico' => 'required |unique:medicos,nome_medico,' . $this->id . ' |min:3',
            'data_nascimento' => 'required |date',
            'telemovel' => 'required |unique:medicos,telemovel',
            'email' => 'required |unique:medicos,email',
            'id_especialidades' => 'required |exists:especialidades,id',

        ];
    }


}
