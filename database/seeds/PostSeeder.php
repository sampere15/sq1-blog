<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where("email", "asampere@sq1thebest.com")->first();

        factory(App\Post::class, 10)->create(["user_id" => $user->id]);
    }
}
