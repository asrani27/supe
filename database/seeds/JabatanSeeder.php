<?php

use Illuminate\Database\Seeder;
use App\Jabatan;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $s = new Jabatan;
        $s->nama = 'Kepala Sekolah';
        $s->save();
        
        $s = new Jabatan;
        $s->nama = 'Wakil Kepala Sekolah';
        $s->save();

        $s = new Jabatan;
        $s->nama = 'Guru';
        $s->save();
        
        $s = new Jabatan;
        $s->nama = 'Staff';
        $s->save();

    }
}
