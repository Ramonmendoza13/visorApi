<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Watchlist;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Crear el usuario de prueba si no existe
        if (User::where('email', 'RMC1@email.RMC')->count() == 0) {
            $user1 = new User();
            $user1->name = 'RMC1';
            $user1->email = 'RMC1@email.RMC';
            $user1->password = Hash::make('RMC1');
            $user1->email_verified_at = Carbon::now();
            $user1->save();

            // Añadir pleis y series a la watchlist del usuario
            if (Watchlist::where('user_id', $user1->id)->count() == 0) {
                Watchlist::create([
                    'user_id' => $user1->id,
                    'imdb_id' => '1399', // Juego de Tronos
                    'media_type' => 'tv',
                ]);
                Watchlist::create([
                    'user_id' => $user1->id,
                    'imdb_id' => '1396', // Breaking Bad
                    'media_type' => 'tv',
                ]);
                Watchlist::create([
                    'user_id' => $user1->id,
                    'imdb_id' => '1402', // The Walking Dead
                    'media_type' => 'tv',
                ]);
            }
        }

        //Crear el usuario de prueba si no existe
        if (User::where('email', 'RMC2@email.RMC')->count() == 0) {
            $user2 = new User();
            $user2->name = 'RMC2';
            $user2->email = 'RMC2@email.RMC';
            $user2->password = Hash::make('RMC2');
            $user2->email_verified_at = Carbon::now();
            $user2->save();

            // Añadir pleis y series a la watchlist del usuario
            if (Watchlist::where('user_id', $user2->id)->count() == 0) {
                Watchlist::create([
                    'user_id' => $user2->id,
                    'imdb_id' => '66732', // Stranger Things
                    'media_type' => 'tv',
                ]);
                Watchlist::create([
                    'user_id' => $user2->id,
                    'imdb_id' => '920', // Cars
                    'media_type' => 'movie',
                ]);
                Watchlist::create([
                    'user_id' => $user2->id,
                    'imdb_id' => '1398', // Los Soprano
                    'media_type' => 'tv',
                ]);
            }
        }
    }
}
