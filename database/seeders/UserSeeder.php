<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(50)->create();
        for ($i = 2; $i < 51; $i++) {
            UserInfo::factory()->create([
                'user_id' => $i
            ]);
        }
    }
}
