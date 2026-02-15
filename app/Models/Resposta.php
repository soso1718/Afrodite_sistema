<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    protected $fillable = [
        'user_id',
        'idade',
        'ciclo_regular',
        'data_ultima_menstruacao',
        'objetivo',
        'objetivo_outro',
        'saude_importante',
        'hormonios',
        'hormonios_tipo',
    ];

    protected $casts = [
        'objetivo' => 'array',
        'hormonios_tipo' => 'array',
    ];
}
