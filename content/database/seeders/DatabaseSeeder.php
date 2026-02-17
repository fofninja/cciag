<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\teste_table;
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
        \App\Models\teste_table::factory()->count(50)->create();
    }
}
