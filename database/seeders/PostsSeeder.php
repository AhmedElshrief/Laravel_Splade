<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Post;
use App\Models\Category;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('en_US');

        
        $cat_data = collect([]);
    
        for ($i = 1; $i <= 11; $i++) {
            $cat_data->push([
                'name' => $faker->unique()->name,
                'slug' => $faker->unique()->name(),

                // ...
            ]);
        }
        
        $chunks = $cat_data->chunk(5);
        
         foreach ($chunks as $chunk) {
             Category::insert($chunk->toArray());
         }

         $post_data = collect([]);
    
         for ($i = 1; $i <= 101; $i++) {
             $post_data->push([
                 'title' => $faker->unique()->name,
                 'slug' => $faker->unique()->name(),
                 'category_id' => $faker->numberBetween($min = 1, $max = 10),
                 'descr' => $faker->sentence(30),
                 'description' => $faker->sentence(),

             ]);
         }
         
         $chunks = $post_data->chunk(50);
         
          foreach ($chunks as $chunk) {
              Post::insert($chunk->toArray());
          }

    }
}
