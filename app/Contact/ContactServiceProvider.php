<?php

namespace Packages\Rwhois\App\Contact;

use App\Support\ClassMap;
use App\Support\ServiceProvider;

/**
 * Provide the Contact feature to the Application.
 */
class ContactServiceProvider
extends ServiceProvider
{
    /**
     * @var array
     */
    protected $providers = [
        ContactEventServiceProvider::class,
        ContactRoutesProvider::class,
    ];

    /**
     * @param ClassMap $classMap
     */
    public function boot(ClassMap $classMap)
    {
        $classMap
            ->map('pkg.rwhois.contact', Contact::class)
        ;
    }
}
