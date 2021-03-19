<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TariffRequest extends FormRequest
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
            'golongan_tarif' => 'required|string',
            'daya' => 'required|numeric',
            'tarif_per_kwh' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'golongan_tarif.required' => 'Golongan tarif tidak boleh kosong',
            'daya.required' => 'Daya tidak boleh kosong',
            'tarif_per_kwh.required' => 'Tarif Per KwH tidak boleh kosong',
            'daya.numeric' => 'Daya harus berupa angka',
            'tarif_per_kwh.numeric' => 'Tarif Per KwH harus berupa angka',
        ];
    }
}
