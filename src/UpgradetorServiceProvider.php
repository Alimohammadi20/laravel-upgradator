<?php

namespace Alimi7372\Upgradetor;

use Console\Commands\ActionDowngradeSystem;
use Console\Commands\ActionUpdateSystem;
use Console\Commands\MakeUpgradeFile;
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
        $this->commands([
            ActionDowngradeSystem::class,
            ActionUpdateSystem::class,
            MakeUpgradeFile::class,
        ]);
    }
}
