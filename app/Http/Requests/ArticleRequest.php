<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArticleRequest extends Request
{
    /**
     * Determinamos se a requisição pode ser feita
     *
     * @return bool
     */
    public function authorize()
    {
        /**
         * Você poderia adicionar qualquer lógica aqui, para 
         * verificar se o usuário tem permissão
         * para fazer a requisição
         */
        return true;
    }

    /**
     * Pegamos as regras de validação
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'body'  => ['required']
        ];
    }

    /**
     * Setamos as mensagens correspondentes
     */
    public function messages()
    {
        return [
            'title.required' => 'Campo título é obrigatório',
            'body.required' => 'Campo corpo é obrigatório',
        ];
    }
}
