<?php

namespace Packages\Rwhois\App\Result;

use App\Api\Transformer;
use App\Client\Client;
use App\Entity\Entity;
use App\Server\Port\Port;
use Carbon\Carbon;
use Packages\Rwhois\App\Contact\Contact;
use Packages\Rwhois\App\Contact\ContactRepository;

class ResultTransformer
extends Transformer
{
    const DATE_FORMAT = 'YmdHisZ';

    const ROLE_DESC = [
        Contact::TYPE_ABUSE => 'Abuse',
        Contact::TYPE_POC => 'POC',
        Contact::TYPE_TECH => 'Tech',
    ];

    /**
     * @var ContactRepository
     */
    protected $contacts;

    /**
     * @var \stdClass
     */
    protected $settings;

    /**
     * ResultTransformer constructor.
     *
     * @param ContactRepository $contacts
     */
    public function boot(ContactRepository $contacts)
    {
        $this->contacts = $contacts;
        $this->settings = app('Settings');
    }

    /**
     * @param Entity $item
     * @param string $ip
     *
     * @return string
     */
    public function item(Entity $item, $ip)
    {
        $owner = $item->owner;
        /** @var Client|null $client */
        $client = null;
        /** @var Contact[] $contacts */
        $contacts = [];

        // TODO: additional interface HasClient for this?
        if ($owner && $owner instanceof Port) {
            $client = object_get($owner, 'server.access.client');
        }

        if ($client) {
            $contacts = $this->contacts
                ->query()
                ->where('client_id', $client->getKey())
                ->get()
                ->keyBy('type');
        }

        return implode("\n", array_flatten([
            '%rwhois V-1.0,V-1.5:002090:00  (SynergyCP RWhois Server v1.0.0)',
            'autharea='.($cidr = $item->getCidrAttribute()),
            'xautharea='.$cidr,
            'network:Class-Name:network',
            'network:Auth-Area:'.$cidr,
            'network:ID:NET.'.$ip,
            'network:Network-Name:'.$ip,
            'network:IP-Network:'.$ip,
            'network:IP-Network-Block:'.$ip,
            'network:Org-Name:Not Shared',
            'network:Street-Address:Not Shared',
            'network:City:Not Shared',
            'network:State:Not Shared',
            'network:Postal-Code:Not Shared',
            'network:Country-Code:US',
            'network:Tech-Contact:TECH.'.$ip,
            'network:Created:'.$this->dateFormat($item->created_at),
            'network:Updated:'.$this->dateFormat($item->updated_at),
            $this->contact($contacts, Contact::TYPE_ABUSE),
            $this->contact($contacts, Contact::TYPE_POC),
            $this->contact($contacts, Contact::TYPE_TECH),
            '%ok',
        ]));
    }

    /**
     * @param Carbon $date
     *
     * @return string|void
     */
    private function dateFormat(Carbon $date)
    {
        return $date->format(self::DATE_FORMAT);
    }

    /**
     * @param Contact[] $contacts
     * @param int $type
     *
     * @return array
     */
    private function contact($contacts, $type)
    {
        $desc = self::ROLE_DESC[$type];
        $contact = array_get($contacts, $type);
        $custom = $this->settings->{Contact::allowSettingFromType($type)} && $contact;
        $name = $custom ? $contact->name : $this->settings->{Contact::nameSettingFromType($type)};
        $email = $custom ? $contact->email : $this->settings->{Contact::emailSettingFromType($type)};
        $phone = $custom ? $contact->phone : $this->settings->{Contact::phoneSettingFromType($type)};

        return [
            'contact:'.$desc.'-Name:'.$name,
            'contact:'.$desc.'-Email:'.$email,
            'contact:'.$desc.'-Phone:'.$phone,
        ];
    }
//
//    /**
//     * @param Result $item
//     *
//     * @return array
//     */
//    public function resource(Result $item)
//    {
//        return $this->item($item) + [
//        ];
//    }
}
