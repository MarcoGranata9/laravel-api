<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => 'required|min:5|max:100|unique:projects',
            'description' => 'nullable',
            'type_id' => ['nullable', 'numeric', 'exists:types,id'],
            'cover_image' => ['nullable', 'image', 'max:1000'],
            'technologies' => ['exists:technologys,id'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Inserisci un titolo',
            'title.min' => 'Il titolo deve essere di almeno 5 caratteri',
            'title.max' => 'Il titolo non può superare i 100 caratteri',
            'title.unique' => 'Il nome del titolo è già stato preso',
            'cover_image.image' => 'Il file deve essere un\'immagine',
            'cover_image.max' => 'Il file deve essere inferiore ad 1 megabyte',
        ];
    }
}
