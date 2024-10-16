<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@localhost',
            'role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@localhost',
        ]);

        User::factory(10)->create();

        $this->call([
            PostSeeder::class,
            PostLikeSeeder::class,
            PostCommentSeeder::class,
        ]);
    }
}
