<?php

namespace Packages\Rwhois\App\Contact\Events;

use Packages\Rwhois\App\Contact;
use App\Support\Event;
use App\Support\Database\SerializesModels;

/**
 * Base Contact Event.
 */
abstract
class ContactEvent
extends Event
{
    use SerializesModels;

    /**
     * @var Contact\Contact
     */
    public $target;

    /**
     * Create a new event instance.
     *
     * @param Contact\Contact $target
     */
    public function __construct(Contact\Contact $target)
    {
        $this->target = $target;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
