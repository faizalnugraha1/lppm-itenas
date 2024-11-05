<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreHkiRequest extends FormRequest
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
            'hki_dosen_anggota' => isset($this->hki_dosen_anggota) ? implode(',', $this->hki_dosen_anggota) : $this->hki_dosen_anggota,
            'hki_tahun' => isset($this->hki_tahun) ? Carbon::createFromFormat('Y', $this->hki_tahun)->format('Y') : $this->hki_tahun,
            'hki_jumlah' => (int)Str::replace(',', '', $this->hki_jumlah),
        ]);
    }
}
