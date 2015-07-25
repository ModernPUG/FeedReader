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

        $this->publishes([
            __DIR__.'/migrations' => database_path('/migrations/ModernPUG/FeedReader'),
        ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(IReader::class, function ($app) {
            return new Reader();
        });

        $this->commands('\ModernPUG\FeedReader\CrawlFeed');
        $this->commands('\ModernPUG\FeedReader\SendSlackBestArticles');
    }
}
