<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dosen::create(['nama' => 'Asep Nana Hermana., S.T., M.T.','nip' => '20071202','password' => bcrypt('123456789'),'nidn' => '422116603','email' => 'asep_nana@itenas.ac.id','jurusan' => 'Informatika']);
        Dosen::create(['nama' => 'Dewi Rosmala, S.Si., M.IT.','nip' => '20040903','password' => bcrypt('123456789'),'nidn' => '422106801','email' => 'd_rosmala@itenas.ac.id','jurusan' => 'Informatika']);
        Dosen::create(['nama' => 'Irma Amelia Dewi, S.Kom., M.T.','nip' => '20110901','password' => bcrypt('123456789'),'nidn' => '430078701','email' => 'irma_amelia@itenas.ac.id','jurusan' => 'Informatika']);
        Dosen::create(['nama' => 'Jasman Pardede, Dr., S.Si., M.T.','nip' => '20060504','password' => bcrypt('123456789'),'nidn' => '426097801','email' => 'jasman@itenas.ac.id','jurusan' => 'Informatika']);
        Dosen::create(['nama' => 'Dr. sc. Lisa Kristiana, S.T., M.T.','nip' => '20070301','password' => bcrypt('123456789'),'nidn' => '425107503','email' => 'lisa@itenas.ac.id','jurusan' => 'Informatika']);
        Dosen::create(['nama' => 'Ir. Milda Gustiana Husada, M.Eng.','nip' => '20070802','password' => bcrypt('123456789'),'nidn' => '425086502','email' => 'mghusada@itenas.ac.id','jurusan' => 'Informatika']);
        Dosen::create(['nama' => 'Marisa Premitasari, S.T., M.T','nip' => '20141103','password' => bcrypt('123456789'),'nidn' => '-','email' => 'marisa@itenas.ac.id','jurusan' => 'Informatika']);
        Dosen::create(['nama' => 'Ir. Muhammad Ichwan, M.T.','nip' => '19920101','password' => bcrypt('123456789'),'nidn' => '409076101','email' => 'ichwan@itenas.ac.id','jurusan' => 'Informatika']);
        Dosen::create(['nama' => 'Uung Ungkawa, Dr., Ir., M.T.','nip' => '20071201','password' => bcrypt('123456789'),'nidn' => '411105902','email' => 'uung@itenas.ac.id','jurusan' => 'Informatika']);
        Dosen::create(['nama' => 'Dr. Ir. Winarno Sugeng, M.Kom.','nip' => '19891101','password' => bcrypt('123456789'),'nidn' => '420106301','email' => 'winarno@itenas.ac.id','jurusan' => 'Informatika']);
        Dosen::create(['nama' => 'Youllia Indrawaty Nurhasanah, S.T., M.T.','nip' => '19990102','password' => bcrypt('123456789'),'nidn' => '404057502','email' => 'youllia@itenas.ac.id','jurusan' => 'Informatika']);
        Dosen::create(['nama' => 'Yusup Miftahuddin, S.Kom., M.T.','nip' => '20110201','password' => bcrypt('123456789'),'nidn' => '415068801','email' => 'yusufm@itenas.ac.id','jurusan' => 'Informatika']);

    }
}
