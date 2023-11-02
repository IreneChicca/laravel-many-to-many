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
            'title'=> ['required','string'],
            'date'=> ['required'],
            'main_lang'=> ['required','string','min:1'],
            'img'=> ['nullable','image'],
            'commit'=> ['required','integer'],
            'bonus'=> ['string'],
            'type_id'=> ['nullable','string', 'exists:types,id'],
            'technologies'=>['exists:technologies,id'],
        ];
    }



    public function messages()
    {
        return[
            'title.required'=> 'Il titolo è obbligatorio',
            'title.string'=> 'Il titolo deve essere una stringa',

            'date.required'=> 'La data è obbligatorio',

            'main_lang.required'=> 'Il linguaggio principale è obbligatorio',

            'img.image'=> 'Il file deve essere un\'immagine',

            'commit.required'=> 'Il numero di commit è obbligatorio',
            'commit.integer'=> 'Il numero di commit deve essere un numero',

            'bonus.string'=> 'Il titolo deve essere una stringa',

            'type_id.exists' => 'La categoria non è valida',

            'technologies.exists' => 'Non valido',
            
        ];

    }

}