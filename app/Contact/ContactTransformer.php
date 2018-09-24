<?php

namespace Packages\Rwhois\App\Contact;

use App\Api\Transformer;

class ContactTransformer
extends Transformer
{
    /**
     * @param Contact $item
     *
     * @return array
     */
    public function item(Contact $item)
    {
        return $item->expose([
            'id',
            'name',
            'email',
            'phone',
        ]) + [
            'type' => [
                'id' => $item->type,
                'name' => $item->getTypeDescription(),
            ],
        ];
    }

    /**
     * @param Contact $item
     *
     * @return array
     */
    public function resource(Contact $item)
    {
        return $this->item($item) + [
        ];
    }
}
