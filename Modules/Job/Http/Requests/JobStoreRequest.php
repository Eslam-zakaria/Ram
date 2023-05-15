<?php

namespace Modules\Job\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobStoreRequest extends FormRequest
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
            'en.name' => 'required',
            'ar.name' => 'required',
            'en.description' => 'required',
            'ar.description' => 'required',
            'en.content' => 'required',
            'ar.content' => 'required',
            'en.requirements' => 'required',
            'ar.requirements' => 'required',
            'branche_id' => 'required|numeric|min:1',
            'department_id' => 'required|numeric|min:1',
        ];
    }

}
