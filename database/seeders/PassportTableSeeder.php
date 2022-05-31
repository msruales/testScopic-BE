<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PassportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'user_id' => null,
            'name' => 'Laravel Personal Access Client',
            'secret' => 'bmcKmrQJYKdN9Ayf7Z0tSuzB5NMaZ82iUBVcCnKm',
            'provider' => null,
            'redirect' => 'http://localhost',
            'personal_access_client' => 1,
            'password_client' => 0,
            'revoked' => 0,
            'created_at' => '2022-05-25 18:38:42',
            'updated_at' => '2022-05-25 18:38:42'
        ]);
        DB::table('oauth_clients')->insert([
            'user_id' => null,
            'name' => 'Laravel Password Grant Client',
            'secret' => 'b7TQxIxetD19ieeR5PYbG7Q4M42cRRYGrJIuRQjr',
            'provider' => 'users',
            'redirect' => 'http://localhost',
            'personal_access_client' => 0,
            'password_client' => 1,
            'revoked' => 0,
            'created_at' => '2022-05-25 18:38:42',
            'updated_at' => '2022-05-25 18:38:42'
        ]);
        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => 1,
            'created_at' => '2022-05-25 18:38:42',
            'updated_at' => '2022-05-25 18:38:42'
        ]);
    }
}
