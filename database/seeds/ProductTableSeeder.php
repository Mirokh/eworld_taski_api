<?php

use App\Eloquent\Category;
use App\Eloquent\Gallery;
use App\Eloquent\Product;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            $product = Product::query()->create([
                'title' => $faker->text(20),
                'description' => $faker->text(200),
            ]);

            $categories = Category::query()->inRandomOrder()->limit(rand(1, 3))->get();

            $product->categories()->sync($categories);

            $gallery = [];
            for ($j = 0; $j < rand(4, 8); $j++) {
                $gallery[] = new Gallery(['url' => 'https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80']);
            }

            $product->gallery()->saveMany($gallery);
        }
    }
}
