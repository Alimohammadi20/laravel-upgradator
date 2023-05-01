<?php

namespace Alimi7372\Upgradetor\Console\Commands;

use Illuminate\Console\Command;
use SystemUpdator\Upgradetor;

class ActionUpdateSystem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:update {specificVersion?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Upgradetor $upgradetor)
    {
        $version = $this->argument('specificVersion');
        ($version) ? $upgradetor->upgrade($version) : $upgradetor->upgrade();
        return Command::SUCCESS;
    }
}
