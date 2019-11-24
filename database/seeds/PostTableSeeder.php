<?php

use App\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,20) as $key => $value) {
            $title = $faker->text(80);

            Post::create([
                'title' => $title,
                'content' => $faker->paragraph(30),
                'slug' => Str::slug($title,'-'),
                'status' => 1,
                'user_id' => $faker->numberBetween($min = 1, $max = 5),
            ]);

        }
    }
}
