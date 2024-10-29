<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(
            [
            'name' => 'Salut',
            'firstname' => 'Hello',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12341234'),
            'phone1' => rand(100000000, 1000000000),
            'phone2' => rand(100000000, 1000000000),
            'company' => Str::random(10),
            // "number" => rand(1, 999),
            'address' => Str::random(25),
            'postcode' => rand(1, 10),
            'city' => Str::random(10),
            'country' => Str::random(10),
            'website' => Str::random(10) . '.com',
            'siret' => rand(10000, 1000000),
            'tva' => rand(100, 1000),
            'comment' => Str::random(10),
            'role_id' => '1',
            ],
    );

        // seeder has not been tested
    }
}
