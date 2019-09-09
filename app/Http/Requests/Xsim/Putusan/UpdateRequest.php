<?php

namespace App\Http\Requests\Xsim\Putusan;

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
            'judul' => 'required|min:6',
            'putusan_jenis_id' => 'required',
            'tahun' => 'required|min:4',
            'info' => 'required|min:6',
            'isi' => 'required|min:6'
        ];
    }
}
