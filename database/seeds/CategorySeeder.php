<?php

use App\Models\Category;
use Illuminate\Database\Seeder;



class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['italiano', 'cinese', 'giapponese', 'messicano', 'pesce', 'carne', 'pizza'];
        foreach ($categories as $category) {
            $cat = new Category();
            $cat->name = $category;
            $cat->category_image = 'https://picsum.photos/200/300';
            $cat->save();
        }
    }
}
