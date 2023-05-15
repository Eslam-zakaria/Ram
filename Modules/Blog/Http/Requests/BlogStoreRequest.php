<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogStoreRequest extends FormRequest
{

    /**use Modules\Blog\Http\Requests\BlogUpdateRequest;
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
            'en.name' => 'nullable',
            'ar.name' => 'required',
            'en.content' => 'nullable',
            'ar.content' => 'required',
            'en.slug' => '|unique:blog_translations,slug',
            'ar.slug' => 'required|unique:blog_translations,slug',
            'category_id' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
