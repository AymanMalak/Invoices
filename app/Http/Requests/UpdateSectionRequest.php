<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
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
                'section_name' => 'required|unique:Sections,section_name|max:255',
                'description' => 'required'
        ];
    }


    public function messages(){
		return [
            'section_name.required' => 'يرجي ادخال اسم القسم',
            'section_name.unique' => 'اسم القسم موجود مسبقا',
            'description.required' => 'يرجي ادخال اسم القسم',
		];
	}
}
