<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Membuat User Non Feeder
        $roleSuperAdmin = Role::where('name','superadmin')->first();

        $d = new User;
        $d->name = 'superadmin';
        $d->username = 'superadmin';
        $d->email = 'superadmin@gmail.com';
        $d->password = bcrypt('admin');
        $d->save();
        $d->roles()->attach($roleSuperAdmin);

    }
}
