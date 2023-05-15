<?php

namespace Modules\Specificity\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecificityStoreRequest extends FormRequest
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
            'en.slug' => 'required|unique:specificity_translations,slug',
            'ar.slug' => 'required|unique:specificity_translations,slug',
            'service_id' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

}
