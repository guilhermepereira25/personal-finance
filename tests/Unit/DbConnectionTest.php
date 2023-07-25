<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use PDO;

class DbConnectionTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_connection_with_database_is_working(): void
    {
        $connection = DB::connection()->getPdo();

        $this->assertTrue($connection instanceof PDO, 'Connection with database is not working');
    }
}
