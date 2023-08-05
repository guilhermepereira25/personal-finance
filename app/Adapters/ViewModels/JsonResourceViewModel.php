<?php 

namespace App\Adapters\ViewModels;

use App\Domain\Interfaces\ViewModel;

class JsonResourceViewModel implements ViewModel
{
    public function __construct(
        private string $resource
    )
    {
    }

    public function getResource(): string
    {
        return $this->resource;
    }
}