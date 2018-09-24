<?php

namespace Packages\Rwhois\App\Contact\Events;

use App\Log\Log;

class ContactDeleted extends ContactLoggableEvent
{
    protected $allowSoftDeletes = true;

    public function log(Log $log)
    {
        $log->setDesc('RWhois Contact deleted')
            ->setTarget($this->target)
            ->save()
            ;
    }
}
