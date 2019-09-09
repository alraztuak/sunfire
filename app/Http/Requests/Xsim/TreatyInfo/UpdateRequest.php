<?php

namespace App\Http\Requests\Xsim\TreatyInfo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'kode' => 'required|min:3',
            'indonesia' => 'required|min:3',
            'english' => 'required|min:3',
            'splash' => 'required'
        ];
    }
}
