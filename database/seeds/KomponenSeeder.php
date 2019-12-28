<?php

use Illuminate\Database\Seeder;
use App\Komponen;

class KomponenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $k = new Komponen;
        $k->nama = 'Manajemen Perubahan';
        $k->bobot = 5;
        $k->save();
        
        $k = new Komponen;
        $k->nama = 'Penataan Tatalaksana';
        $k->bobot = 5;
        $k->save();
        
        $k = new Komponen;
        $k->nama = 'Penataan Sistem Manajemen SDM';
        $k->bobot = 15;
        $k->save();
        
        $k = new Komponen;
        $k->nama = 'Penguatan Akuntabilitas Kinerja';
        $k->bobot = 10;
        $k->save();
        
        $k = new Komponen;
        $k->nama = 'Penguatan Pengawasan';
        $k->bobot = 15;
        $k->save();
        
        $k = new Komponen;
        $k->nama = 'Penguatan Kualitas Pelayanan Publik';
        $k->bobot = 10;
        $k->save();
    }
}
