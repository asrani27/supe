<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Skpd;
use App\User;

class SkpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleSkpd= Role::where('name','skpd')->first();
        $d = new User;
        $d->name = 'Dinas Komunikasi, Informatika Dan Statisktik';
        $d->username = 'diskominfo';
        $d->email = 'diskominfotik@gmail.com';
        $d->password = bcrypt('admin');
        $d->save();
        $d->roles()->attach($roleSkpd);
        $s = new Skpd;
        $s->nama = 'Dinas Komunikasi, Informatika Dan Statisktik';
        $s->users_id = $d->id;
        $s->save();

        
        $d2 = new User;
        $d2->name = 'Dinas Pariwisata';
        $d2->username = 'dispar';
        $d2->email = 'dispar@gmail.com';
        $d2->password = bcrypt('admin');
        $d2->save();
        $d2->roles()->attach($roleSkpd);
        $s2 = new Skpd;
        $s2->nama = 'Dinas Pariwisata';
        $s2->users_id = $d2->id;
        $s2->save();
    }
}
