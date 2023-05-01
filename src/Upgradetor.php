<?php

namespace Alimi7372\Upgradetor;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Alimi7372\Upgradetor\Enums\Type;
use Alimi7372\Upgradetor\Enums\Status;
use Alimi7372\Upgradetor\Models\Version;
use Symfony\Component\Console\Output\ConsoleOutput;

class Upgradetor
{
    protected string $base_path;
    protected array $files;
    protected array $classes;
    protected ConsoleOutput $output;
    protected array $upgradeStatus = ['success' => [], 'failure' => []];
    protected array $downgradeStatus = ['success' => [], 'failure' => []];

    public function __construct()
    {
        $this->output = new ConsoleOutput();
        $this->base_path = base_path();
        $this->setFiles();
    }

    public function upgrade($version = false): bool
    {
        return $this->upgradetor('up', Type::UPGRADE, $version);
    }

    public function downgrade($version = false): bool
    {
        return $this->upgradetor('down', Type::DOWNGRADE, $version);
    }

    private function upgradetor($method, Type $type, $version = false): bool
    {
        $status = true;
        $this->setClasses();
        foreach ($this->classes as $class) {
            if ($version == $class->getVersion() || !$version) {
                $classVersion = $class->getVersion();
                try {
                    if (!$this->checkVersionInstallStatus($classVersion) || $type == Type::DOWNGRADE) {
                        $class->{$method}();
                        $this->setStatus($type, Status::SUCCESS, 'v' . $classVersion);
                    }
                    $this->updateInstallStatusDatabase($classVersion, $type);
                } catch (\Exception $ex) {
                    $this->setStatus($type, Status::FAILURE, 'v' . $classVersion . ' | ex:' . $ex);
                    $status = false;
                }
            }
        }
        return $status;
    }

    // $type: upgrade | downgrade  *** $status: success | failure
    private function setStatus(Type $type, Status $status, $msg)
    {
        $colorType = ($type == Type::UPGRADE) ? '<fg=blue;bg=black>' : '<fg=red;bg=black>';
        $colorStatus = ($status == Status::SUCCESS) ? '<fg=green;bg=white>' : '<fg=red;bg=white>';
        $this->output->writeln($colorType . $type->value . '</> | ' . $colorStatus . $status->value . '</>' . ' |-> ' . $msg);
        $this->{$type->value . 'Status'}[$status->value][] = $msg;
    }

    protected function setFiles(): void
    {
        $this->files = File::files($this->base_path . '/versions');
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    protected function setClasses(): void
    {
        $classes = array();
        foreach ($this->getFiles() as $file) {
            $classes[] = require_once($file->getRealPath());
        }
        $this->classes = $classes;
    }

    protected function getClasses(): array
    {
        return $this->classes;
    }

    private function checkVersionInstallStatus($version): Version|null
    {
        return Version::where('version', $version)->first();
    }

    private function updateInstallStatusDatabase($versionNumber, Type $type)
    {
        $version = Version::where('version', $versionNumber)->first();
        if ($type == Type::UPGRADE) {
            if (!$version) {
                Version::create([
                    'version' => $versionNumber,
                    'installed_at' => Carbon::now()
                ]);
            }
        } else {
            $version->delete();
        }
    }

    public function getStatusArray(Type $type): array
    {
        return $this->{$type->value . 'Status'};
    }

    public function toString(Type $type): string
    {
        $txt = '';
        foreach ($this->{$type->value . 'Status'} as $status) {
            foreach ($status as $item) {
                $txt .= $type->value . ' | ' . $item->value;
            }
        }
        return $txt;
    }

}
