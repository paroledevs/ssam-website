<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Alex Favela',
            'email' => 'alex@planetoide.mx',
            'password' => bcrypt('secret'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'super_admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Roger Guzmán',
            'email' => 'roger@planetoide.mx',
            'password' => bcrypt('secret'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'super_admin',
        ]);

        $this->command->warn('Super admins creados.');
    }
}
