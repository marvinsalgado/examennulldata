<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SaveEmployeeRequest extends FormRequest
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
    public static function rules()
    {
        return [
            'name'      => ['required', 'string'],
            'email'     => ['required', 'email'],
            'position'  => ['required', 'string'],
            'birthdate' => ['required', 'date_format:d/m/Y'],
            'address'   => ['required', 'string'],
            'skills'    => ['required', 'array']
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Error de Validacion',
            'data'      => $validator->errors()
        ]));

    }

    public function messages()
    {
        return [
            'name.required'         => 'El nombre es requerido',
            'name.string'           => 'El nombre debe ser una cadena de texto',
            'email.required'        => 'El email es requerido',
            'email.email'           => 'El email debe ser email',
            'position.required'     => 'El puesto es requerido',
            'position.string'       => 'El puesto debe ser una cadena de texto',
            'birthdate.required'    => 'La fecha de nacimiento es requeridoa',
            'birthdate.date_format' => 'La fecha de nacimiento es debe tener un formato dd/mm/yyyy',
            'address.required'      => 'La dirección es requerida',
            'address.string'        => 'La dirección debe ser una cadena de texto',
            'skills.required'       => 'Los skills son requeridos',
            'skills.array'          => 'Los skills debe se un array',
        ];
    }

}
