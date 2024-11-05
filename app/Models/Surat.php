<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{

    protected $fillable = [
        'pembuat_id',
        'jenis_surat',
        'no_surat',
        'nama_kegiatan',
        'kegiatan_id',
        'qr',
    ];

    public function getPembuat(){
        return  Pegawai::find($this->pembuat_id);
    }

    public function getKegiatan(){
        if($this->nama_kegiatan == 'Pengabdian Kepada Masyarakat'){
            return Pkm::find($this->kegiatan_id);
        // }elseif($this->nama_kegiatan == 'Insentif'){
        //     return Insentif::find($this->kegiatan_id);
        }elseif($this->nama_kegiatan == 'Hak Kekayaan Intelektual'){
            return Hki::find($this->kegiatan_id);
        }elseif($this->nama_kegiatan == 'Penelitian'){
            return Penelitian::find($this->kegiatan_id);
        }elseif($this->nama_kegiatan == 'Publikasi'){
            return Publikasi::find($this->kegiatan_id);
        }
    }
}
