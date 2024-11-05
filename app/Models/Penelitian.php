<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penelitian extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'judul',
        'dosen_ketua_id',
        'dosen_anggota',
        'anggota_mhs',
        'jenis_hibah_id',
        'nama_mitra',
        'mulai',
        'selesai',
        'tahun',
        'jumlah',
        'status'
    ];

    public function dosen_ketua(){
    	return $this->belongsTo(Dosen::class);
    }

    public function getDosenAnggota(){
        return  Dosen::findMany(explode(',', $this->dosen_anggota));
    }

    public function jenis_hibah(){
    	return $this->belongsTo(Ref_jenishibah::class);
    }

    public function getMhsAnggota(){
        return Mahasiswa::findMany(explode(',', $this->anggota_mhs));
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

    public function getlistdosen(){
        $j =[];
        $ketua = Dosen::find( $this->dosen_ketua_id);
        array_push($j,[ $ketua->nama,$ketua->nip]);
        $anggota = Dosen::findMany(explode(',', $this->dosen_anggota));
        foreach ($anggota as $a){
            array_push($j, [ $a->nama,$a->nip]);
        }
        
        return $j;
    }

}