<?php

namespace App\Adapters\ViewModels;

use App\Domain\Interfaces\ViewModel;
use Illuminate\Http\Response;
use Inertia\Response as InertiaResponse;

class HttpResponseViewModel implements ViewModel
{   
   private Response | InertiaResponse $response; 

    public function __construct(
        Response | InertiaResponse $response
    )
    {
        if ($response instanceof Response) {
            $this->response = new Response();
        }

        if ($response instanceof InertiaResponse) {
            $this->response = $response;
        }
    }

    public function getResponse(): Response | InertiaResponse
    {
        return $this->response;
    }
}