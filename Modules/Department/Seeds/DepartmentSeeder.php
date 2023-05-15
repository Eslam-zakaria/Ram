<?php

namespace Modules\Department\Seeds;

use Illuminate\Database\Seeder;
use Modules\Department\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            "ar" => [
                "name" => "جرافيكس"
            ],
            "en" => [
                "name" => "Graphics"
            ]
        ]);
    }
}
