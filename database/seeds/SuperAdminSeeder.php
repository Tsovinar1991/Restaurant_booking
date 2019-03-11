<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\AdminRole;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->name = 'Artak';
        $admin->email = 'artak@brainfors.com';
        $admin->job_title = 'Superadmin';
        $admin->password = Hash::make('456456');
        $admin->save();

        $role = new AdminRole;
        $role->role_id = 1;
        $role->admin_id = $admin->id;
        $role->save();


    }
}
