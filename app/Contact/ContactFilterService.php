<?php

namespace Packages\Rwhois\App\Contact;

use Illuminate\Database\Eloquent\Builder;
use App\Support\Http\FilterService;

/**
 * Filter Contacts by those visible to the specific Request.
 */
class ContactFilterService
extends FilterService
{
    /**
     * @var ContactListRequest
     */
    protected $request;
    protected $requestClass = ContactListRequest::class;

    /**
     * @param Builder $query
     *
     * @throws \App\Api\Exceptions\ApiKeyNotFound
     * @throws \App\Auth\Exceptions\InvalidIpAddress
     */
    public function viewable(Builder $query)
    {
        $this->auth->only([
            'admin',
            'integration',
            'client' => function ($clientId) use ($query) {
                $query->where('client_id', $clientId);
            },
        ]);
    }

    public function query(Builder $query)
    {
        $this->prepare()->apply($query);

        // Filter raw text search
        if ($searchText = $this->request->input('q')) {
            $query->search(
                $this->search->search($searchText)
            );
        }

        return $query;
    }
}
