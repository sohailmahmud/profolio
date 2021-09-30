<?php

namespace App\Http\Requests\Package;

use Illuminate\Foundation\Http\FormRequest;

class PackageUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'price' => 'required',
            'term' => 'required',
            'trial_days' => $this->is_trial == "1" ? 'required' : '',
        ];
    }
    public function messages(): array
    {
        return [
            'trial_days.required' => 'Trial days is required when trial option is checked'
        ];
    }
}
