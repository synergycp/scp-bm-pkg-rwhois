<?php

namespace Packages\Rwhois\App\Contact\Events;

use App\Log\Log;

class ContactNameUpdated extends ContactLoggableEvent
{
    public function log(Log $log)
    {
        $log->setDesc('Contact name updated')
            ->setTarget($this->target)
            ->save()
            ;
    }
}
