<?php

namespace Packages\Rwhois\App\Contact\Events;

use App\Log\Log;

class ContactEmailUpdated extends ContactLoggableEvent
{
    public function log(Log $log)
    {
        $log->setDesc('RWhois Contact email updated')
            ->setTarget($this->target)
            ->save()
            ;
    }
}
