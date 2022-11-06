<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObatUpdateRequest extends FormRequest
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
            'kode' => 'required',
            'kategori_obat_id' => 'required',
            'nama' => 'required',
            'dosis' => 'required',
            'harga' => 'required',
            'tanggal_produksi' => 'required',
            'tanggal_kadaluarsa' => 'required'
        ];
    }
}
