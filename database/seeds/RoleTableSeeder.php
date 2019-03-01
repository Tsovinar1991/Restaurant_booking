<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $role_admin = new Role();
        $role_admin->name = 'superadmin';
        $role_admin->description = 'A Super Admin User';
        $role_admin->save();


        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'An Admin User';
        $role_admin->save();

        $role_manager = new Role();
        $role_manager->name = 'manager';
        $role_manager->description = 'A Manager User';
        $role_manager->save();

        $role_delivery = new Role();
        $role_delivery->name = 'delivery';
        $role_delivery->description = 'A Delivery User';
        $role_delivery->save();

        $role_waiter = new Role();
        $role_waiter->name = 'waiter';
        $role_waiter->description = 'A waiter User';
        $role_waiter->save();
    }
}
