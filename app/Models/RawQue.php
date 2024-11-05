<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawQue extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_name',
        'id',
        'jumlah',
        'status',
        'updated_at',
    ];

    public function getKegiatan(){
        if($this->table_name == 'Pkm'){
            return Pkm::find($this->id);
        }elseif($this->table_name == 'Insentif'){
            return Insentif::find($this->id);
        }elseif($this->table_name == 'HKI'){
            return Hki::find($this->id);
        }elseif($this->table_name == 'Penelitian'){
            return Penelitian::find($this->id);
        }elseif($this->table_name == 'Publikasi'){
            return Publikasi::find($this->id);
        }
    }
}
