<?php

namespace Database\Seeders;

use App\Models\Departement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $depts = [
            ['name' => 'Accounting'],
            ['name' => 'Business Development'],
            ['name' => 'Engineering'],
            ['name' => 'Human Resources'],
            ['name' => 'Legal'],
            ['name' => 'Marketing'],
            ['name' => 'Product Management'],
            ['name' => 'Sales'],
            ['name' => 'Training']
        ];
    
        foreach ($depts as $item) {
            Departement::create($item);
        }
    }
}
