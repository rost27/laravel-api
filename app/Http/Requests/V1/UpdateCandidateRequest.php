<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCandidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // for testing
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'sometimes',
            'last_name' => 'sometimes',
            'status' => 'sometimes',
            'position' => 'sometimes',
            'salary_range' => 'sometimes',
            'linkedin_url' => 'sometimes',
            'cv_file' => 'sometimes|file|mimes:pdf|max:2048',
        ];
    }
}
