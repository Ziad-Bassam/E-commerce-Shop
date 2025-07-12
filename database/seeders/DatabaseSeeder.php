<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $categories = [
            ['id' => 1 , 'name' => 'food' , 'description' => '' , 'image_path' => 'assets\img\food.jpg'],
            ['id' => 2 , 'name' => 'electronics' , 'description' => '' , 'image_path' => 'assets\img\electronics.jpg'],
            ['id' => 3 , 'name' => 'bags' , 'description' => '' , 'image_path' => 'assets\img\bags.jpeg'],
            ['id' => 4 , 'name' => 'watches' , 'description' => '' , 'image_path' => 'assets\img\watches.jpg'],
            ['id' => 5 , 'name' => 'makeup' , 'description' => '' , 'image_path' => 'assets\img\makeup.jpeg'],
            ['id' => 6 , 'name' => 'clothes' , 'description' => '' , 'image_path' => 'assets\img\clothes.jpg'],
        ];

        DB::table('categories')->insertOrIgnore($categories);





        // $faker = Faker::create();

        // for ($i = 1; $i <= 10; $i++) {
        //     $productName = 'Product ' . $i;

        //     // التحقق من وجود المنتج بالفعل
        //     if (DB::table('products')->where('name', $productName)->exists()) {
        //         continue; // تجاهل المنتج الموجود
        //     }

        //     DB::table('products')->insert([
        //         'name' => $productName,
        //         'description' => 'this product ' . $i ,
        //         'price' => $faker->randomFloat(2, 10, 1000), // سعر عشوائي بين 10 و 1000
        //         'quantity' => $faker->numberBetween(1, 100), // كمية عشوائية بين 1 و 100
        //         'category_id' => $faker->numberBetween(1, 5), // افترض وجود 5 فئات
        //         'image_path' => $faker->imageUrl(), // رابط صورة عشوائي
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
    }
}
