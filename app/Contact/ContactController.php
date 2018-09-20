<?php

namespace Packages\Rwhois\App\Contact;

use App\Api;

/**
 * Handle HTTP requests regarding Contacts.
 */
class ContactController
extends Api\Controller
{
    use Api\Traits\ListResource;
    use Api\Traits\ShowResource;
    use Api\Traits\UpdateResource;
    use Api\Traits\CreateResource;
    use Api\Traits\DeleteResource;

    /**
     * @var ContactRepository
     */
    protected $items;

    /**
     * @var ContactFilterService
     */
    protected $filter;

    /**
     * @var ContactUpdateService
     */
    protected $update;

    /**
     * @var ContactDeleteService
     */
    protected $delete;

    /**
     * @var ContactTransformer
     */
    protected $transform;

    /**
     * @param ContactRepository    $items
     * @param ContactFilterService $filter
     * @param ContactUpdateService $update
     * @param ContactDeleteService $delete
     * @param ContactTransformer   $transform
     */
    public function boot(
        ContactRepository $items,
        ContactFilterService $filter,
        ContactUpdateService $update,
        ContactDeleteService $delete,
        ContactTransformer $transform
    ) {
        $this->items = $items;
        $this->filter = $filter;
        $this->update = $update;
        $this->delete = $delete;
        $this->transform = $transform;
    }

    /**
     * Filter the Repository by viewable entries.
     */
    public function filter()
    {
        $this->items->filter([$this->filter, 'viewable']);
    }
}
