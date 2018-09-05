<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitaRequest extends FormRequest
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
            'cidade_id' => 'required|numeric',
            'data'      => 'required|date',
            'titulo'    => 'required',
            'descricao' => 'required',
            'imagens'   => 'required|image|max:2048'
        ];
    }
}
