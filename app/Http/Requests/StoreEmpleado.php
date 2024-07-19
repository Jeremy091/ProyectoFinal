<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpleado extends FormRequest
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
            'nombre_empleado' => 'required|string|max:255',
            'apellido_empleado' => 'required|string|max:255',
            'email_empleado' => 'required|email|unique:empleados,email_empleado|max:255',
            'direccion_empleado' => 'required|string|max:255',
            'telefono_empleado' => 'required|string|max:20',
            'rol' => 'required|string|max:255',
        ];
    }
}
