<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Petugas;
use App\Models\Report;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Gate::define('petugas', function () {
            if (Auth::guard('petugas')->check()) {
                return Auth::guard('petugas')->check();
            }
        });

        Gate::define('investigasi', function () {
            if (Auth::guard('petugas')->check()) {
                return Auth::guard('petugas')->user()->is_investigation_team;
            }
        });
        Gate::define('manajemen', function () {
            if (Auth::guard('petugas')->check()) {
                return Auth::guard('petugas')->user()->is_management;
            }
        });

        Gate::define('admin', function () {
            if (Auth::guard('petugas')->check()) {
                return Auth::guard('petugas')->user()->is_admin;
            }
        });

        Gate::define('pelapor', function () {
            if (Auth::guard('pelapor')->check()) {
                return TRUE;
            }
        });

        Gate::define('pelapor_internal', function () {
            if (Auth::guard('pelapor')->check()) {
                return Auth::guard('pelapor')->user()->is_internal;
            }
        });
    }
}
