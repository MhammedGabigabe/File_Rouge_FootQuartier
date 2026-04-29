<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useTailwind();

        Relation::morphMap([
            'user'          => \App\Models\User::class,
            'reservation'   => \App\Models\Reservation::class,
            'participation' => \App\Models\Participation::class,
        ]);
    }
}
