<?php

namespace Tests\Unit;

use Tests\TestCase;

class MakeUseCaseTest extends TestCase
{
    public function test_it_can_create_use_case_structure(): void
    {
        $name = 'CaseTest';

        $this->artisan("make:use-case $name")
            ->expectsOutput("Use case $name created successfully.")
            ->assertExitCode(0);

        $domainPath = app_path("Domain/UseCases/$name");
        $outportPath = app_path("Domain/UseCases/$name/" . $name . "OutputPort.php");
        $inputPortPath = app_path("Domain/UseCases/$name/" . $name . "InputPort.php");
        $interactorPath = app_path("Domain/UseCases/$name/" . $name . "Interactor.php");
        $requestModelPath = app_path("Domain/UseCases/$name/" . $name . "RequestModel.php");
        $responseModelPath = app_path("Domain/UseCases/$name/" . $name ."ResponseModel.php");
        
        $this->assertDirectoryExists($domainPath);
        $this->assertFileExists($outportPath);
        $this->assertFileExists($inputPortPath);
        $this->assertFileExists($interactorPath);
        $this->assertFileExists($requestModelPath);
        $this->assertFileExists($responseModelPath);
        
        unlink($outportPath);
        unlink($inputPortPath);
        unlink($interactorPath);
        unlink($requestModelPath);
        unlink($responseModelPath);
        rmdir($domainPath);
    }

    /**
     * Test if it shows an error message if the folder already exists.
     *
     * @return void
     */
    public function test_it_show_error_if_folder_exists(): void
    {
        $name = 'Test';
        mkdir(app_path("Domain/UseCases/$name"));
        $path = app_path("Domain/UseCases/$name");

        $this->artisan("make:use-case $name")
            ->expectsOutput("Use case dir $path already exists.")
            ->assertExitCode(1);

        rmdir($path);
    }
}
