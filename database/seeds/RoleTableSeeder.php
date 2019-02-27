<?php

use Illuminate\Database\Seeder;
use App\AdminRoles;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new AdminRoles();
        $role_admin->name = 'admin';
        $role_admin->description = 'An Admin User';
        $role_admin->save();

        $role_manager = new AdminRoles();
        $role_manager->name = 'manager';
        $role_manager->description = 'A Manager User';
        $role_manager->save();

        $role_delivery = new AdminRoles();
        $role_delivery->name = 'delivery';
        $role_delivery->description = 'A Delivery User';
        $role_delivery->save();

        $role_waiter = new AdminRoles();
        $role_waiter->name = 'waiter';
        $role_waiter->description = 'A waiter User';
        $role_waiter->save();
    }
}
