<?php

namespace Upgradetor\Console\Commands;

use Illuminate\Console\Command;
use SystemUpdator\Upgradetor;

class ActionDowngradeSystem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:downgrade {specificVersion?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'downgrade';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Upgradetor $upgradetor)
    {
        $version = $this->argument('specificVersion');
        ($version) ? $upgradetor->downgrade($version) : $upgradetor->downgrade();
        return Command::SUCCESS;
    }
}
