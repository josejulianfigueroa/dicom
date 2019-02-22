<?php

namespace DICOM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlacklistFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //en false no funciona
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
            'motivo' => 'required',
            //
        ];
    }
}
