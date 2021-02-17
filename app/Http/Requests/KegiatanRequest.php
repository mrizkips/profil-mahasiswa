<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class KegiatanRequest extends FormRequest
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
            'penyelenggara' => 'required',
            'tingkat' => ['required', Rule::in(config('constants.forms.tingkat'))],
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
            'semester_id' => trans('kegiatan.fields.semester_id'),
            'nama' => trans('kegiatan.fields.nama'),
            'penyelenggara' => trans('kegiatan.fields.penyelenggara'),
            'tingkat' => trans('kegiatan.fields.tingkat'),
            'file_upload' => trans('kegiatan.fields.file_upload'),
        ];
    }

    public function getFields()
    {
        $fields = ['semester_id', 'nama', 'penyelenggara', 'tingkat', 'file_upload'];
        return $this->only($fields);
    }
}
