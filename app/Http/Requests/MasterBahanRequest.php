<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MasterBahanRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'id_kategori' => ['required', 'integer', 'exists:master_kategori,id_kategori'],
            'nama_bahan' => ['required', 'string', 'max:150'],
            'satuan_terkecil' => ['required', 'string', 'max:50'],
            'harga_estimasi' => ['required', 'integer', 'min:0'],
        ];
    }
}
