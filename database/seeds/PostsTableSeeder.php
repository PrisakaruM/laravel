<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => Str::random(10),
            'description' => Str::random(50),
            'content' => Str::random(300),
            'image' => Str::random(3).'.jpg',
        ]);

        // $posts = factory(App\Posts::class, 50)->create();
    }
}
