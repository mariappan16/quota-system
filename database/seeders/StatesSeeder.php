<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;


class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        State::create(['name' => 'Goa']);
        State::create(['name' => 'Madhya Pradesh']);
        State::create(['name' => 'Uttar Pradesh']);
        State::create(['name' => 'Tamil Nadu']);
        State::create(['name' => 'Delhi']);
    }
}
