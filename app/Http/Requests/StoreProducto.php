<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProducto extends FormRequest
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
            'nombre_producto' => 'required|string|max:255', // Ejemplo de regla: campo obligatorio, tipo string, máximo 255 caracteres
            'descripcion_producto' => 'nullable|string',    // Ejemplo de regla: campo opcional, tipo string
            'precio_unitario' => 'required|numeric|min:0',  // Ejemplo de regla: campo obligatorio, tipo numérico, mínimo 0
        ];
    }
}
