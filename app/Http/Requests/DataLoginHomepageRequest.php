<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataLoginHomepageRequest extends FormRequest
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
            'email'     =>  'required|email:rfc,dns|regex:/^([a-z0-9]+)(\.[a-z0-9\+_]+)*@([a-z0-9]+\.)+[a-z]{2,6}$/ix|email',
            'password'  =>  'required|min:8',
        ];
    }

    public function messages()
    {   
        return [
            //
        ];
    }
}
