<?php

namespace Modules\Branche\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrancheUpdateRequest extends FormRequest
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
            'country_id' => 'required|numeric|min:1',
            'phone' => 'required|numeric',
            'location' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

}
