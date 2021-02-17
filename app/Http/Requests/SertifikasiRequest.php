<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SertifikasiRequest extends FormRequest
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
            'nama' => 'required',
            'lembaga' => 'required',
            'nilai' => 'nullable|max:4',
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
            'semester_id' => trans('sertifikasi.fields.semester_id'),
            'nama' => trans('sertifikasi.fields.nama'),
            'lembaga' => trans('sertifikasi.fields.lembaga'),
            'nilai' => trans('sertifikasi.fields.nilai'),
            'catatan' => trans('sertifikasi.fields.catatan'),
            'file_upload' => trans('sertifikasi.fields.file_upload'),
        ];
    }

    public function getFields()
    {
        $fields = ['semester_id', 'nama', 'lembaga', 'nilai', 'catatan', 'file_upload'];
        return $this->only($fields);
    }
}
