<?php

use Illuminate\Database\Seeder;
use App\Restaurant;


class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
