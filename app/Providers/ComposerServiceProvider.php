<?php

namespace App\Providers;

use App\Views\Composers\CategoriesComposer;
use App\Views\Composers\CommentComposer;
use App\Views\Composers\UserComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            ['*'],
            CategoriesComposer::class,
        );
        view()->composer(
            ['*'],
            CommentComposer::class,
        );
        view()->composer(
            ['*'],
            UserComposer::class,
        );
    }
}
