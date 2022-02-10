<?php

use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $_restaurant = new Restaurant();
            $_restaurant->name = $faker->sentence();
            $_restaurant->slug = Str::slug($_restaurant->name);
            $_restaurant->vat = $faker->randomFloat();
            $_restaurant->address = $faker->streetAddress();
            $_restaurant->restaurant_image = $faker->imageUrl(200, 200);
            $_restaurant->description = $faker->paragraph();
            $_restaurant->website = $faker->sentence();
            $_restaurant->phone = $faker->phoneNumber();
            $_restaurant->save();
        }
    }
}
