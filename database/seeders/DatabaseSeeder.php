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
            $this->call([
                RoleSeeder::class
            ]);
            {
                // \App\Models\User::factory(10)->create();
                \App\Models\Boitier::factory(10)->create();
                \App\Models\Ph::factory(1)->create();
                \App\Models\PhLog::factory(50)->create();

        }
    }
}