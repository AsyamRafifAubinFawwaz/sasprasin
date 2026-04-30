<?php

namespace App\Providers;

use App\Constants\DatabaseConst;
use App\Constants\ProgressConst;
use App\Constants\UserConst;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Blaze\Blaze;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Blaze::optimize()->in(
            resource_path('views/components'),
        );

        View::composer('_layout.sidebar', \App\Http\View\Composers\SidebarComposer::class);
    }
}
