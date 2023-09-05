<?php 

namespace App\Adapters\ViewModels;

use App\Domain\Interfaces\ViewModel;
use Illuminate\Http\Resources\Json\JsonResource;

class JsonResourceViewModel implements ViewModel
{
    public function __construct(
        private JsonResource $resource
    )
    {
    }

    public function getResource(): JsonResource
    {
        return $this->resource;
    }
}