<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LevelRequest extends FormRequest
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
            'level' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'level.required' => 'Level tidak boleh kosong',
            'level.string' => 'Level harus berupa string' 
        ];
    }
}
