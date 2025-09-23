<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(): void
    {
        user::create([
            'name'=>'Administrador',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('Admin12345')
        ])->assignRole('Administrador');

        User::factory(9)->create();
    }

}
