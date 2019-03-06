<?php

use Illuminate\Database\Seeder;
use App\Admin;

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
        $admin->job_title = 'superadmin';
        $admin->password = Hash::make('456456');
        $admin->save();
    }
}
