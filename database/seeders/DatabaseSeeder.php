<?php

namespace Database\Seeders;

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

         $this->call(ProductoSeeder::class);
        //  $this->call(PermissionTableSeeder::class);
        //  $this->call(CreateRolesHasPermissions::class);
        //  $this->call(ConfiguracionSeeder::class);
    }
}
