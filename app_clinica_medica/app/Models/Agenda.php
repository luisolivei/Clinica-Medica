<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_medicos',
        'id_consultas',
        'data_agenda',
        'hora_agenda',
        'status_agenda',
    ];

    public function rules()
    {
        return [
            'id_medicos' => 'required',
            'id_consultas' => 'required',
            'data_agenda' => 'required',
            'hora_agenda' => 'required',
            'status_agenda' => 'required',
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido'

        ];
    }


    public function medico()
    {
        // uma agenda tem um medico
        return $this->belongsTo(Medico::class, 'id_medicos', 'id');
    }


    public function consulta()
    {
        // uma agenda tem uma consulta
        return $this->belongsTo(Consulta::class, 'id_consultas', 'id');
    }


}
