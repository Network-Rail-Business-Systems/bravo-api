<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects\Collections;

use Illuminate\Support\Collection;
use NetworkRailBusinessSystems\BravoApi\DataObjects\Category;

class CollectionOfCategory extends Collection
{
    // @phpstan-ignore-next-line
    public function offsetGet(mixed $key): Category
    {
        return parent::offsetGet($key);
    }
}
