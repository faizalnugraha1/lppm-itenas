<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreInsentifRequest extends FormRequest
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
            'ins_dosen_anggota' => isset($this->ins_dosen_anggota) ? implode(',', $this->ins_dosen_anggota) : $this->ins_dosen_anggota,
            'ins_tahun' => isset($this->ins_tahun) ? Carbon::createFromFormat('Y', $this->ins_tahun)->format('Y') : $this->ins_tahun,
            'ins_jumlah' => (int)Str::replace(',', '', $this->ins_jumlah),
        ]);
    }
}
