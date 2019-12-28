<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Membuat role admin 
        $adminRole = new Role();
        $adminRole->name = "superadmin";
        $adminRole->display_name = "SuperAdmin";
        $adminRole->save();

        //Membuat role sekolah
        $dosenRole = new  Role();
        $dosenRole->name = "sekolah";
        $dosenRole->display_name = "sekolah";
        $dosenRole->save();
    }
}
