<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSantriRequest extends FormRequest
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
    public function rules()
    {
        return [
            'nama' => 'required',
            'biaya_id' => 'required|exists:biayas,id',
            'nis' => 'required|unique:santris,nis,' . $this->santri,
            'wali_id' => 'nullable',
            'gender' => 'required',
            'kelas' => 'required',
            'jenis_spp' => 'required'
        ];
    }
}
