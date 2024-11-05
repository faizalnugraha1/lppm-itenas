<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publikasi extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'judul',
        'dosen_ketua_id',
        'ketua_external',
        'penulis_anggota',
        'penulis_external',
        'jurnal',
        'url',
        'jenis_publikasi_id',
        'sumber_dana',
        'lingkup',
        'tanggal_publish',
        'tahun',
        'jumlah',
        'status'
    ];

    public function dosen_ketua(){
    	return $this->belongsTo(Dosen::class);
    }

    public function jenis_publikasi(){
    	return $this->belongsTo(Ref_publikasijenis::class);
    }

    public function getPenulisInternal()
    {
        return Dosen::findMany(explode(',', $this->penulis_anggota));
    }

    public function getPenulisExternal()
    {
        return explode(';', $this->penulis_external);
    }
    
    public function getjurusan(){
        $j =[];
        $ketua = Dosen::find( $this->dosen_ketua_id);
        array_push($j, $ketua->jurusan);
        $anggota = Dosen::findMany(explode(',', $this->penulis_anggota));
        foreach ($anggota as $a){
            array_push($j, $a->jurusan);
        }
        $j = array_unique($j);
        $j = implode(", ",$j);
        return $j;
    }
}
