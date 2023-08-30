<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sport;


class SportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sport::create(['name' => 'Archery']);
        Sport::create(['name' => 'Badminton']);
        Sport::create(['name' => 'Football']);
    }
}
