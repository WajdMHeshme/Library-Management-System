<?php

namespace App\Repositories\Eloquent;

use App\Models\Favorite;
use App\Repositories\Contracts\FavoriteRepositoryInterface;

class FavoriteRepository implements FavoriteRepositoryInterface
{
    public function addFavorite($userId, $bookId)
    {
        return Favorite::create([
            'user_id' => $userId,
            'book_id' => $bookId,
        ]);
    }

    public function removeFavorite($userId, $bookId)
    {
        $favorite = Favorite::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->first();
        if (!$favorite) {
            return null;
        }
        $favorite->delete();
        return $favorite;
    }

    public function getUserFavorites($userId)
    {
        return Favorite::with('book')
            ->where('user_id', $userId)
            ->get();
    }
}
