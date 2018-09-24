<?php

namespace Packages\Rwhois\App\Result;

use App\Support\ClassMap;
use App\Support\ServiceProvider;

/**
 * Provide the Result feature to the Application.
 */
class ResultServiceProvider
extends ServiceProvider
{
    /**
     * @var array
     */
    protected $providers = [
        ResultRoutesProvider::class,
    ];
}
