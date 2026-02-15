<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Get all existing users
        $users = User::all();

        if ($users->count() === 0) {
            // If no users exist, create 5 users first
            User::factory(5)->create();
            $users = User::all();
        }

        // For each user, create 2-5 posts
        foreach ($users as $user) {
            Post::factory()
                ->count(rand(2, 5)) // Random number of posts per user
                ->for($user) // Assign posts to this specific user
                ->create();
        }
        
        // Alternative: Just create 30 random posts
        // Post::factory(30)->create();
        
        $this->command->info('Created posts for ' . $users->count() . ' users!');
    }
}