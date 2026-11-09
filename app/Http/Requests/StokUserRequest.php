<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StokUserRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'id_bahan' => ['nullable', 'integer', 'exists:master_bahan,id_bahan'],
            'nama_bahan_custom' => ['nullable', 'string', 'max:100', 'required_without:id_bahan'],
            'kategori_custom' => ['nullable', 'string', 'max:50'],
            'kuantitas' => ['required', 'string', 'max:50'],
            'tanggal_kadaluarsa' => ['required', 'date'],
        ];
    }
}
