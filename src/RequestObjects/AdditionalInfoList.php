<?php

namespace NetworkRailBusinessSystems\BravoApi\RequestObjects;

class AdditionalInfoList
{
    /** @var \NetworkRailBusinessSystems\BravoApi\RequestObjects\AdditionalInfo[] */
    public $additionalInfo;

    public function toArray(): array
    {
        $additionalInfo = [];

        if ($this->additionalInfo !== null) {
            foreach ($this->additionalInfo as $info) {
                $additionalInfo[] = $info->toArray();
            }
        }
        return [
            'additionalInfo' => $additionalInfo,
        ];
    }
}
