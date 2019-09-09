<?php

namespace App\Http\Requests\Xsim\AturanTopik;

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
            'id' => 'required|unique:aturan_topiks',
            'judul' => 'required|unique:aturan_topiks|min:2'
        ];
    }
}
