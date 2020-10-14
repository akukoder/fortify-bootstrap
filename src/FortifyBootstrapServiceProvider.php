<?php

namespace Akukoder\FortifyBootstrap;

use Akukoder\FortifyBootstrap\App\Actions\Fortify\CreateNewUser;
use Akukoder\FortifyBootstrap\App\Actions\Fortify\ResetUserPassword;
use Akukoder\FortifyBootstrap\App\Actions\Fortify\UpdateUserPassword;
use Akukoder\FortifyBootstrap\App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyBootstrapServiceProvider extends ServiceProvider
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
        $this->view();
        $this->fortify();
        $this->assets();
        $this->routes();
    }

    /**
     * Publish assets files
     *
     * @return void
     */
    protected function assets(): void
    {
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/fort-bs'),
        ], 'fort-bs-assets');
    }
    
    public function routes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');        
    }

    /**
     * Load view
     *
     * @return void
     */
    protected function view(): void
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'fort-bs');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/fort-bs'),
            __DIR__.'/resources/views/home.blade.php' => resource_path('views/home.blade.php'),
        ], 'fort-bs-view');
    }

    /**
     * Load Fortify related function calls
     * 
     * @return void
     */
    protected function fortify(): void
    {
        Fortify::loginView(function () {
            return View::make('fort-bs::auth.login');
        });

        Fortify::registerView(function () {
            return View::make('fort-bs::auth.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return View::make('fort-bs::auth.forgot-password');
        });

        Fortify::resetPasswordView(function ($request) {
            return View::make('fort-bs::auth.reset-password', ['request' => $request]);
        });

        Fortify::verifyEmailView(function () {
            return view('fort-bs::auth.verify-email');
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
    }
}
