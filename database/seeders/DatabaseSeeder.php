<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(10)->withPersonalTeam()
            ->has(Post::factory(10))
            ->create();

        $posts = Post::factory(200)->recycle($users)->create();

        Comment::factory(100)->recycle($users)->recycle($posts)->create();

        User::factory()
            ->withPersonalTeam()
            ->has(Post::factory(45))
            ->has(Comment::factory(120))->recycle($posts)
            ->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
    }
}
