<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\Outlet;
use Illuminate\Database\Seeder;

class OfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $office = Office::factory()
        ->has(Outlet::factory()->count(5), 'outlets')
        ->create();
    }
}
