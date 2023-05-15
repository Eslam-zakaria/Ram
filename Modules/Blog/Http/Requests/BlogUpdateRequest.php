<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogUpdateRequest extends FormRequest
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
            'en.name' => 'nullable',
            'ar.name' => 'required',
            'en.content' => 'nullable',
            'ar.content' => 'required',
            // 'en.slug' => 'nullable',
            // 'ar.slug' => 'required',
            'en.slug' => ['nullable', 'max:255', Rule::unique('blog_translations', 'slug')->where('locale', 'en')->ignore($this->blog->id, 'blog_id')],
            'ar.slug' => ['required', 'max:255', Rule::unique('blog_translations', 'slug')->where('locale', 'ar')->ignore($this->blog->id, 'blog_id')],
            'category_id' => 'required|numeric|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

}
