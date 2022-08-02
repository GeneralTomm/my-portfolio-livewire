<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KaryawanRequest extends FormRequest
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
            'nama_karyawan'  => 'required',
            'jenis_kelamin'  => 'required',
            'no_telp_karyawan' => 'required|digits_between:10,13|numeric|starts_with:08',
            'email_karyawan' => 'required|email:rfc,dns',
            'tgl_bergabung' => 'required|date_format:Y-m-d',
            'status' => 'required',
            'id_role' => 'required'
        ];
    }
}
