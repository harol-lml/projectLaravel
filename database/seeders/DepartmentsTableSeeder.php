<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar la tabla
        Department::truncate();

        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            DB::table('departments')->insert([
                'name' => $faker->name,
                'description' => $faker->text(180)
            ]);
        }
    }
}
