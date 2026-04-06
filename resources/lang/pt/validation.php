<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Linhas de linguagem de validação
    |--------------------------------------------------------------------------
    |
    | As seguintes linhas de linguagem contêm as mensagens de erro padrão usadas
    | pela classe de validador. Algumas dessas regras possuem várias versões,
    | como as regras de tamanho. Sinta-se à vontade para ajustar cada uma.
    |
    */

    'current_password'     => 'A senha informada não confere com a senha atual.',
    'accepted'             => 'O campo :attribute deve ser aceito.',
    'active_url'           => 'O campo :attribute não é uma URL válida.',
    'after'                => 'O campo :attribute deve ser uma data posterior a :date.',
    'after_or_equal'       => 'O campo :attribute deve ser uma data posterior ou igual a :date.',
    'alpha'                => 'O campo :attribute deve conter apenas letras.',
    'alpha_dash'           => 'O campo :attribute deve conter apenas letras, números, traços e sublinhados.',
    'alpha_num'            => 'O campo :attribute deve conter apenas letras e números.',
    'array'                => 'O campo :attribute deve ser um array.',
    'before'               => 'O campo :attribute deve ser uma data anterior a :date.',
    'before_or_equal'      => 'O campo :attribute deve ser uma data anterior ou igual a :date.',

    'between'              => [
        'numeric' => 'O campo :attribute deve estar entre :min e :max.',
        'file'    => 'O campo :attribute deve ter entre :min e :max kilobytes.',
        'string'  => 'O campo :attribute deve ter entre :min e :max caracteres.',
        'array'   => 'O campo :attribute deve ter entre :min e :max itens.',
    ],

    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'A confirmação do campo :attribute não confere.',
    'date'                 => 'O campo :attribute não é uma data válida.',
    'date_equals'          => 'O campo :attribute deve ser uma data igual a :date.',
    'date_format'          => 'O campo :attribute não corresponde ao formato :format.',
    'different'            => 'Os campos :attribute e :other devem ser diferentes.',
    'digits'               => 'O campo :attribute deve ter :digits dígitos.',
    'digits_between'       => 'O campo :attribute deve ter entre :min e :max dígitos.',
    'email'                => 'O campo :attribute deve ser um endereço de e-mail válido.',
    'exists'               => 'O campo :attribute selecionado é inválido.',
    'file'                 => 'O campo :attribute deve ser um arquivo.',
    'filled'               => 'O campo :attribute deve ter um valor.',
    'gt'                   => [
        'numeric' => 'O campo :attribute deve ser maior que :value.',
        'file'    => 'O campo :attribute deve ser maior que :value kilobytes.',
        'string'  => 'O campo :attribute deve ser maior que :value caracteres.',
        'array'   => 'O campo :attribute deve ter mais que :value itens.',
    ],

    'gte'                  => [
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value.',
        'file'    => 'O campo :attribute deve ser maior ou igual a :value kilobytes.',
        'string'  => 'O campo :attribute deve ser maior ou igual a :value caracteres.',
        'array'   => 'O campo :attribute deve ter :value itens ou mais.',
    ],

    'image'                => 'O campo :attribute deve ser uma imagem.',
    'in'                   => 'O campo :attribute selecionado é inválido.',
    'integer'              => 'O campo :attribute deve ser um número inteiro.',
    'ip'                   => 'O campo :attribute deve ser um endereço IP válido.',
    'ipv4'                 => 'O campo :attribute deve ser um endereço IPv4 válido.',
    'ipv6'                 => 'O campo :attribute deve ser um endereço IPv6 válido.',
    'json'                 => 'O campo :attribute deve ser uma string JSON válida.',

    'min'                  => [
        'numeric' => 'O campo :attribute deve ser no mínimo :min.',
        'file'    => 'O campo :attribute deve ter no mínimo :min kilobytes.',
        'string'  => 'O campo :attribute deve ter pelo menos :min caracteres.',
        'array'   => 'O campo :attribute deve ter no mínimo :min itens.',
    ],

    'max'                  => [
        'numeric' => 'O campo :attribute não pode ser maior que :max.',
        'file'    => 'O campo :attribute não pode ter mais que :max kilobytes.',
        'string'  => 'O campo :attribute não pode ter mais que :max caracteres.',
        'array'   => 'O campo :attribute não pode ter mais que :max itens.',
    ],

    'required'             => 'O campo :attribute é obrigatório.',
    'same'                 => 'Os campos :attribute e :other devem ser iguais.',

    /*
    |--------------------------------------------------------------------------
    | Mensagens personalizadas
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar mensagens personalizadas para atributos usando
    | a convenção "attribute.rule".
    |
    */

    'custom' => [
        'password' => [
            'min' => 'A senha deve ter pelo menos :min caracteres.',

        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Atributos personalizados
    |--------------------------------------------------------------------------
    |
    | Aqui você pode substituir o placeholder :attribute por algo mais amigável.
    |
    */

    'attributes' => [],

];
