<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SaveSkillsRequest extends FormRequest
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
            'nameSkill' => ['required', 'string'],
            'rank'      => ['required', 'integer','between:1,5'],
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Error de Validacion en las skills',
            'data'      => $validator->errors()
        ]));

    }

    public function messages()
    {
        return [
            'nameSkill.required'         => 'El nombre de la skill es requerido',
            'nameSkill.string'           => 'El nombre de la skill debe ser una cadena de texto',
            'rank.required'              => 'El expertice es requerido',
            'rank.integer'               => 'El expertice debe ser un entero',
            'rank.between'               => 'El expertice debe ser un numero entre 1 a 5',
        ];
    }

}
