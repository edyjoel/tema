<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        $this->call(RoleTableSeeder::class);

        User::factory()->create([
            'name' => 'Edy',
            'email' => 'edyxicon@gmail.com',
            'password' => bcrypt('rootroot'),
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'Joel',
            'email' => 'joelxicon@gmail.com',
            'password' => bcrypt('rootroot'),
        ])->assignRole('user');
    }
}
