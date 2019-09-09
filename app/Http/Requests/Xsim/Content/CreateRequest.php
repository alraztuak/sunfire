<?php

namespace App\Http\Requests\Xsim\Content;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'judul' => 'required|unique:contents|min:6',
            'sumber' => 'required|min:6',
            'url' => 'required|url',
            'isi' => 'required|min:6',
            'splash' => 'image|mimes:jpeg,png,gif,webp|max:2048'
        ];
    }
}
