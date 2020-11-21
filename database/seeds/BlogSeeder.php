<?php

use Illuminate\Database\Seeder;
use App\Blog;
use App\User;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where("email", "asampere@sq1thebest.com")->first();

        factory(App\Blog::class, 10)->create(["user_id" => $user->id]);
    }
}
