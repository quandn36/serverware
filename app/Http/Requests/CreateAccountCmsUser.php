<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAccountCmsUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|max:191',
            'company'   => 'required|max:191',
            'email'     => "required|email:rfc,dns|regex:/^([a-z0-9]+)(\.[a-z0-9\+_]+)*@([a-z0-9]+\.)+[a-z]{2,6}$/ix|".Rule::unique("customers","email")->ignore($this->id),
            'password'  => 'required|min:8|max:20'
        ];
    }

    public function messages()
    {
        return [
            'email.regex'    => 'Please enter a valid email address',
            'email.email'    => 'Please enter a valid email address',
            'email.required' => 'This value is require',
            'email.unique'   => 'Email already exists',
        ];
    }
}
