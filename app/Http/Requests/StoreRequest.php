<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest {
    
    
    public function rules(){
        return [
            'name' => 'required|string|min:6|max:50',
			'type_id' => 'required|integer',
			'description' => 'required',
			'alias' => 'required|regex:/^[a-z0-9_\.]{6,30}$/|unique:stores,alias,'.$request->store_id
        ];
    }


    public function messages(){
        return [
            'name.required' => 'Debes escribir un nombre para tu negocio',
            'name.string'  => 'Estás utilizando caracteres no permitidos',
            'name.min'  => 'Debes ingresar 6 (seis) caracteres como mínimo',
            'name.max'  => 'Debes ingresar 50 (cincuenta) caracteres como máximo',
            'description.required'  => 'Por favor describe brevemente tu negocio',
            'alias.required'  => 'Debes escribir una dirección para tu tienda',
            'alias.regex'  => 'Estás usando caracteres no permitidos',
            'alias.unique'  => 'Esta dirección ya está siendo usada por otro negocio'
        ];
    }
}
