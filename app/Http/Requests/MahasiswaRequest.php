<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MahasiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'nim' => [
                'required',
                'string',
                'max:20',
            ],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'alamat' => ['required', 'string'],
            'jurusan_id' => ['required', 'exists:jurusan,id'],
            'prodi_id' => ['required', 'exists:prodi,id'],
            'angkatan' => ['required', 'numeric', 'digits:4'],
            'status' => ['required', 'in:aktif,cuti,lulus,do'],
        ];

        // Only require password on create
        if ($this->isMethod('post')) {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
            $rules['email'][] = 'unique:users,email';
            $rules['nim'][] = 'unique:mahasiswas,nim';
        } else {
            $rules['password'] = ['nullable', 'string', 'min:8', 'confirmed'];

            // For update, check unique but ignore current record
            $mahasiswa = $this->route('mahasiswa');
            $rules['email'][] = Rule::unique('users', 'email')->ignore($mahasiswa->user_id);
            $rules['nim'][] = Rule::unique('mahasiswas', 'nim')->ignore($mahasiswa->id);
        }

        return $rules;
    }
}
