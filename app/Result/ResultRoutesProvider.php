<?php

namespace Packages\Rwhois\App\Result;

use App\Http\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Routes regarding Results.
 */
class ResultRoutesProvider
extends RouteServiceProvider
{
    /**
     * @var string
     */
    protected $package = 'rwhois';

    protected function api(Router $router)
    {
        $router->resource(
            'result',
            ResultController::class
        );
    }
}
