<?php

namespace Akukoder\FortifyBootstrap;

use Akukoder\FortifyBootstrap\App\Actions\Fortify\CreateNewUser;
use Akukoder\FortifyBootstrap\App\Actions\Fortify\ResetUserPassword;
use Akukoder\FortifyBootstrap\App\Actions\Fortify\UpdateUserPassword;
use Akukoder\FortifyBootstrap\App\Actions\Fortify\UpdateUserProfileInformation;
use Akukoder\FortifyBootstrap\App\Console\Commands\InstallCommand;
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
        $this->console();
    }

    /**
     * Publish assets files
     *
     * @return void
     */
    protected function assets(): void
    {
        $this->publishes([
            __DIR__.'/../stubs/assets/css' => public_path('css'),
            __DIR__.'/../stubs/assets/js' => public_path('js'),
            __DIR__.'/../stubs/HomeController.txt' => app_path('Http/Controllers/HomeController.php'),
        ], 'fort-bs-assets');
    }

    /**
     * Load view
     *
     * @return void
     */
    protected function view(): void
    {
        $this->publishes([
            __DIR__.'/../stubs/views' => resource_path('views'),
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
            return View::make('auth.login');
        });

        Fortify::registerView(function () {
            return View::make('auth.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return View::make('auth.forgot-password');
        });

        Fortify::resetPasswordView(function ($request) {
            return View::make('auth.reset-password', ['request' => $request]);
        });

        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });
    }
    
    protected function console()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }
}
