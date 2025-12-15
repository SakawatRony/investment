<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

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
        View::composer(
                ['layouts.app', 'layouts.user.app2', 'admin.auth.login', 'admin.auth.registration'],
                function ($view) {

                    if(empty(Cache::get('settings'))) {
                        $settings = Setting::first();
                        Cache::put('settings', $settings, 8760*60);
                    }

                    // if(auth()->check() && empty(Cache::get('permission_'.auth()->user()->roleUser?->role?->id))) {
                    //     //dd('edfe');
                    //     $permission = auth()->check() ? auth()->user()->roleUser?->role?->permissions : null;
                    //     $userPermission = json_decode($permission, true);
                    //     $userPermission = $userPermission['permission'] ?? null;
                    //     Cache::put('permission_'.auth()->user()->roleUser?->role?->id, auth()->user()->roleUser?->role?->permissions, 8760*60);
                    // }

                    $view->with('settings', Cache::get('settings'));

                }
            );
    }
}
