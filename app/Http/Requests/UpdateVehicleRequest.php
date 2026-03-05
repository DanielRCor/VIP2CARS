<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVehicleRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $currentYear = (int) date('Y');
        $vehicle     = $this->route('vehicle');
        $clientId    = $vehicle?->client_id;

        return [
            // Vehículo
            'placa'           => [
                'required', 
                'string', 
                Rule::unique('vehicles', 'placa')->ignore($vehicle), 
                'regex:/^[A-Z][A-Z0-9][A-Z]-\d{3}$/i'
            ],
            'marca'           => ['required', 'string', 'max:80'],
            'modelo'          => ['required', 'string', 'max:100'],
            'anio_fabricacion'=> ['required', 'integer', 'min:1900', "max:{$currentYear}"],
            // Cliente
            'nombre'          => ['required', 'string', 'max:100'],
            'apellidos'       => ['required', 'string', 'max:150'],
            'nro_documento'   => [
                'required', 
                'string', 
                'regex:/^\d{8}$/', 
                Rule::unique('clients', 'nro_documento')->ignore($clientId)
            ],
            'correo'          => [
                'required', 
                'email:rfc,dns', 
                'max:255', 
                Rule::unique('clients', 'correo')->ignore($clientId)
            ],
            'telefono'        => ['required', 'string', 'max:20', 'regex:/^[\d\+\-\(\)\s]+$/'],
        ];
    }

    /**
     * Custom validation messages in Spanish.
     */
    public function messages(): array
    {
        return [
            'placa.required'            => 'La placa es obligatoria.',
            'placa.unique'              => 'La placa ya está registrada en el sistema.',
            'placa.regex'               => 'El formato de placa no es válido (Ej: ABC-123 o A1A-123).',
            'marca.required'            => 'La marca del vehículo es obligatoria.',
            'modelo.required'           => 'El modelo del vehículo es obligatorio.',
            'anio_fabricacion.required' => 'El año de fabricación es obligatorio.',
            'anio_fabricacion.min'      => 'El año de fabricación no puede ser anterior a 1900.',
            'anio_fabricacion.max'      => 'El año de fabricación no puede ser mayor al año actual.',
            'anio_fabricacion.integer'  => 'El año de fabricación debe ser un número entero.',
            'nombre.required'           => 'El nombre del cliente es obligatorio.',
            'apellidos.required'        => 'Los apellidos del cliente son obligatorios.',
            'nro_documento.required'    => 'El número de documento es obligatorio.',
            'nro_documento.regex'       => 'El DNI debe tener exactamente 8 dígitos numéricos.',
            'nro_documento.unique'      => 'El número de documento ya está registrado.',
            'correo.required'           => 'El correo electrónico es obligatorio.',
            'correo.email'              => 'El formato del correo electrónico no es válido.',
            'correo.unique'             => 'El correo electrónico ya está registrado.',
            'telefono.required'         => 'El teléfono es obligatorio.',
            'telefono.regex'            => 'El teléfono solo puede contener números, +, -, (, ) y espacios.',
        ];
    }
}
