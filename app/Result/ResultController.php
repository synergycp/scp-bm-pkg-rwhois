<?php

namespace Packages\Rwhois\App\Result;

use App\Api;
use App\Entity\LookupService;
use App\Ip\IpService;
use Illuminate\Http\Response;

/**
 * Handle HTTP requests regarding Results.
 */
class ResultController
extends Api\Controller
{
    /**
     * @var ResultTransformer
     */
    protected $transform;

    /**
     * @var LookupService
     */
    protected $entity;

    /**
     * @var IpService
     */
    protected $ip;

    /**
     * ResultController constructor.
     *
     * @param ResultTransformer $transform
     * @param LookupService     $entity
     * @param IpService         $ip
     */
    public function __construct(ResultTransformer $transform, LookupService $entity, IpService $ip)
    {
        $this->transform = $transform;
        $this->entity = $entity;
        $this->ip = $ip;
    }

    /**
     * @param string $ip
     *
     * @return Response
     */
    public function show($ip)
    {
        $entity = $this->entity->addr(
            $this->ip->make($ip)
        );

        if (!$entity) {
            return $this->error(1, 'IP ' . $ip . ' not found');
        }

        return response($this->transform->item($entity, $ip));
    }

    /**
     * @param int $code
     * @param string $message
     *
     * @return Response
     */
    public function error($code, $message)
    {
        return response(implode(' ', ['error', $code, $message]));
    }
}
