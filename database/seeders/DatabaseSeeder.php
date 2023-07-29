<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('quangphi123'),
                    'role' => 'Admin',
                    'is_premium' => 'premium',
                    'created_at' => new DateTime()
                ]
            ]
        ); {
            $this->call([
                UserSeeder::class,
            ]);
        };
        DB::table('premium_members')->insert(
            [
                [
                    'user_id' => '1',
                    'registration_time' => new DateTime(),
                    'expires_at' => '2050-01-01 00:00:00',
                    'package_type' => 'premium',
                    'status' => 'done',
                    'created_at' => new DateTime()
                ]
            ]
        );
        DB::table('users_info')->insert(
            [
                [
                    'name' => 'Quang Phi',
                    'address' => 'Nơ Trang Long, Bình Thạnh, TPHCM',
                    'phone' => '0964298523',
                    'gender' => 1,
                    'user_id' => 1,
                    'avatar' => 'https://i.postimg.cc/zG8p6rn0/NTU07336-copy.jpg',
                    'created_at' => new DateTime()
                ]
            ]
        ); {
            $this->call([
                TaskSeeder::class,
            ]);
        };
          {
            $this->call([
                SongSeeder::class,
            ]);
        };
        {
            $this->call([
                SongRelationSeeder::class,
            ]);
        };
    }
}
