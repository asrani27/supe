<?php

use Illuminate\Database\Seeder;
use App\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $k = new Kategori;
        $k->nama = 'Fakta Integritas';
        $k->jenis = 'zi';
        $k->save();
        
        $k = new Kategori;
        $k->nama = 'Dokumen Lainnya';
        $k->jenis = 'zi';
        $k->save();

        $k = new Kategori;
        $k->nama = 'Nilai Akuntabilitas Kinerja Instansi Pemerintah';
        $k->jenis = 'wbk';
        $k->save();
        
        $k = new Kategori;
        $k->nama = 'Dokumen Opini dari BPK';
        $k->jenis = 'wbk';
        $k->save();
        
        $k = new Kategori;
        $k->nama = 'Penilaian dari TPI';
        $k->jenis = 'wbbm';
        $k->save();

    }
}
