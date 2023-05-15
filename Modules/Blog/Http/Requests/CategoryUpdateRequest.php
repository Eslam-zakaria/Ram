<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
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
            // 'en.slug' => 'required',
            // 'ar.slug' => 'required',
            'en.slug' => ['nullable', 'max:255', Rule::unique('blog_category_translations', 'slug')->where('locale', 'en')->ignore($this->blog_category->id, 'blog_category_id')],
            'ar.slug' => ['required', 'max:255', Rule::unique('blog_category_translations', 'slug')->where('locale', 'ar')->ignore($this->blog_category->id, 'blog_category_id')],
        ];
    }

}
