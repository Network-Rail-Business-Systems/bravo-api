<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects\Collections;

use Illuminate\Support\Collection;
use NetworkRailBusinessSystems\BravoApi\DataObjects\User;

class CollectionOfUser extends Collection
{
    // @phpstan-ignore-next-line
    public function offsetGet(mixed $key): User
    {
        return parent::offsetGet($key);
    }
}
