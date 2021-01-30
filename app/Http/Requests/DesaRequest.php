<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DesaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'required|string',
            'kecamatan_id' => 'required|exists:kecamatan,id',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'nama' => trans('desa.fields.nama'),
            'kecamatan_id' => trans('desa.fields.kecamatan_id'),
        ];
    }

    public function getFields()
    {
        $fields = ['nama', 'kecamatan_id'];
        return $this->only($fields);
    }
}
