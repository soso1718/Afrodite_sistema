<?php

namespace App\Http\Controllers;
use App\Models\Resposta;

use Illuminate\Http\Request;

class QuestionarioController extends Controller
{
    public function index()
    {
        return view('questionario.index');
    }

    public function store(Request $request)
    {
        foreach ($request->respostas as $pergunta => $resposta) {
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

