<?php

namespace Alimi7372\Upgradetor;

use Illuminate\Support\ServiceProvider;

class UpgradetorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations/2023_04_29_075643_create_versions_table.php' => base_path('/database/migrations'),
        ], 'upgradetor-migrations');
        $this->publishes([
            __DIR__ . '/Commands' => base_path('/app/Console/Commands'),
        ], 'upgradetor-commands');
        $this->app->singleton(
            'command.upgradetor.downgrade',
             Console\Commands\ActionDowngradeSystem::class
        );
        $this->app->singleton(
            'command.upgradetor.upgrade',
            Console\Commands\ActionUpdateSystem::class
        );
        $this->app->singleton(
            'command.upgradetor.make.file',
            Console\Commands\MakeUpgradeFile::class
        );
    }
}
