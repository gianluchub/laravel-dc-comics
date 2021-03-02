<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Character;

class CharactersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $characters = config('characters');

        foreach($characters as $character) {
            $newChar = new Character();
            $character["slug"] = Str::slug($character["name"]);
            $newChar->fill($character); // $fillable nel Model
            $newChar->save();
        }
    }
}
