<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProveedore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre_proveedor' => 'required|string|max:255',
            'direccion_proveedor' => 'required|string|max:255',
            'telefono_proveedor' => 'required|string|max:20',
            'email_proveedor' => 'required|email|unique:proveedores,email_proveedor|max:255',
        ];
    }
}
