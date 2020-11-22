<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
        	'name' => 'Administrator',
        	'slug' => 'administrator',
        	'special' => 'all-access'
        ]);
    }
}
