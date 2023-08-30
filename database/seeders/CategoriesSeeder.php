<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;


class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Archery 1', 'sport_id' => 1, 'gender_id' => 1]);
        Category::create(['name' => 'Archery 2', 'sport_id' => 1, 'gender_id' => 2]);
        Category::create(['name' => 'Archery 3', 'sport_id' => 1, 'gender_id' => 1]);
        Category::create(['name' => 'Archery 4', 'sport_id' => 1, 'gender_id' => 2]);
        Category::create(['name' => 'Badminton 1', 'sport_id' => 2, 'gender_id' => 1]);
        Category::create(['name' => 'Badminton 2', 'sport_id' => 2, 'gender_id' => 2]);
        Category::create(['name' => 'Badminton 3', 'sport_id' => 2, 'gender_id' => 1]);
        Category::create(['name' => 'Badminton 4', 'sport_id' => 2, 'gender_id' => 2]);
        Category::create(['name' => 'Football 1', 'sport_id' => 3, 'gender_id' => 1]);
        Category::create(['name' => 'Football 2', 'sport_id' => 3, 'gender_id' => 2]);
        Category::create(['name' => 'Football 3', 'sport_id' => 3, 'gender_id' => 1]);
        Category::create(['name' => 'Football 4', 'sport_id' => 3, 'gender_id' => 2]);
    }
}
