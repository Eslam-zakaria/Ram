<?php

namespace Modules\Video\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoUpdateRequest extends FormRequest
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
            'doctor_id' => 'required|numeric|min:1',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'video' => 'mimes:mp4,mov,ogg,avi | max:20000',
        ];
    }

}
