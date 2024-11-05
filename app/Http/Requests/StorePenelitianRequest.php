<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use Illuminate\Support\Str;

class StorePenelitianRequest extends FormRequest
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
            'plt_dosen_anggota' => isset($this->plt_dosen_anggota) ? implode(',', $this->plt_dosen_anggota) : $this->plt_dosen_anggota,
            'plt_anggota_mhs' => isset($this->plt_anggota_mhs) ? implode(',', $this->plt_anggota_mhs) : $this->plt_anggota_mhs,
            'plt_mulai' => Carbon::createFromFormat('d/m/Y', $this->plt_mulai)->format('Y-m-d'),
            'plt_selesai' => Carbon::createFromFormat('d/m/Y', $this->plt_selesai)->format('Y-m-d'),
            'plt_tahun' => isset($this->plt_tahun) ? Carbon::createFromFormat('Y', $this->plt_tahun)->format('Y') : $this->plt_tahun,
            'plt_jumlah' => (int)Str::replace(',', '', $this->plt_jumlah),
        ]);
    }
}
