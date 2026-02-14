<?php

namespace App\Http\Controllers;
use App\Models\Resposta;

use Illuminate\Http\Request;

class QuestionarioController extends Controller
{
    public function index(Request $request)
    {
            $jaRespondeu = \App\Models\Resposta::where(
            'user_id',
            $request->user()->id
        )->exists();

        if ($jaRespondeu) {
            return redirect('/dashboard')
                ->with('error', 'Você já respondeu o questionário.');
        }

        return view('questionario.index');
    }

    public function store(Request $request)
    {
        foreach ($request->respostas as $pergunta => $resposta) {
            
            if (is_array($resposta)) {
                $resposta = implode(', ', $resposta);
            }

            \App\Models\Resposta::create([
                'user_id' => $request->user()->id,
                'pergunta' => $pergunta,
                'resposta' => $resposta,
            ]);
        }

        return redirect('/dashboard')
            ->with('success', 'Questionário enviado com sucesso!');
    }

}

