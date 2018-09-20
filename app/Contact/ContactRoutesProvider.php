<?php

namespace Packages\Rwhois\App\Contact;

use App\Http\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Routes regarding Contacts.
 */
class ContactRoutesProvider
extends RouteServiceProvider
{
    protected function api(Router $router)
    {
        $router->resource(
            'pkg/rwhois/contact',
            ContactController::class
        );
    }
}
