<?php

namespace Packages\Rwhois\App\Result;

use Illuminate\Database\Eloquent\Builder;
use App\Support\Http\FilterService;

/**
 * Filter Results by those visible to the specific Request.
 */
class ResultFilterService
extends FilterService
{
    /**
     * @var ResultListRequest
     */
    protected $request;
    protected $requestClass = ResultListRequest::class;

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
