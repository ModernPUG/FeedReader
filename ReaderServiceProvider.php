<?php

namespace ModernPUG\FeedReader;

use Illuminate\Support\ServiceProvider;

class ReaderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'fdrdr');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(\ModernPUG\FeedReader\IReader::class, function ($app) {
            return new \ModernPUG\FeedReader\Reader();
        });
    }
}
