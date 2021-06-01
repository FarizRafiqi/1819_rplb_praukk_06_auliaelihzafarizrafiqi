<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MatchOldPassword;
use Illuminate\Validation\Rule;

class UserProfileRequest extends FormRequest
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
            'nama' => 'required|string|min:3',
            'username' => 'required|string|min:3',
            'email' => ['required','email', Rule::unique('users')->ignore(auth()->id())],
            'id_level' => 
                    [
                        'required', 
                        'exists:levels,id', 
                        Rule::unique('users')->where(function($query){
                            return $query->where('id_level', 1);
                        })->ignore(auth()->id())
                    ],
            'gambar' => 'mimes:jpg,png|max:2048',
            'current_password' => ['nullable', new MatchOldPassword],
            'password' => 'nullable|required_with:current_password|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama tidak boleh kosong!',
            'nama.string' => 'Nama harus berupa karakter!',
            'nama.min' => 'Nama harus lebih dari atau sama dengan 3 karakter!',
            'username.required' => 'Username tidak boleh kosong!',
            'username.string' => 'Username harus berupa karakter!',
            'username.min' => 'Username tidak boleh kurang dari 3 karakter!',
            'email.required' => 'Email tidak boleh kosong!',
            'email.email' => 'Email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'id_level.required' => 'Level tidak boleh kosong!',
            'id_level.exist' => 'Level tidak ada di database!',
            'id_level.unique' => 'Level admin sudah ada',
            'gambar.max' => ['file' => 'Ukuran gambar maksimal :max KB'],
            'password.required_with' => 'Password tidak boleh kosong!',
            'password.min' => 'Password tidak boleh kurang dari 6 karakter!',
            'password.confirmed' => 'Password dan konfirmasi password harus sama!',
        ];
    }
}
