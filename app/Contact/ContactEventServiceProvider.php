<?php

namespace Packages\Rwhois\App\Contact;

use App\Log\EventLogger;
use App\Support\EventServiceProvider;

/**
 * Setup Contacts Event Listeners.
 */
class ContactEventServiceProvider
extends EventServiceProvider
{
    protected $listen = [
        Events\ContactCreated::class => [
            EventLogger::class,
        ],
        Events\ContactDeleted::class => [
            EventLogger::class,
        ],
        Events\ContactNameUpdated::class => [
            EventLogger::class,
        ],
        Events\ContactPhoneUpdated::class => [
            EventLogger::class,
        ],
        Events\ContactEmailUpdated::class => [
            EventLogger::class,
        ],
        Events\ContactTypeUpdated::class => [
            EventLogger::class,
        ],
    ];
}
