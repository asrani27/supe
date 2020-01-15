<?php

use Illuminate\Database\Seeder;
use App\Sekolah;
use App\Role;
use App\User;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleSekolah= Role::where('name','sekolah')->first();
        $d = new User;
        $d->name = 'MI Sungai Lulut';
        $d->username = 'milulut';
        $d->email = 'milulut@gmail.com';
        $d->password = bcrypt('milulut');
        $d->save();
        $d->roles()->attach($roleSekolah);
        $s = new Sekolah;
        $s->nama = 'MI Sungai Lulut';
        $s->alamat = 'Jl Pramuka Km 6';
        $s->telp = '0511-124354';
        $s->users_id = $d->id;
        $s->save();
    }
}
