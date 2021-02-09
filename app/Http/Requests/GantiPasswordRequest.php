<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GantiPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => ['required', function($attribute, $value, $fail) {
                if (!password_verify($value, auth()->user()->password)) {
                    $fail(trans('passwords.errors.mismatch', ['attribute']));
                }
            }],
            'password' => 'required|min:6|confirmed|different:old_password',
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
            'old_password' => trans('passwords.fields.old_password'),
            'password' => trans('passwords.fields.password'),
        ];
    }
}
