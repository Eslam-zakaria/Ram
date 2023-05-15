<?php

namespace Modules\Specificity\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpecificityUpdateRequest extends FormRequest
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
            'en.slug' => ['required', Rule::unique('specificity_translations', 'slug')->ignore($this->specificity->translate('en')->id)],
            'ar.slug' => ['required', Rule::unique('specificity_translations', 'slug')->ignore($this->specificity->translate('ar')->id)],
            'service_id' => 'required|numeric|min:1',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
