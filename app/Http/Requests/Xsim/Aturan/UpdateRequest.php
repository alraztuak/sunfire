<?php

namespace App\Http\Requests\Xsim\Aturan;

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
            'nomor' => 'required|min:6',
            'perihal' => 'required|min:6',
            'isi' => 'required|min:6',
            'aturan_topik' => 'required',
            'aturan_jenis' => 'required',
            'aturan_info' => 'required',
            'lampiran' => 'file',
            'pdf' => 'file'
        ];
    }
}
