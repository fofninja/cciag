<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\teste_table;
use App\Models\article;

class teste_tableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        article::factory()->count(10)->create();
    }
}
