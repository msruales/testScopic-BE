<?php


namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'user1',
            'email' => 'user1@user.com',
            'password' => Hash::make('user2'),
            'is_admin'=>0,
            'remember_token' => Str::random(10),
        ]);

        User::create(
            [
                'name' => 'user2',
                'email' => 'user2@user.com',
                'password' => Hash::make('user3'), // password
                'is_admin'=>0,
                'remember_token' => Str::random(10),
            ]
        );
        User::create(
            [
                'name' => 'admin1',
                'email' => 'admin1@admin.com',
                'password' => Hash::make('admin2'),
                'is_admin'=>1,
                'remember_token' => Str::random(10),
            ]
        );
    }
}
