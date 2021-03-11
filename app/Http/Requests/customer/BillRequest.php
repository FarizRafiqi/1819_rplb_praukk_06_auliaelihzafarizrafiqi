<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
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
                'id_pelanggan' => 'nullable|numeric|exists:pln_customers,nomor_meter'
        ];
    }
    public function messages()
    {
        return [
                'id_pelanggan.numeric' => 'ID Pelanggan harus berupa angka',
                'id_pelanggan.exists' => 'ID Pelanggan tidak terdaftar',
        ];
    }
}
