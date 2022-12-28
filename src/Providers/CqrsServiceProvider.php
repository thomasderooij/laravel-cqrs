<?php

declare(strict_types=1);

namespace Thomasderooij\LaravelCqrs\Providers;

use Illuminate\Support\ServiceProvider;
use Thomasderooij\LaravelCqrs\Console\CreateCommandCommand;
use Thomasderooij\LaravelCqrs\Console\CreateQueryCommand;

class CqrsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/cqrs.php', 'cqrs'
        );

        $this->commands([
            'console.command',
            'console.query',
        ]);
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/cqrs.php' => config_path('cqrs.php'),
        ]);

        $this->registerCommands();
    }

    private function registerCommands(): void
    {
        $this->registerCommandCommand();
        $this->registerQueryCommand();
    }

    private function registerCommandCommand(): void
    {
        $this->app->singleton('console.command', function ($app) {
            return new CreateCommandCommand(
                $app['files'],
            );
        });
    }

    private function registerQueryCommand(): void
    {
        $this->app->singleton('console.query', function ($app) {
            return new CreateQueryCommand(
                $app['files'],
            );
        });
    }
}