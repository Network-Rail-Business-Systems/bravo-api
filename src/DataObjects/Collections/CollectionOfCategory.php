<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects\Collections;

use Illuminate\Support\Collection;
use NetworkRailBusinessSystems\BravoApi\DataObjects\Category;

class CollectionOfCategory extends Collection
{
    public function offsetGet(mixed $key): Category
    {
        return parent::offsetGet($key);
    }
}
