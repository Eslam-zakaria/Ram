<?php

namespace Modules\Doctor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Doctor\Models\Doctor;

class DoctorUpdateRequest extends FormRequest
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
 
        $doctor = Doctor::where('id',$this->doctor_id)->first();

        return [
            'en.name' => 'required',
            'ar.name' => 'required',
            'en.description' => 'required',
            'ar.description' => 'required',
            'en.bio' => 'required',
            'ar.bio' => 'required',
            'en.slug' => ['required', 'max:255', Rule::unique('doctor_translations', 'slug')->where('locale', 'en')->ignore($this->doctor->id, 'doctor_id')],
            'ar.slug' => ['required', 'max:255', Rule::unique('doctor_translations', 'slug')->where('locale', 'ar')->ignore($this->doctor->id, 'doctor_id')],
            'years_of_experience' => 'required',
            'start_time' => '',
            'end_time' => '',
            'country_id' => 'required|numeric|min:1',
            'specialty_id' => 'required|numeric|min:1',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }


}
