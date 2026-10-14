<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects\Collections;

use Illuminate\Support\Collection;
use NetworkRailBusinessSystems\BravoApi\DataObjects\User;

class CollectionOfUser extends Collection
{
    public function offsetGet(mixed $key): User
    {
        return parent::offsetGet($key);
    }
}
