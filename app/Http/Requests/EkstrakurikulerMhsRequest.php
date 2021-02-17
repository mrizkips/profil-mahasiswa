<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EkstrakurikulerMhsRequest extends FormRequest
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
            'ekstrakurikuler_id' => 'required|exists:ekstrakurikuler,id',
            'semester_id' => 'required|exists:semester,id',
            'jabatan' => ['required', Rule::in(config('constants.forms.jabatan'))],
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
            'ekstrakurikuler_id' => trans('ekstrakurikuler_mhs.fields.ekstrakurikuler_id'),
            'semester_id' => trans('ekstrakurikuler_mhs.fields.semester_id'),
            'jabatan' => trans('ekstrakurikuler_mhs.fields.jabatan'),
        ];
    }

    public function getFields()
    {
        $fields = ['ekstrakurikuler_id', 'semester_id', 'jabatan'];
        return $this->only($fields);
    }
}
