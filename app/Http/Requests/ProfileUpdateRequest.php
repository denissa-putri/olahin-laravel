<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /** @return array<string, ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        $userId = $this->user()->id_user;
        return [
            'username' => ['required', 'string', 'max:50', Rule::unique(User::class, 'username')->ignore($userId, 'id_user')],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', Rule::unique(User::class, 'email')->ignore($userId, 'id_user')],
            'kategori_mhs' => ['nullable', 'string', 'max:50'],
            'hobi' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
        ];
    }
}
