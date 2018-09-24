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
    /**
     * @var string
     */
    protected $package = 'rwhois';

    /**
     * Setup Routes.
     */
    public function bootRoutes()
    {
        $this->loadTranslationsFrom(
            $this->basePath() . '/resources/lang',
            'pkg.' . $this->folder()
        );
    }

    /**
     * @return string
     */
    protected function basePath()
    {
        return sprintf(
            '%s/packages/%s',
            $this->app->basePath(),
            $this->folder()
        );
    }

    /**
     * @return string
     */
    protected function folder()
    {
        return $this->package;
    }

    protected function api(Router $router)
    {
        $router->resource(
            'contact',
            ContactController::class
        );
    }
}
