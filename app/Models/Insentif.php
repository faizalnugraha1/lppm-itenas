<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insentif extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'judul',
        'dosen_ketua_id',
        'penulis_anggota',
        'jenis_insentif_id',
        'jenis_publikasi_id',
        'jurnal',
        'tahun',
        'jumlah',
        'status'
    ];

    public function dosen_ketua(){
    	return $this->belongsTo(Dosen::class);
    }

    public function jenis_insentif(){
    	return $this->belongsTo(Ref_jenisinsentif::class);
    }

    public function jenis_publikasi(){
    	return $this->belongsTo(Ref_jenispublikasi::class);
    }

    public function getDosenAnggota(){
        return  Dosen::findMany(explode(',', $this->penulis_anggota));
    }
    public function getjurusan(){
        $j =[];
        $ketua = Dosen::find( $this->dosen_ketua_id);
        array_push($j, $ketua->jurusan);
        $anggota = Dosen::findMany(explode(',', $this->dosen_anggota));
        foreach ($anggota as $a){
            array_push($j, $a->jurusan);
        }
        $j = array_unique($j);
        $j = implode(", ",$j);
        return $j;
    }

    public function getMhsAnggota(){
        return Mahasiswa::findMany(explode(',', $this->anggota_mhs));
    }
}
