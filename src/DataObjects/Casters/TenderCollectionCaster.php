<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects\Casters;

use NetworkRailBusinessSystems\BravoApi\DataObjects\Collections\CollectionOfTender;
use NetworkRailBusinessSystems\BravoApi\DataObjects\Tender;
use Spatie\DataTransferObject\Caster;

class TenderCollectionCaster implements Caster
{
    public function cast(mixed $value): CollectionOfTender
    {
        return new CollectionOfTender(array_map(
            fn (array $data) => new Tender(...$data),
            $value
        ));
    }
}
