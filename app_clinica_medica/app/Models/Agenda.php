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


}
