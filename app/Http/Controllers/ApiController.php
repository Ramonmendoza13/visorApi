<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watchlist;

class ApiController
{
    public function prueba()
    {
        return response()->json([
            'mensaje' => 'CORRECTO',
        ], 200);
    }

    public function getWatchlists(Request $request)
    {
        $user = $request->user();
        $watchlists = $user->watchlists;

        if ($watchlists->isEmpty()) {
            return response()->json([
                'mensaje' => 'No hay favoritos disponibles.',
            ], 404);
        }

        return response()->json([
            'watchlists' => $watchlists,
        ], 200);
    }

    public function addWatchlist(Request $request)
    {
        $request->validate([
            'imdb_id' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'poster_path' => 'required|string|max:255',
            'media_type' => 'required|string|max:255',
        ]);

        if (Watchlist::where('user_id', $request->user()->id)
            ->where('imdb_id', $request->imdb_id)
            ->exists()
        ) {
            return response()->json([
                'mensaje' => 'El favorito ya existe en la watchlist.',
            ], 409);
        }

        $user = $request->user();
        $imdbId = $request->imdb_id;

        Watchlist::create([
            'user_id' => $user->id,
            'imdb_id' => $imdbId,
            'media_type' => $request->media_type,
        ]);

        return response()->json([
            'mensaje' => 'Favorito agregado correctamente.',
            'watchlist' => [
                'user_id' => $user->id,
                'imdb_id' => $imdbId,
            ],
        ], 201);
    }

    public function deleteWatchlist(Request $request, $imdbId)
    {
        $user = $request->user();
        $watchlistId = Watchlist::where('user_id', $user->id)
            ->where('imdb_id', $imdbId)
            ->first();

        if (!$watchlistId) {
            return response()->json([
                'mensaje' => 'El favorito no existe en la watchlist.',
            ], 404);
        }

        $watchlistId->delete();

        return response()->json([
            'mensaje' => 'Favorito eliminado correctamente.',
        ], 200);
    }

    public function getWatchlistId(Request $request, $media_type, $imdbId)
    {
        $user = $request->user();
        $watchlistItem = Watchlist::where('user_id', $user->id)
            ->where('imdb_id', $imdbId)
            ->where('media_type', $media_type)
            ->first();

        if (!$watchlistItem) {
            return response()->json([
                'mensaje' => 'El favorito no existe en la watchlist.',
            ], 404);
        }

        return response()->json([
            'watchlistItem' => $watchlistItem,
        ], 200);
    }
    
}
