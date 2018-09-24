<?php

namespace Packages\Rwhois\App\Contact\Events;

use App\Log\Log;

class ContactTypeUpdated extends ContactLoggableEvent
{
    public function log(Log $log)
    {
        $log->setDesc('RWhois Contact type updated')
            ->setTarget($this->target)
            ->save()
            ;
    }
}
