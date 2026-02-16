<?php

namespace App\Http\Controllers;
use App\Http\Requests\QuestionarioRequest;
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

    public function store(QuestionarioRequest $request)
    {
        $userId = $request->user()->id;

        $jaRespondeu = Resposta::where('user_id', $userId)->exists();
        if ($jaRespondeu) {
            return redirect('/dashboard')->with('error', 'Você já respondeu o questionário.');
        }

        $dados = $request->respostas;


        if (!empty($dados['dataUltimaMenstruacaoNaoSei'])) {
            $dados['dataUltimaMenstruacao'] = 'nao_sei';
        }

        Resposta::create([
            'user_id'                 => $userId,
            'idade'                   => $dados['idade'] ?? null,
            'ciclo_regular'           => $dados['cicloRegular'] ?? null,
            'data_ultima_menstruacao' => $dados['dataUltimaMenstruacao'] ?? null,
            'objetivo'                => $dados['objetivo'] ?? null,
            'objetivo_outro'          => $dados['objetivoOutro'] ?? null,
            'saude_importante'        => $dados['saudeImportante'] ?? null,
            'hormonios'               => $dados['hormonios'] ?? null,
            'hormonios_tipo'          => $dados['hormoniosTipo'] ?? null,
        ]);

        return redirect('/dashboard')->with('success', 'Questionário enviado!');
    }

    public function edit(Request $request)
    {
        $resposta = Resposta::where('user_id', $request->user()->id)->firstOrFail();
    
        return view('questionario.edit', compact('resposta'));
    }

    public function update(QuestionarioRequest $request)
    {
        $resposta = Resposta::where('user_id', $request->user()->id)->firstOrFail();
        
        $dados = $request->respostas;

        if (!empty($dados['dataUltimaMenstruacaoNaoSei'])) {
            $dados['dataUltimaMenstruacao'] = 'nao_sei';
        }

        $resposta->update([
            'idade'                   => $dados['idade'],
            'ciclo_regular'           => $dados['cicloRegular'],
            'data_ultima_menstruacao' => $dados['dataUltimaMenstruacao'],
            'objetivo'                => $dados['objetivo'],
            'objetivo_outro'          => $dados['objetivoOutro'],
            'saude_importante'        => $dados['saudeImportante'],
            'hormonios'               => $dados['hormonios'],
            'hormonios_tipo'          => $dados['hormoniosTipo'],
        ]);

        return redirect('/dashboard')->with('success', 'Questionário atualizado com sucesso!');
    }

}