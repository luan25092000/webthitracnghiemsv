<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedBackRequest extends FormRequest
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
            'title'    => 'required',
            'content' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Nội dung không được để trống',
            'title.required' => 'Tiêu đề không được để trống',
            'content.max' => 'Nội dung không được quá 255 ký tự'
        ];
    }
}
