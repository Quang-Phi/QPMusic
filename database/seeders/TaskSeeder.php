<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Hoàn thành',
                'completed' => true,
                'user_id' => 1,
                'created_at' => new DateTime(),
            ],
            [
                'title' => 'Check Bug',
                'completed' => true,
                'user_id' => 1,
                'created_at' => new DateTime(),
            ],
           
            [
                'title' => 'Làm UI Client',
                'completed' => true,
                'user_id' => 1,
                'created_at' => new DateTime(),
            ],

            [
                'title' => 'Đổ DATA vào UI',
                'completed' => true,
                'user_id' => 1,
                'created_at' => new DateTime(),
            ],
            [
                'title' => 'Làm UI Admin',
                'completed' => true,
                'user_id' => 1,
                'created_at' => new DateTime(),
            ],
            [
                'title' => 'Làm Database',
                'completed' => true,
                'user_id' => 1,
                'created_at' => new DateTime(),
            ],
            [
                'title' => 'Làm UI Login',
                'completed' => true,
                'user_id' => 1,
                'created_at' => new DateTime(),
            ]
        ];
        DB::table('tasks')->insert($data);
    }
}
