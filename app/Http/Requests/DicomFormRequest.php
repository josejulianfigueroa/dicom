<?php

namespace DICOM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DicomFormRequest extends FormRequest
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
             'rut' => 'required|min:3',
             'dv' => 'required',
             'fecha_protesto' => 'required',
             'fecha_vencimiento' => 'required',
             'monto_protesto' => 'required',
             'fecha_vencimiento' => 'required',
             'fecha_protesto' => 'required',
             'numero_documento' => 'required',
             'situacion' => 'required'

        ];
    }
}
