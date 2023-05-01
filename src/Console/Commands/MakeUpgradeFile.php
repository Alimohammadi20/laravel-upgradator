<?php

namespace Alimi7372\Upgradetor\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeUpgradeFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:make {version}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make version file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $version = $this->argument('version');
        $versionFileName = 'v' . str_replace('.', '_',$version ).'.php';
        $date = Carbon::now()->format('Y/m/d  h:i');
        $file = file_get_contents(__DIR__ . '/../Templates/versioningFileTemplate.php.txt');
        $file = str_replace(['@date','@version'], [$date,$version], $file);
        File::put(base_path('/versions/') . $versionFileName , $file);
        return Command::SUCCESS;
    }
}
