<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nota;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Nota::factory(15)->create();
    }
}