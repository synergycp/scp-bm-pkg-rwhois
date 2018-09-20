<?php

namespace Packages\Rwhois\App\Contact;

use Illuminate\Support\Collection;
use App\Support\Http\DeleteService;
use App\Api\ApiAuthService;

/**
 * Delete Contacts.
 */
class ContactDeleteService
extends DeleteService
{
    /**
     * @var ApiAuthService
     */
    protected $auth;

    /**
     * @param ApiAuthService $auth
     */
    public function boot(
        ApiAuthService $auth
    ) {
        $this->auth = $auth;
    }

    /**
     * @param Collection $items
     */
    protected function afterDelete(Collection $items)
    {
        $this->successItems('pkg.rwhois::contact.deleted', $items);
    }

    /**
     * @param Contact $item
     */
    protected function delete($item)
    {
        $this->checkCanDelete($item);
        $item->delete();
        $this->queue(new Events\ContactDeleted($item));
    }

    /**
     * @param Contact $item
     */
    protected function checkCanDelete(Contact $item)
    {
        if ($this->auth->is('admin')) {
        }
    }
}
