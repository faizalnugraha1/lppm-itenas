<?php

namespace Database\Seeders;

use App\Models\Hki;
use App\Models\Insentif;
use App\Models\Penelitian;
use App\Models\Pkm;
use App\Models\Publikasi;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Penelitian::create([
            'judul' => 'Contoh Judul Peneltian, Sudah Posted',
            'dosen_ketua_id' => 1,
            'dosen_anggota' => '3,7',
            'anggota_mhs' => '3,9',
            'jenis_hibah_id' => 3,
            'nama_mitra' => 'Baso Aci Mojok',
            'mulai' => '2022-02-18',
            'selesai' => '2022-04-02',
            'tahun' => '2022',
            'jumlah' => 1000000,
            'status' => 1
        ]);

        Penelitian::create([
            'judul' => 'Contoh Judul Peneltian, Masih Pending',
            'dosen_ketua_id' => 1,
            'dosen_anggota' => '3,7',
            'anggota_mhs' => '3,9',
            'jenis_hibah_id' => 3,
            'nama_mitra' => 'Tirta Wening',
            'mulai' => '2022-02-18',
            'selesai' => '2022-04-02',
            'tahun' => '2022',
            'jumlah' => 2500000,
            'status' => 0
        ]);

        Pkm::create([
            'judul' => 'Contoh Judul PKM, Sudah Posted',
            'dosen_ketua_id' => 1,
            'dosen_anggota' => '11,12',
            'anggota_mhs' => '29,31',
            'jenis_hibah_id' => 5,
            'nama_mitra' => 'SD Sukasenang',
            'mulai' => '2022-02-18',
            'selesai' => '2022-04-02',
            'tahun' => '2022',
            'jumlah' => 750000,
            'status' => 1
        ]);

        Pkm::create([
            'judul' => 'Contoh Judul PKM, Masih Pending',
            'dosen_ketua_id' => 1,
            'dosen_anggota' => '11,12',
            'anggota_mhs' => '29,31',
            'jenis_hibah_id' => 5,
            'nama_mitra' => 'SD Sukasenang',
            'mulai' => '2022-02-18',
            'selesai' => '2022-04-02',
            'tahun' => '2022',
            'jumlah' => 500000,
            'status' => 0
        ]);

        Insentif::create([
            'judul' => 'Contoh Judul Insentif, Sudah Posted',
            'dosen_ketua_id' => 2,
            'penulis_anggota' => '13,14',
            'jenis_insentif_id' => 5,
            'jenis_publikasi_id' => 10,
            'jurnal' => 'MIND Jurnal',
            'tahun' => '2021',
            'jumlah' => 1000000,
            'status' => 1
        ]);

        Insentif::create([
            'judul' => 'Contoh Judul Insentif, Masih Pending',
            'dosen_ketua_id' => 2,
            'penulis_anggota' => '13,14',
            'jenis_insentif_id' => 5,
            'jenis_publikasi_id' => 10,
            'jurnal' => 'MIND Jurnal',
            'tahun' => '2021',
            'jumlah' => 1250000,
            'status' => 0
        ]);

        Hki::create([
            'judul' => 'Contoh Judul HKI, Sudah Posted',
            'dosen_ketua_id' => 4,
            'penulis_anggota' => '2,3',
            'jenis_hki' => 'Hak Cipta',
            'tahun' => '2021',
            'jumlah' => 1000000,
            'status' => 1
        ]);

        Hki::create([
            'judul' => 'Contoh Judul HKI, Masih Pending',
            'dosen_ketua_id' => 4,
            'penulis_anggota' => '2,3',
            'jenis_hki' => 'Hak Cipta',
            'tahun' => '2022',
            'jumlah' => 2000000,
            'status' => 0
        ]);

        Publikasi::create([
            'judul' => 'Enhanced production of napthoquinone metabolite (shikonin) from cell suspension culture of Arnebia sp. and its up-scaling through bioreactor',
            'dosen_ketua_id' => 1,
            'penulis_anggota' => '3,7',
            'penulis_external' => 'Udin Sarudin',
            'jurnal'=> '3 Biotech',
            'url' => 'linkdoi.com',
            'jenis_publikasi_id' => 5,
            'sumber_dana' => 'Dikti',
            'lingkup' =>'Internasional',
            'tanggal_publish' => '2022-04-02',
            'tahun' => '2022',
            'jumlah' => 1000000,
            'status' => 1
        ]);

        Publikasi::create([
            'judul' => 'Spatial Organization of Fibroblast Nuclear Chromocenters: Component Tree Analysis',
            'dosen_ketua_id' => 1,
            'penulis_anggota' => '3,7',
            'penulis_external' => 'Udin Sarudin',
            'jurnal'=> 'Journal of Anatomy',
            'url' => 'MIT.com',
            'jenis_publikasi_id' => 7,
            'sumber_dana' => 'Pemerintah Non Dikti',
            'lingkup' =>'Internasional',
            'tanggal_publish' => '2022-01-02',
            'tahun' => '2022',
            'jumlah' => 2500000,
            'status' => 0
        ]);
    }
}
