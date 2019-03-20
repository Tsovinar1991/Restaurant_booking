<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
use App\AdminRole;
use App\Role;
use App\Admin;
use App\Menu;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        //seeding Restaurant
        $restaurant = new Restaurant();
        $restaurant->city_id = 1;
        $restaurant->name = 'Famous';
        $restaurant->type = 'restaurant';
        $restaurant->description = 'Special restaurant';
        $restaurant->avatar = 'Something.jpg';
        $restaurant->address = 'bdjwb dwjkn dkwndkwndkw';
        $restaurant->tel = '077 23 60 84';
        $restaurant->email = 'tsovinar.nemesida.grigoryan@gmail.com';
        $restaurant->open_hour = '09:00';
        $restaurant->close_hour = '23:00';
        $restaurant->save();



        //seeding Role
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



        //seeding superadmin
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



//       $this->call(RestaurantSeeder::class);
//        $this->call(RoleTableSeeder::class);
//        $this->call(SuperAdminSeeder::class);
    }
}
