<?php

namespace Alimi7372\Upgradetor\Console\Commands;

use Illuminate\Console\Command;
use Alimi7372\Upgradetor\Facades\Upgradetor;

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
    public function handle()
    {
        $version = $this->argument('specificVersion');
        ($version) ? Upgradetor::upgrade($version) : Upgradetor::upgrade();
        return Command::SUCCESS;
    }
}
