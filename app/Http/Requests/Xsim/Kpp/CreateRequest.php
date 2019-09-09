<?php

namespace App\Http\Requests\Xsim\Kpp;

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
            'nama' => 'required|unique:kpps|min:5',
            'kpp_jenis_id' => 'required',
            'kodekpp' => 'required|min:4',
            'kodewil' => 'required|min:4',
            'kota' => 'required|min:6',
            'alamat' => 'required|min:6'
        ];
    }
}
