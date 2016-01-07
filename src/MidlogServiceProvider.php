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
    public function boot(\Illuminate\Foundation\Http\Kernel $kernel)
    {
        $this->publishes([
            __DIR__.'/vini/midlog/Config/logger.php' => config_path('logger.php'),
        ]);
        $kernel->pushMiddleware('vini\midlog\Http\Middleware\LogAfterRequest');
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
