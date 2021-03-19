<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'print_per_date.*' => 'required_if:action,print_per_date|date|date_format:d-m-Y|nullable',
            'print_per_date.tanggal_akhir' => 'required_with:print_per_date.tanggal_awal',
        ];
    }

    public function messages()
    {
        return [
            'print_per_date.tanggal_awal.date' => 'Tanggal awal harus berupa tanggal',
            'print_per_date.tanggal_akhir.date' => 'Tanggal akhir harus berupa tanggal',
            'print_per_date.tanggal_awal.date_format' => 'Format tanggal awal salah, contoh: 01-01-2021',
            'print_per_date.tanggal_akhir.date_format' => 'Format tanggal akhir salah, contoh: 01-01-2021',
        ];
    }
}
