<?php

namespace App\Http\Requests\Plan;

use Illuminate\Foundation\Http\FormRequest;

class PlanStoreRequest extends FormRequest
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
            'name'=> 'required|max:255',
            'image'=> 'required',
            'amount'=> 'required',
            'term'=> 'required',
            'status'=> 'required',
            'package_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name field is required',
            'image.required' => 'The image field is required',
            'amount.required' => 'The amount field is required',
            'term.required' => 'The term field is required',
            'status.required' => 'The status field is required',
            'package_id.required' => 'The package field is required',
        ];
    }
}
