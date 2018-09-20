<?php

namespace Packages\Rwhois\App\Contact;

use App\Http\Requests\ListRequest;

class ContactListRequest
extends ListRequest
{
    public $orders = [];
}
