<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SemesterRequest extends FormRequest
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
            'tipe' => ['required', Rule::in(config('constants.forms.semester'))],
            'tahun_akademik_id' => 'required|exists:tahun_akademik,id',
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
            'tipe' => trans('semester.fields.tipe'),
            'tahun_akademik_id' => trans('semester.fields.tahun_akademik_id'),
        ];
    }

    public function getFields()
    {
        $fields = ['tipe', 'tahun_akademik_id'];
        return $this->only($fields);
    }
}
