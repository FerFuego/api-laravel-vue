<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'code' => ['string','required','max:10'],
            'name' => ['string','required','max:100'],
            'description' => ['string','required','max:200'],
            //'photo' => ['nullable','image','mimes:jpeg,png,PNG,bmp,jpg,gif,svg','max:10240'],
        ];
    }

    public function messages()
    {
        return [
            'code.string' => 'El codigo deben ser solo caracteres alfanumericos',
            'code.required' => 'El codigo no puede estar vacio',
            'code.max' => 'El codigo supera el maximo permitido',
            'name.string' => 'El nombre debe ser solo texto',
            'name.required' => 'El nombre no puede estar vacio',
            'name.max' => 'El nombre supera el maximo permitido',
            'description.string' => 'La descripcion debe ser solo texto',
            'description.required' => 'La descripcion no puede estar vacia',
            'description.max' => 'La descripcion supera el maximo permitido',
        ];
    }
}
