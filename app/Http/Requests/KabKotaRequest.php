<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class KabKotaRequest extends FormRequest
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
            'provinsi_id' => 'required|exists:provinsi,id',
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
            'nama' => trans('kabkota.fields.nama'),
            'provinsi_id' => trans('kabkota.fields.provinsi_id'),
        ];
    }

    public function getFields()
    {
        $fields = ['nama', 'provinsi_id'];
        return $this->only($fields);
    }
}
