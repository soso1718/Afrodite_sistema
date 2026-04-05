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
            'respostas.idade'                       => 'required|numeric|min:10|max:100',
            'respostas.cicloRegular'                => 'required|in:sim,nao,asVezes,nao_sei',
            'respostas.dataUltimaMenstruacao'       => 'nullable|date|required_without:respostas.dataUltimaMenstruacaoNaoSei',
            'respostas.dataUltimaMenstruacaoNaoSei' => 'nullable',
            'respostas.objetivo'                    => 'required_without:respostas.objetivoOutro|array|min:1',
            'respostas.objetivoOutro'               => 'nullable|string|max:255',
            'respostas.saudeImportante'             => 'nullable|string|max:1000',
            'respostas.hormonios'                   => 'required|in:sim,nao,nao_sei',
            'respostas.hormoniosTipo'               => 'nullable|array',
            'respostas.hormoniosTipo.*'             => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'respostas.idade.required'                         => 'O campo idade é obrigatório.',
            'respostas.idade.numeric'                          => 'A idade deve ser um número.',
            'respostas.idade.min'                              => 'A idade mínima é 10 anos.',
            'respostas.idade.max'                              => 'A idade máxima é 100 anos.',
            'respostas.cicloRegular.required'                  => 'Informe sobre a regularidade do seu ciclo.',
            'respostas.cicloRegular.in'                        => 'Selecione uma opção válida para o ciclo menstrual.',
            'respostas.dataUltimaMenstruacao.date'             => 'Informe uma data válida para a última menstruação.',
            'respostas.dataUltimaMenstruacao.required_without' => 'Informe a data da última menstruação ou marque a opção "Não sei".',
            'respostas.objetivo.required_without'              => 'Selecione ao menos um objetivo ou descreva o seu no campo "outro".',
            'respostas.objetivo.array'                         => 'O campo objetivo é inválido.',
            'respostas.objetivo.min'                           => 'Selecione ao menos um objetivo ou descreva o seu no campo "outro".',
            'respostas.objetivoOutro.string'                   => 'O campo "outro objetivo" deve ser um texto.',
            'respostas.objetivoOutro.max'                      => 'O campo "outro objetivo" deve ter no máximo 255 caracteres.',
            'respostas.saudeImportante.string'                 => 'O campo saúde deve ser um texto.',
            'respostas.saudeImportante.max'                    => 'O campo saúde deve ter no máximo 1000 caracteres.',
            'respostas.hormonios.required'                     => 'Informe se você utiliza hormônios.',
            'respostas.hormonios.in'                           => 'Selecione uma opção válida para hormônios.',
            'respostas.hormoniosTipo.array'                    => 'O campo tipo de hormônio é inválido.',
            'respostas.hormoniosTipo.*.string'                 => 'Cada tipo de hormônio deve ser um texto válido.',
        ];
    }
}