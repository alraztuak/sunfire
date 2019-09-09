<?php

namespace App\Http\Requests\Xsim\Treaty;

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
            'judul' => 'required|unique:treaties|min:6',
            'treaty_jenis_id' => 'required',
            'treaty_info_id' => 'required',
            'isi_id' => 'required|min:6',
            'isi_en' => 'required|min:6'
        ];
    }
}
