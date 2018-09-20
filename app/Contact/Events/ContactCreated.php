<?php

namespace Packages\Rwhois\App\Contact\Events;

use App\Log\Log;

class ContactCreated extends ContactLoggableEvent
{
    public function log(Log $log)
    {
        $log->setDesc('Contact created')
            ->setTarget($this->target)
            ->save()
            ;
    }
}
