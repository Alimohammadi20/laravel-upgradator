<?php

namespace Alimi7372\Upgradetor;

use Alimi7372\Upgradetor\Console\Commands\ActionDowngradeSystem;
use Alimi7372\Upgradetor\Console\Commands\ActionUpdateSystem;
use Alimi7372\Upgradetor\Console\Commands\MakeUpgradeFile;
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
            __DIR__ . '/Console/Commands' => base_path('/app/Console/Commands'),
        ], 'upgradetor-commands');
        if ($this->app->runningInConsole()) {
            $this->commands([
                ActionDowngradeSystem::class,
                ActionUpdateSystem::class,
                MakeUpgradeFile::class,
            ]);
        }

    }
}
