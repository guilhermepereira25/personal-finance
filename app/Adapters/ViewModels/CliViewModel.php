<?php

namespace App\Adapters\ViewModels;

use App\Domain\Interfaces\ViewModel;
use Closure;
use Illuminate\Console\Command;

class CliViewModel implements ViewModel
{
    public function __construct(
        private Closure $handler
    )
    {
    }

    public function handle(Command $command): void
    {
        echo "Hello World!\n";
    }
}