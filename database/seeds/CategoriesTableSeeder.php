<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = config('categories');

        foreach($categories as $cat) {
            $newCat = new Category();
            $newCat->fill($cat); // $fillable
            $newCat->save();
        }
    }
}
