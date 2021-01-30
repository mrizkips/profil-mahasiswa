<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class KecamatanRequest extends FormRequest
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
            'kabkota_id' => 'required|exists:kabkota,id',
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
            'nama' => trans('kecamatan.fields.nama'),
            'kabkota_id' => trans('kecamatan.fields.kabkota_id'),
        ];
    }

    public function getFields()
    {
        $fields = ['nama', 'kabkota_id'];
        return $this->only($fields);
    }
}
