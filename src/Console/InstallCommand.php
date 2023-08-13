<?php

declare(strict_types=1);

namespace HosmelQ\LogSnag\Laravel\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $description = 'Install the LogSnag configuration file.';

    protected $name = 'logsnag:install';

    public function handle(): int
    {
        $this->callSilently('vendor:publish', [
            '--tag' => 'logsnag-config',
        ]);

        if ($this->confirm('Would you like to star the repo on GitHub?')) {
            $url = 'https://github.com/hosmelq/laravel-logsnag';

            $command = [
                'Darwin' => 'open',
                'Linux' => 'xdg-open',
                'Windows' => 'start',
            ][PHP_OS_FAMILY] ?? null;

            if ($command) {
                exec("$command $url");
            }
        }

        return self::SUCCESS;
    }
}
