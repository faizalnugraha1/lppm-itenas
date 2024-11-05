<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dosen::create([
            'nama' => 'Fannie M Fadilah',
            'nip' => '152018002',
            'password' => bcrypt('123456789'),
            'nidn' => '54739872345978',
            'email' => 'fadilah@lppm.itenas.ac.id',
            'jurusan' => 'Informatika',
        ]);

        Dosen::create([
            'nama' => 'Gilang Rama',
            'nip' => '152018033',
            'password' => bcrypt('123456789'),
            'nidn' => '498277964525429',
            'email' => 'gilang@lppm.itenas.ac.id',
            'jurusan' => 'Informatika',
        ]);

        Pegawai::create([
            'nama' => 'Andika Fauzi',
            'nip' => '152018019',
            'jabatan' => 'Ketua',
            'password' => bcrypt('123456789'),
            'email' => 'andika@lppm.itenas.ac.id',
        ]);

        // Dosen::create(['nama' => '','nip' => '','password' => bcrypt('123456789'),'nidn' => '','email' => '','jurusan' => 'Informatika']);

    }
}
