<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \Illuminate\Support\Facades\View::composer('_layout.sidebar', function ($view) {
            $pendingAspirationsCount = 0;

            if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->access_type == \App\Constants\UserConst::ADMIN) {
                $pendingAspirationsCount = \Illuminate\Support\Facades\DB::table(\App\Constants\DatabaseConst::COMPLAINT)
                    ->leftJoin('aspirations', 'complaints.id', '=', 'aspirations.complaint_id')
                    ->whereNull('complaints.deleted_at')
                    ->where(function ($query) {
                        $query->where('aspirations.status', \App\Constants\ProgressConst::PENDING)
                            ->orWhereNull('aspirations.status');
                    })
                    ->count();
            }

            $view->with('pendingAspirationsCount', $pendingAspirationsCount);
        });
    }
}
