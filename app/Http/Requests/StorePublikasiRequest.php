<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class StorePublikasiRequest extends FormRequest
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
            'pub_penulis_anggota' => isset($this->pub_penulis_anggota) ? implode(',', $this->pub_penulis_anggota) : $this->pub_penulis_anggota,
            'pub_tanggal_publish' => Carbon::createFromFormat('d/m/Y', $this->pub_tanggal_publish)->format('Y-m-d'),
            'pub_tahun' => isset($this->pub_tahun) ? Carbon::createFromFormat('Y', $this->pub_tahun)->format('Y') : $this->pub_tahun,
            'pub_jumlah' => (int)Str::replace(',', '', $this->pub_jumlah),
        ]);
    }
}
