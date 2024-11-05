<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class StorePkmRequest extends FormRequest
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
            //
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'pkm_dosen_anggota' => isset($this->pkm_dosen_anggota) ? implode(',', $this->pkm_dosen_anggota) : $this->pkm_dosen_anggota,
            'pkm_anggota_mhs' => isset($this->pkm_anggota_mhs) ? implode(',', $this->pkm_anggota_mhs) : $this->pkm_anggota_mhs,
            'pkm_mulai' => Carbon::createFromFormat('d/m/Y', $this->pkm_mulai)->format('Y-m-d'),
            'pkm_selesai' => Carbon::createFromFormat('d/m/Y', $this->pkm_selesai)->format('Y-m-d'),
            'pkm_tahun' => isset($this->pkm_tahun) ? Carbon::createFromFormat('Y', $this->pkm_tahun)->format('Y') : $this->pkm_tahun,
            'pkm_jumlah' => (int)Str::replace(',', '', $this->pkm_jumlah),
        ]);
    }
}