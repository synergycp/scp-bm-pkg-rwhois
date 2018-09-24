<?php

namespace Packages\Rwhois\App\Contact;

use App\Database\Models;

/**
 * Database storage and retrieval of Contacts.
 *
 * @property int    type
 * @property int    client_id
 * @property int    id
 * @property string name
 * @property string email
 * @property string phone
 */
class Contact
    extends Models\Model
{
    // Traits
    use ContactSearch;

    const TYPE_ABUSE = 0;

    const TYPE_POC = 1;

    const TYPE_TECH = 2;
    const ROLE_TO_ALLOW_SETTING = [
        self::TYPE_ABUSE => 'pkg.rwhois.allow_role.abuse',
        self::TYPE_POC => 'pkg.rwhois.allow_role.poc',
        self::TYPE_TECH => 'pkg.rwhois.allow_role.tech',
    ];
    const ROLE_TO_DEFAULT_EMAIL_SETTING = [
        self::TYPE_ABUSE => 'pkg.rwhois.contact.abuse.email',
        self::TYPE_POC => 'pkg.rwhois.contact.poc.email',
        self::TYPE_TECH => 'pkg.rwhois.contact.tech.email',
    ];
    const ROLE_TO_DEFAULT_NAME_SETTING = [
        self::TYPE_ABUSE => 'pkg.rwhois.contact.abuse.name',
        self::TYPE_POC => 'pkg.rwhois.contact.poc.name',
        self::TYPE_TECH => 'pkg.rwhois.contact.tech.name',
    ];
    const ROLE_TO_DEFAULT_PHONE_SETTING = [
        self::TYPE_ABUSE => 'pkg.rwhois.contact.abuse.phone',
        self::TYPE_POC => 'pkg.rwhois.contact.poc.phone',
        self::TYPE_TECH => 'pkg.rwhois.contact.tech.phone',
    ];

    public static $singular = 'Contact';
    public static $plural = 'Contacts';
    public static $controller = 'pkg.rwhois.contact';
    protected static $typeDesc = [
        self::TYPE_ABUSE => 'Abuse',
        self::TYPE_POC => 'POC',
        self::TYPE_TECH => 'Tech',
    ];
    protected $table = 'pkg_rwhois_contacts';

    protected $casts = [
    ];

    protected $attributes = [
        'type' => self::TYPE_ABUSE,
    ];

    /**
     * @return int[]
     */
    public static function allowedTypes()
    {
        return array_keys(static::$typeDesc);
    }

    /**
     * @param int $type
     *
     * @return string
     */
    public static function allowSettingFromType($type)
    {
        $settingName = array_get(static::ROLE_TO_ALLOW_SETTING, $type);

        if (!$settingName) {
            abort(400, 'Invalid type specified');
        }

        return $settingName;
    }

    /**
     * @param int $type
     *
     * @return string
     */
    public static function nameSettingFromType($type)
    {
        $settingName = array_get(static::ROLE_TO_DEFAULT_NAME_SETTING, $type);

        if (!$settingName) {
            abort(400, 'Invalid type specified');
        }

        return $settingName;
    }

    /**
     * @param int $type
     *
     * @return string
     */
    public static function emailSettingFromType($type)
    {
        $settingName = array_get(static::ROLE_TO_DEFAULT_EMAIL_SETTING, $type);

        if (!$settingName) {
            abort(400, 'Invalid type specified');
        }

        return $settingName;
    }

    /**
     * @param int $type
     *
     * @return string
     */
    public static function phoneSettingFromType($type)
    {
        $settingName = array_get(static::ROLE_TO_DEFAULT_PHONE_SETTING, $type);

        if (!$settingName) {
            abort(400, 'Invalid type specified');
        }

        return $settingName;
    }

    /**
     * @return string
     */
    public function getTypeDescription()
    {
        return static::$typeDesc[$this->type];
    }
}
