<?php

namespace Packages\Rwhois\App\Contact\Events;

use App\Log\Log;

class ContactEmailUpdated extends ContactLoggableEvent
{
    public function log(Log $log)
    {
        $log->setDesc('Contact email updated')
            ->setTarget($this->target)
            ->save()
            ;
    }
}
