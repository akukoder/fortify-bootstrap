<?php

namespace Akukoder\FortifyBootstrap\App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ftbs:install {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Fortify Bootstrap related files.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $force = $this->option('force');

        $fortifyCommand = [
            '--provider' => 'Laravel\Fortify\FortifyServiceProvider'
        ];

        $fortifyBsCommand = [
            '--provider' => 'Akukoder\FortifyBootstrap\FortifyBootstrapServiceProvider'
        ];

        if ($force) {
            $fortifyCommand['--force'] = true;
            $fortifyBsCommand['--force'] = true;
        }

        $this->call('vendor:publish', $fortifyCommand);
        $this->call('vendor:publish', $fortifyBsCommand);

        $this->routeContent();
    }

    private function routeContent()
    {
        $routes = file_get_contents(__DIR__.'/../../../../stubs/routes.txt');

        $handle = fopen(base_path('routes/web.php'), 'a');
        fwrite($handle, $routes);
    }
}
