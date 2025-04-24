<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

            return [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
                'category_id' => 'required|exists:categories,id', 
                'tags' => 'nullable|array',
                'tags.*' => 'exists:tags,id',

            ];
        
    }
    public function messages()
    {
        return [
            'title.required' => 'Please provide a title for the article.',
            'description.required' => 'Please provide a description for the article.',
            'category_id.required' => 'Please select a category for the article.',
            'category_id.exists' => 'The selected category is invalid.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image size should not exceed 2MB.',
        ];
    }
}
