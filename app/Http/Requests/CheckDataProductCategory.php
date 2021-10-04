<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckDataProductCategory extends FormRequest
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
            'slug_name'             =>  'required|max:191|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|' . Rule::unique("categories","slug")->ignore($this->id),
            'name_category'         =>  'required|max:191|'. Rule::unique("categories","name")->ignore($this->id),
            'parent_category'       =>  'required',
            'short_name_category'   =>  'max:40',
            'code'                  =>  'max:20'
        ];


    }

    public function messages()
    {
        return [
            //
        ];
    }
}
