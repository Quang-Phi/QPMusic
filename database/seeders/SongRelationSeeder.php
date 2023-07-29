<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SongRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $songs = DB::table('songs')->get();
        $artists = DB::table('artists')->get();
        $albums = DB::table('albums')->get();
        $accounts = DB::table('users')->get();
        for ($i = 0; $i < $accounts->count() - 1; $i++) {
            for ($j = 0; $j < rand(100, $songs->count() - 1); $j++) {
                DB::table('favorites')->insert([
                    'user_id' =>  $accounts[$i]->id,
                    'song_id' => rand(1, $songs->count() - 1),
                    'created_at' => now(),
                ]);
                DB::table('reviews')->insert([
                    'user_id' =>  $accounts[$i]->id,
                    'song_id' => rand(1, $songs->count() - 1),
                    'rating' => rand(1, 5),
                    'created_at' => now(),
                ]);
            }
        }

        for ($i = 0; $i < $accounts->count() - 1; $i++) {
            for ($j = 0; $j < rand(100, $albums->count() - 1); $j++) {
                DB::table('favorites')->insert([
                    'user_id' =>  $accounts[$i]->id,
                    'album_id' => rand(1, $albums->count() - 1),
                    'created_at' => now(),
                ]);
                DB::table('reviews')->insert([
                    'user_id' =>  $accounts[$i]->id,
                    'album_id' => rand(1, $albums->count() - 1),
                    'rating' => rand(1, 5),
                    'created_at' => now(),
                ]);
            }
        }

        for ($i = 0; $i < $accounts->count() - 1; $i++) {
            for ($j = 0; $j < rand(100, $artists->count() - 1); $j++) {
                DB::table('favorites')->insert([
                    'user_id' => $accounts[$i]->id,
                    'artist_id' => rand(1, $artists->count() - 1),
                    'created_at' => now(),
                ]);
                DB::table('reviews')->insert([
                    'user_id' =>  $accounts[$i]->id,
                    'artist_id' => rand(1, $artists->count() - 1),
                    'rating' => rand(1, 5),
                    'created_at' => now(),
                ]);
            }
        }

        for ($i = 0; $i < $accounts->count() - 1; $i++) {
            for ($j = 0; $j < rand(100,  $songs->count() - 1); $j++) {
                DB::table('histories')->insert([
                    'user_id' =>  $accounts[$i]->id,
                    'song_id' => rand(1, $songs->count() - 1),
                    'created_at' => now(),
                ]);
            }
        }

        for ($i = 0; $i < $accounts->count() - 1; $i++) {
            for ($j = 0; $j < rand(100, $albums->count() - 1); $j++) {
                DB::table('histories')->insert([
                    'user_id' =>  $accounts[$i]->id,
                    'album_id' => rand(1, $albums->count() - 1),
                    'created_at' => now(),
                ]);
            }
        }


        $min = rand(1, count($songs) - 5);
        $max = $min + 5;
        for ($min; $min < $max; $min++) {
            $data = [
                'status' => '3'
            ];
            DB::table('songs')->where('id', $min)->update($data);
        }

        foreach ($artists as $key => $artist) {
            foreach ($songs as $song) {
                $songartists = DB::table('artist_song')->where('song_id', $song->id)->pluck('artist_id')->toArray();
                if(count($songartists) > 0) {
                if ($songartists[0] == $artist->id && count($songartists) == 1) {
                    $data = [
                        'img_url' => $artist->img_url
                    ];
                    DB::table('songs')->where('id', $song->id)->update($data);
                }}
            }
        }
        foreach ($songs as $key => $song) {
            DB::table('songs')->where('id', $song->id)->update([
                'downloads' => rand(100, 100000000),
            ]);
        }
    }
}
