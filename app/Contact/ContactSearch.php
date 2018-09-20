<?php

namespace Packages\Rwhois\App\Contact;

trait ContactSearch
{
    use \App\Database\Models\Traits\Searchable;

    /**
     * @var array
     */
    protected $searchCols = [
    ];
}
