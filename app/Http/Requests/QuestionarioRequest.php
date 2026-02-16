<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'respostas.idade'                  => 'required|numeric|min:10|max:100',
            'respostas.cicloRegular'           => 'required|in:sim,nao,asVezes,nao_sei',
            'respostas.dataUltimaMenstruacao'  => 'nullable|date|required_without:respostas.dataUltimaMenstruacaoNaoSei',
            'respostas.dataUltimaMenstruacaoNaoSei' => 'nullable',
            'respostas.objetivo'               => 'required|array|min:1',
            'respostas.objetivoOutro'          => 'nullable|string|max:255',
            'respostas.saudeImportante'        => 'nullable|string|max:1000',
            'respostas.hormonios'              => 'required|in:sim,nao,nao_sei',
            'respostas.hormoniosTipo'          => 'nullable|array',
        ];
    }

    public function messages(): array
    {
        return [
            'respostas.idade.required' => 'O campo idade é obrigatório.',
            'respostas.cicloRegular.required' => 'Informe sobre a regularidade do seu ciclo.',
            'respostas.objetivo.required' => 'Selecione ao menos um objetivo.',
            'respostas.hormonios.required' => 'Informe se você utiliza hormônios.',
            'respostas.dataUltimaMenstruacao.required_without' => 'Por favor, informe a data da última menstruação ou marque a opção "Não sei".',
        ];
    }
}