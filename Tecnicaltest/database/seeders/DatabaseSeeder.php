<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\Product::factory(15)->create();
        // \App\Models\Category::factory(5)->create();

        $product = \App\Models\Product::factory(15)
                        ->has(\App\Models\Category::factory(), 'categories')
                        ->create();
    }
}
