<?php

namespace Modules\Service\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceStoreRequest extends FormRequest
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
            'en.slug' => 'required|unique:service_translations,slug',
            'ar.slug' => 'required|unique:service_translations,slug',
            'icon' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

}
