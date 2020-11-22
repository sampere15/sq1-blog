<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $arrayTablas = ["users", "posts", "roles", "permissions"];
        //  Truncate table before seed
    	$this->truncate_tables($arrayTablas);

        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
    }

    //  Method to truncate the tables before seeding to avoid duplicate data
    protected function truncate_tables(array $tablas)
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        foreach ($tablas as $tabla) {
            DB::table($tabla)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
