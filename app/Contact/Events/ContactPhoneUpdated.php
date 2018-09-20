<?php

namespace Packages\Rwhois\App\Contact\Events;

use App\Log\Log;

class ContactPhoneUpdated extends ContactLoggableEvent
{
    public function log(Log $log)
    {
        $log->setDesc('Contact phone updated')
            ->setTarget($this->target)
            ->save()
            ;
    }
}
