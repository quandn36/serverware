<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class DataCreateAccountRequest extends FormRequest
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
            'email'     => 'required|email:rfc,dns|regex:/^([a-z0-9]+)(\.[a-z0-9\+_]+)*@([a-z0-9]+\.)+[a-z]{2,6}$/ix|'. Rule::unique("customers","email")->ignore($this->id),
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
