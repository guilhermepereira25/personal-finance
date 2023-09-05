<?php

namespace Tests\Unit;

use Tests\TestCase;

class MakeRepositoryTest extends TestCase
{
    private $sufix = 'Repository.php';

    /**
     * Test if the command creates a repository file.
     *
     * @return void
     */
    public function test_it_creates_a_repository_file()
    {
        $name = 'Test';
        $orm = 'Eloquent';

        $this->artisan("make:repository", ['name' => $name])
             ->expectsQuestion('Which ORM do you use?', $orm)
             ->assertExitCode(0);

        $fileName = $name . $this->sufix;
        $this->assertFileExists(app_path("Repositories/$orm/$fileName"), 'Repository file was not created.');
        unlink(app_path("Repositories/$orm/$fileName"));
    }
}