<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Nette\PhpGenerator\{PhpNamespace, ClassType};


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
        
        $path = app_path('Repositories/' . $orm . '/');

        if (! file_exists($path)) {
            mkdir(dirname($path), 0777, true);
        }

        $filename = $name . 'Repository.php';
        $file = fopen($path . $filename, 'w');
        fwrite($file, $this->getRepositoryClassStructure($name, $orm));
        fclose($file);

        $this->info('Repository created successfully.');
    }

    private function getRepositoryClassStructure(string $className, string $orm): string
    {
        $phpTag = "<?php \n\n";

        $class = new ClassType($className . 'Repository');
        $class
            ->setExtends("App\Repositories\\{$orm}\BaseRepository")
            ->addComment('Auto generated repository.');

        $namespace = new PhpNamespace('App\Repositories\\' . $orm);
        $namespace->add($class);

        return $phpTag . (string) $namespace;
    }
}