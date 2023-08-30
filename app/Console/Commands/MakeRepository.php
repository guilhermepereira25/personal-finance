<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Nette\PhpGenerator\{PhpNamespace, ClassType, PhpFile};


class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name : The name of repository Class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a repository structure for a given class.';

    /**
     * FILEPATH: personal-finance/app/Console/Commands/MakeRepository.php
     * 
     * This class represents a command to generate a new repository. It contains a private property $orms
     * which is an array of available ORMs to be used in the repository generation process.
     */
    private $orms = ['Eloquent'];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $orm = $this->choice('Which ORM do you use?', $this->orms, 0);
        
        $path = app_path('Repositories/' . $this->orms[$orm] . '/');

        if (! file_exists($path)) {
            mkdir(dirname($path), 0777, true);
        }

        $filename = $name . 'Repository.php';
        $file = fopen($path . $filename, 'w');
        fwrite($file, $this->formatCodeStructure($name, $this->orms[$orm]));
        fclose($file);

        $this->info('Repository created successfully.');
    }

    /**
     * Format the code structure for the repository.
     *
     * @param string $name The name of the repository.
     * @param string $orm The ORM to be used.
     * @return string The formatted code structure.
     */
    private function formatCodeStructure(string $name, string $orm): string
    {
        $phpTag = "<?php \n\n";

        $class = new ClassType($name . 'Repository');
        $class
            ->setExtends("App\Repositories\\{$orm}\BaseRepository")
            ->addComment('Auto generated repository.');

        $namespace = new PhpNamespace('App\Repositories\\' . $orm);
        $namespace->add($class);
        $namespace->addUse("Repositories\\{$orm}\BaseRepository");

        return $phpTag . (string) $namespace;
    }
}