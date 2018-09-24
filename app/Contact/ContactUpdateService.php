<?php

namespace Packages\Rwhois\App\Contact;

use App\Support\Http\UpdateService;
use Illuminate\Support\Collection;
use function object_get;

class ContactUpdateService
    extends UpdateService
{
    /**
     * @var ContactFormRequest
     */
    protected $request;
    protected $requestClass = ContactFormRequest::class;

    /**
     * @var ContactRepository
     */
    protected $contacts;

    /**
     * @var \stdClass
     */
    protected $settings;

    /**
     * ContactUpdateService constructor.
     *
     * @param ContactRepository $contacts
     */
    public function boot(ContactRepository $contacts)
    {
        $this->contacts = $contacts;
        $this->settings = app('Settings');
    }

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

    public function beforeCreate(Collection $items)
    {
        $this->auth->only([
            'client' => function ($clientId) use ($items) {
                $items->each($this->changed([
                    'client_id' => $clientId,
                ]));
            },
        ]);
    }

    protected function updateAll(Collection $items)
    {
        $this->setName($items);
        $this->setPhone($items);
        $this->setEmail($items);
        $this->setType($items);
    }

    private function setName(Collection $items)
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

    private function setPhone(Collection $items)
    {
        $inputs = [
            'phone' => $this->input('phone'),
        ];
        $createEvent = $this->queueHandler(
            Events\ContactPhoneUpdated::class
        );

        $this->successItems(
            'pkg.rwhois::contact.update.phone',
            $items
                ->filter($this->changed($inputs))
                ->reject($this->isCreating())
                ->each($createEvent)
        );
    }

    private function setEmail(Collection $items)
    {
        $inputs = [
            'email' => $this->input('email'),
        ];
        $createEvent = $this->queueHandler(
            Events\ContactEmailUpdated::class
        );

        $this->successItems(
            'pkg.rwhois::contact.update.email',
            $items
                ->filter($this->changed($inputs))
                ->reject($this->isCreating())
                ->each($createEvent)
        );
    }

    private function setType(Collection $items)
    {
        $inputs = [
            'type' => $type = $this->input('type.id'),
        ];

        $settingName = Contact::allowSettingFromType($type);

        if (!$this->settings->{$settingName}) {
            abort(400, 'Administrators currently do not allow that role to be set.');
        }

        $items->each(function (Contact $item) use ($type) {
            $hasOverlap = $this->contacts
                ->query()
                ->where('client_id', $item->client_id)
                ->where('type', $type)
                ->where('id', '!=', $item->getKey())
                ->exists();
            if ($hasOverlap) {
                abort(409, 'You have already specified a contact with that role.');
            }
        });
        $createEvent = $this->queueHandler(
            Events\ContactTypeUpdated::class
        );

        $this->successItems(
            'pkg.rwhois::contact.update.type',
            $items
                ->filter($this->changed($inputs))
                ->reject($this->isCreating())
                ->each($createEvent)
        );
    }
}
