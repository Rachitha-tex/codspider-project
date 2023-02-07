<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    //validation for image
    public function rules()
    {
        return [
            'image_name'=>['required','image','mimes:png,jpg'],
            'category_id'=>['required','integer'],
            'product_id'=>['required','integer'],

        ];
    }
}
