<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApoiadorAdministrarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cidade_id'      => 'required|numeric',
            'nome'           => 'required',
            'telefone'       => 'required',
            'email'          => 'required',
            'endereco'       => 'required',
            'foto'           => 'image|max:2048',
            'link_foto'      => 'nullable|url'
        ];
    }
}
