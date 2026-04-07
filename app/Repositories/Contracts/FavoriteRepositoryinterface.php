<?php

namespace App\Repositories\Contracts;

interface FavoriteRepositoryInterface
{
    public function addFavorite($userId, $bookId);

    public function removeFavorite($userId, $bookId);

    public function getUserFavorites($userId);
}
