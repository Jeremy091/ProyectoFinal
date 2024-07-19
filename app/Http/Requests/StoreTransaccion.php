<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaccion extends FormRequest
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
            'fecha_transaccion' => 'required|date',
            'total_transaccion' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|max:255',
            'tipo_transaccion' => 'required|string|max:255',
        ];
    }
}
