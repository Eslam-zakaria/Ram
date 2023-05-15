<?php

namespace Modules\Doctor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorStoreRequest extends FormRequest
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
            'en.bio' => 'required',
            'ar.bio' => 'required',
            'en.slug' => 'required|unique:doctor_translations,slug',
            'ar.slug' => 'required|unique:doctor_translations,slug',
            'years_of_experience' => 'required',
            'start_time' => '',
            'end_time' => '',
            'country_id' => 'required|numeric|min:1',
            'specialty_id' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

}
