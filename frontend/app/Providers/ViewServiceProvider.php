<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\AppUserComposer;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', AppUserComposer::class);
    }
}
