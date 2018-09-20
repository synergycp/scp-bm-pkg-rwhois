<?php

namespace Packages\Rwhois\App\Contact;

use App\Http\Requests\RestRequest;

class ContactFormRequest
extends RestRequest
{
    /**
     * Load rules.
     */
    public function boot()
    {
        $this->rules = [
        ];
    }
}
