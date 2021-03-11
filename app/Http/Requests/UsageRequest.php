<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsageRequest extends FormRequest
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
        $daftarBulan = [
            'Januari', 'Februari', 'Maret', 'April', 
            'Mei', 'Juni', 'Juli', 'Agustus', 
            'September', 'Oktober', 'November', 'Desember'
        ];

        $bulan = $this->bulan;
        $tahun = $this->tahun;
        $idPelanggan = $this->id_pelanggan_pln;

        return [
            'id_pelanggan_pln' => 'required|numeric|exists:pln_customers,id',
            'bulan' => [
                'required', 
                Rule::in($daftarBulan),
                Rule::unique('usages')->where(function($query) use ($bulan, $tahun, $idPelanggan){
                    return $query->where('id_pelanggan_pln', $idPelanggan)
                                 ->where('bulan', $bulan)
                                 ->where('tahun', $tahun);
                })->ignore($this->id)
            ],
            'tahun' => 'required|date_format:Y|date_equals:'.now()->year,
            'meter_awal' => 'required|numeric',
            'meter_akhir' => 'numeric|nullable|required_with:meter_awal|gt:meter_awal',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'bulan' => ucfirst($this->bulan),
        ]);
    }

    public function messages()
    {
        return [
            'id_pelanggan_pln.required' => 'ID Pelanggan tidak boleh kosong', 
            'bulan.required' => 'Bulan tidak boleh kosong', 
            'tahun.required' => 'ID Pelanggan tidak boleh kosong', 
            'meter_awal.required' => 'ID Pelanggan tidak boleh kosong', 
            'id_pelanggan_pln.numeric' => 'ID Pelanggan harus berupa angka', 
            'meter_awal.numeric' => 'Meter awal harus berupa angka', 
            'meter_akhir.numeric' => 'Meter akhir berupa angka',
            'id_pelanggan_pln.exists' => 'ID Pelanggan tidak terdaftar',
            'bulan.unique' => 'Bulan yang dimasukkan sudah ada di tahun tersebut',
            'tahun.date_format' => 'Tahun tidak sesuai dengan format, harus 4 digit',
            'meter_akhir.gt' => 'Meter akhir harus lebih besar dari meter awal',
        ];
    }
}
