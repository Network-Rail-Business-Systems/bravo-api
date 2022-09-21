<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects\Collections;

use Illuminate\Support\Collection;
use NetworkRailBusinessSystems\BravoApi\DataObjects\Tender;

class CollectionOfTender extends Collection
{
    // @phpstan-ignore-next-line
    public function offsetGet(mixed $key): Tender
    {
        return parent::offsetGet($key);
    }
}
