<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class KrsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('mahasiswa')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'semester_id' => 'required|exists:semester,id',
            'jumlah' => 'required|numeric|min:1|max:24',
            'catatan' => 'nullable',
            'file_upload' => 'nullable|file|mimes:pdf|max:10000',
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
            'semester_id' => trans('krs.fields.semester_id'),
            'jumlah' => trans('krs.fields.jumlah'),
            'catatan' => trans('krs.fields.catatan'),
            'file_upload' => trans('krs.fields.file_upload'),
        ];
    }

    public function getFields()
    {
        $fields = ['semester_id', 'jumlah', 'catatan', 'file_upload'];
        return $this->only($fields);
    }
}
