<?php

use Illuminate\Database\Seeder;
use App\User;
use Caffeinated\Shinobi\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = User::create([
            "name" => "admin",
            "email" => "admin@sq1thebest.com",
            "password" => bcrypt("admin"),
        ]);

        $admin->assignRoles("administrator");

        User::create([
            "name" => "Adrián Sampere",
            "email" => "sampere15@gmail.com",
            "password" => bcrypt("123"),
        ]);
    }
}
