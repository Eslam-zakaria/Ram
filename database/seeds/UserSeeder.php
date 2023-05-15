<?php

use App\Constants\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Islam Gad',
            'email' => 'tech@jumppeak.net',
            'password' =>'password',
            'role' => Roles::ADMIN,
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'Rowaida Muhammad',
            'email' => 'rowaida.muhammad@jumppeak.net',
            'password' =>'rowaida@jumppeak',
            'role' => Roles::ADMIN,
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'Eslam zakaria',
            'email' => 'eslam.zakaria@jumppeak.net',
            'password' =>'eslam@jumppeak',
            'role' => Roles::ADMIN,
            'email_verified_at' => now()
        ]);
        

        //factory(User::class, 100)->create();
    }
}
