<?php

namespace App\Http\Requests\Admin;

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
            'level' => 'required|string|unique:levels',
            'permissions.*' => 'integer',
            'permissions' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'level.required' => 'Level tidak boleh kosong',
            'level.string' => 'Level harus berupa string',
            'level.unique' => 'Level '.$this->request->get('level').' sudah ada', 
            'permissions.*.integer' => 'ID permission harus berupa angka', 
            'permissions.required' => 'Permission tidak boleh kosong', 
            'permissions.array' => 'Permission harus berupa array', 
        ];
    }
}
