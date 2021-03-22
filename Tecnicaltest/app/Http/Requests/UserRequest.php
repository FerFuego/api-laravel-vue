<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'string', 'max:255'],
            'avatar'    => ['nullable','image','mimes:jpeg,png,PNG,bmp,jpg,gif,svg','max:10240'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'El nombre deben ser solo caracteres alfanumericos',
            'name.required' => 'El nombre no puede estar vacio',
            'name.max' => 'El nombre supera el maximo permitido',
            'lastname.string' => 'El apellido debe ser solo texto',
            'lastname.required' => 'El apellido no puede estar vacio',
            'lastname.max' => 'El apellido supera el maximo permitido',
            'email.email' => 'El Email debe ser un email valido',
            'email.required' => 'El Email no puede estar vacio',
            'email.unique' => 'El Email ya existe',
            'password.string' => 'La contraseña deben ser solo caracteres alfanumericos',
            'password.required' => 'La contraseña no puede estar vacia',
            'password.min' => 'La contraseña debe contener al menos 8 caracteres',
            'password.max' => 'La contraseña supera el maximo permitido',
            'password.confirmed' => 'La contraseña no coincide',
        ];
    }
}
