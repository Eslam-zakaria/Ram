<?php

namespace Modules\Casing\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CasingStoreRequest extends FormRequest
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
           'image_before' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
           'image_after' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'doctor_id' => 'required|numeric|min:1',
            'category_id' => 'required|numeric|min:1',
        ];
    }

}
