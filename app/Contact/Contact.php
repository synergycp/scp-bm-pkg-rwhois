<?php

namespace Packages\Rwhois\App\Contact;

use App\Database\Models;
use Illuminate\Database\Eloquent\Builder;

/**
 * Database storage and retrieval of Contacts.
 */
class Contact
extends Models\Model
{
    // Traits
    use ContactSearch;

    public static $singular = 'Contact';
    public static $plural = 'Contacts';
    public static $controller = 'pkg.rwhois.contact';

    protected $table = 'pkg_rwhois_contacts';

    protected $casts = [
    ];
}
