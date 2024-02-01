<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:40|unique:types'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Inserisci un nome',
            'name.min' => 'Il nome deve essere di almeno 3 caratteri',
            'name.max' => 'Il nome non può superare i 40 caratteri',
            'name.unique' => 'Questo nome è già stato preso'
        ];
    }
}
