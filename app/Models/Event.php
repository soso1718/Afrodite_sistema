<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'user_id', 'title', 'menstruacao_fim', 'periodo_fertil_inicio', 'periodo_fertil_fim', 'ovulacao',];

        public function user()
        {
            return $this->belongsTo(User::class);
        }
}

