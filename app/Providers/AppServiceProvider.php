<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
    public function boot(): void
    {
        JsonResource::withoutWrapping();

        Password::defaults( function () {
            $rule = Password::min( 8 )
                ->letters()
                ->numbers();

            return $this->app->isProduction() ?
                $rule->mixedCase()->symbols()->uncompromised() : $rule;

        });

    }
}
