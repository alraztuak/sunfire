<?php

namespace App\Http\Requests\Xsim\KursKode;

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
            'kode' => 'required|unique:kurs_kodes|min:3',
            'judul' => 'required|unique:kurs_kodes|min:5'
        ];
    }
}
