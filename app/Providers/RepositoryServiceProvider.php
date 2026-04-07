<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\BorrowingRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\FAQRepositoryInterface;
use App\Repositories\Contracts\FavoriteRepositoryInterface;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\AuthRepository;
use App\Repositories\Eloquent\BookRepository;
use App\Repositories\Eloquent\BorrowingRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\FAQRepository;
use App\Repositories\Eloquent\FavoriteRepository;
use App\Repositories\Eloquent\ReviewRepository;
use App\Repositories\Eloquent\UserRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class
        );

        $this->app->bind(
            BookRepositoryInterface::class,
            BookRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            FAQRepositoryInterface::class,
            FAQRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            BorrowingRepositoryInterface::class,
            BorrowingRepository::class
        );

        $this->app->bind(
            ReviewRepositoryInterface::class,
            ReviewRepository::class
        );
        $this->app->bind(
            FavoriteRepositoryInterface::class,
            FavoriteRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
