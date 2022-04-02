<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Gate::define('admin', fn($user) => $user->role == User::USER_ROLE_ADMIN);
        Gate::define('manage-maintenances', fn($user, $model) => $user->maintenances()->pluck('id')->contains($model->id) || Gate::check('admin'));
    }
}
