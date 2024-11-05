<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hki extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'judul',
        'jenis_hki',
        'dosen_ketua_id',
        'penulis_anggota',
        'tahun',
        'jumlah',
        'status'
    ];

    public function dosen_ketua(){
    	return $this->belongsTo(Dosen::class);
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

    public function getlistdosen(){
        $j =[];
        $ketua = Dosen::find( $this->dosen_ketua_id);
        array_push($j,[ $ketua->nama,$ketua->nip]);
        $anggota = Dosen::findMany(explode(',', $this->penulis_anggota));
        foreach ($anggota as $a){
            array_push($j, [ $a->nama,$a->nip]);
        }
        
        return $j;
    }

}
