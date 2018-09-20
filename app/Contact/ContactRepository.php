<?php

namespace Packages\Rwhois\App\Contact;

use App\Database\ModelRepository;

/**
 * Store Contacts in and retrieve them from the database.
 */
class ContactRepository
extends ModelRepository
{
    protected $model = Contact::class;
}
