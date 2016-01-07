<?php

namespace vini\midlog;

use Illuminate\Support\ServiceProvider;

class MidlogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/logger.php' => config_path('logger.php'),
        ]);
        $this->app->make('Illuminate\Contracts\Http\Kernel')
            ->pushMiddleware('vini\midlog\Http\Middleware\LogAfterRequest');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
