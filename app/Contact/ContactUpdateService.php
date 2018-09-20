<?php

namespace Packages\Rwhois\App\Contact;

use App\Support\Http\UpdateService;
use Illuminate\Support\Collection;

class ContactUpdateService
    extends UpdateService
{
    /**
     * @var ContactFormRequest
     */
    protected $request;
    protected $requestClass = ContactFormRequest::class;

    public function afterCreate(Collection $items)
    {
        $createEvent = $this->queueHandler(
            Events\ContactCreated::class
        );

        $this->successItems(
            'pkg.rwhois::contact.created',
            $items->each($createEvent)
        );
    }

    protected function updateAll(Collection $items)
    {
        $this->setName($items);
    }

    protected function setName(Collection $items)
    {
        $inputs = [
            'name' => $this->input('name'),
        ];
        $createEvent = $this->queueHandler(
            Events\ContactNameUpdated::class
        );

        $this->successItems(
            'pkg.rwhois::contact.update.name',
            $items
                ->filter($this->changed($inputs))
                ->reject($this->isCreating())
                ->each($createEvent)
        );
    }
}
