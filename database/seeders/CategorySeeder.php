<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['id' => 1, 'name' => 'Listrik'],
            ['id' => 2, 'name' => 'Air'],
            ['id' => 3, 'name' => 'Bangunan'],
            ['id' => 4, 'name' => 'IT'],
            ['id' => 6, 'name' => 'Jaringan'],
            ['id' => 7, 'name' => 'Kendaraan'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['id' => $cat['id']],
                ['name' => $cat['name']]
            );
        }
    }
}
