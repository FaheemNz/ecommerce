<?php

namespace Database\Seeders;

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
            'name' => 'Faheem Nawaz',
            'email' => 'faheem@gmail.com',
            'password' => bcrypt('password')
        ]);
        
        User::create([
            'name' => 'Saad Nawaz',
            'email' => 'saad@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
