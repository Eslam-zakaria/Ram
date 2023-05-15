<?php

namespace Modules\Service\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceUpdateRequest extends FormRequest
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
            // 'en.slug' => 'required',
            // 'ar.slug' => 'required',
            'en.slug' => ['required', 'max:255', Rule::unique('service_translations', 'slug')->where('locale', 'en')->ignore($this->service->id, 'service_id')],
            'ar.slug' => ['required', 'max:255', Rule::unique('service_translations', 'slug')->where('locale', 'ar')->ignore($this->service->id, 'service_id')],
            'icon' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

}
