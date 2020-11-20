<?php

use Illuminate\Database\Seeder;
use App\User;

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
            "name" => "admin",
            "email" => "admin@sq1thebest.com",
            "password" => bcrypt("admin"),
        ]);

        User::create([
            "name" => "Adrián Sampere",
            "email" => "asampere@sq1thebest.com",
            "password" => bcrypt("adri"),
        ]);
    }
}
