<?php

namespace Packages\Rwhois\App\Contact\Events;

use App\Log;

/**
 * Base Contact Loggable Event.
 */
abstract
class ContactLoggableEvent
extends ContactEvent
implements Log\LoggableEvent
{
    abstract public function log(Log\Log $log);
}
