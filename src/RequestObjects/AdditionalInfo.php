<?php

namespace NetworkRailBusinessSystems\BravoApi\RequestObjects;

class AdditionalInfo
{
    public string $name;
    public Values $values;

    public function __construct()
    {
        $this->values = new Values();
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'values' => [
                'value' => [
                    [
                        'value' => $this->values->value->value,
                        'id' => $this->values->value->id,
                    ],
                ],
            ],
        ];
    }
}
