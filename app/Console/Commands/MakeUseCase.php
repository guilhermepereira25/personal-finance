<?php

namespace App\Console\Commands;

use DomainException;
use Illuminate\Console\Command;
use Nette\PhpGenerator\{PhpNamespace, InterfaceType, ClassType, PsrPrinter};

class MakeUseCase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:use-case {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new use case';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        try {
            $case = ucfirst($name);
            if ( $this->createUseCaseDir($case) ) {
                $this->createInterfacesForCase($case);
                $this->createClassesForCase($case);
            }
        } catch (DomainException $ex) {
            $this->error($ex->getMessage());
            return 1;
        }

        $this->info("Use case $name created successfully.");
    }

    /**
     * Create a directory for the use case class.
     *
     * @param string $className The name of the use case class.
     * 
     * @throws DomainException
     * 
     * @return bool
     */
    private function createUseCaseDir(string $className): bool
    {
        $useCaseDir = app_path("Domain/UseCases/" . $className);

        if ( !file_exists($useCaseDir) ) {
            mkdir($useCaseDir, 0777, true);
        } else {
            throw new DomainException("Use case dir $useCaseDir already exists.");
        }

        return true;
    }

    private function createInterfacesForCase(string $interfaceName): void
    {
        $this->createInputPortInterface($interfaceName);
        $this->createOutputPortInterface($interfaceName);
    }

    private function createClassesForCase($className): void
    {
        $this->createInteractor($className);
        $this->createRequestModel($className);
        $this->createResponseModel($className);
    }

    private function createInputPortInterface(string $className)
    {
        $content = $this->generateUseCaseInterface($className, 'InputPort');
        $this->fileUseCaseHandler($className, 'InputPort', $content);
    }

    private function createOutputPortInterface(string $interfaceName)
    {
        $content = $this->generateUseCaseInterface($interfaceName, 'OutputPort');
        $this->fileUseCaseHandler($interfaceName, 'OutputPort', $content);
    }

    private function createInteractor(string $className)
    {
        $content = $this->generateUseCaseInteractorClass($className, 'Interactor');
        $this->fileUseCaseHandler($className, 'Interactor', $content);
    }

    private function createRequestModel(string $className)
    {
        $content = $this->generateRequestModelClass($className, 'RequestModel');
        $this->fileUseCaseHandler($className, 'RequestModel', $content);
    }

    private function createResponseModel(string $className)
    {
        $content = $this->generateResponseModelClass($className, 'ResponseModel');
        $this->fileUseCaseHandler($className, 'ResponseModel', $content);
    }

    /**
     * Handles the creation of a use case file.
     *
     * @param string $caseName The name of the use case.
     * @param string $domainName The name of the domain.
     * @param string $content The content of the use case file.
     * 
     * @throws DomainException
     * 
     * @return void
     */
    private function fileUseCaseHandler(string $caseName, string $domainName, string $content): void
    {
        $file = fopen(app_path("Domain/UseCases/$caseName/$caseName" . ucfirst($domainName). '.php'), 'w');
        if ( !$file ) {
            throw new DomainException("Could not create file for $domainName.");
        }
        fwrite($file, (string) $content);
        fclose($file);
    }

    /**
     * Generates a PHP interface handler method.
     *
     * @param string $interfaceName The name of the interface.
     * @param string $caseName The name of the case.
     * @return string The generated PHP code for the interface handler method.
     */
    private function generateUseCaseInterface(string $interfaceName, string $caseName): string
    {
        $phpTag = "<?php \n\n";

        $interface = new InterfaceType($interfaceName . $caseName);
        $interface
            ->addComment('This interface represents the ' . $interfaceName . ' of the ' . $caseName . ' use case.');

        $namespace = new PhpNamespace('App\Domain\UseCases\\' . $interfaceName);
        $namespace->add($interface);

        return $phpTag . (string) $namespace;
    }

    private function generateResponseModelClass(string $caseName, string $domainName): string
    {
        $phpTag = "<?php \n\n";

        $class = new ClassType($caseName . $domainName);
        $class
            ->addComment('This Class represents the domain of the ' . $caseName . $domainName . '.');

        $method = $class->addMethod('__construct');
        $method
            ->addPromotedParameter('args', [])
            ->setPrivate();

        $namespace = new PhpNamespace('App\Domain\UseCases\\' . $caseName);
        $namespace->add($class);

        return $phpTag . (string) $namespace;
    }

    /**
     * Generate a PHP class handler for a given case and domain name.
     *
     * @param string $caseName The name of the case.
     * @param string $domainName The name of the domain.
     * @param string $implements The name of the interface to implement.
     *
     * @return string The generated PHP class handler.
     */
    private function generateUseCaseInteractorClass(string $caseName, string $domainName): string
    {
        $phpTag = "<?php \n\n";

        $class = new ClassType($caseName . $domainName);
        $class
            ->setImplements(["App\Domain\UseCases\\$caseName\\" . $caseName . 'InputPort'])
            ->addComment('This Class represents the interactor of the ' . $caseName . $domainName . '.');
        
        $method = $class->addMethod('__construct');
        $method
            ->addPromotedParameter(lcfirst($caseName) . 'OutputPort')
            ->setType("App\Domain\UseCases\\$caseName\\" . $caseName . 'OutputPort')
            ->setPrivate();
        
        $namespace = new PhpNamespace('App\Domain\UseCases\\' . $caseName);
        $namespace->add($class);

        return $phpTag . (string) $namespace;
    }

    private function generateRequestModelClass(string $caseName, string $domainName): string
    {
        $phpTag = "<?php \n\n";

        $class = new ClassType($caseName . $domainName);
        $class
            ->addComment('This Class represents the domain of the ' . $caseName . $domainName . '.');

        $method = $class->addMethod('__construct');
        $method
            ->addPromotedParameter('args', [])
            ->setPrivate();

        $namespace = new PhpNamespace('App\Domain\UseCases\\' . $caseName);
        $namespace->add($class);

        return $phpTag . (string) $namespace;
    }
}