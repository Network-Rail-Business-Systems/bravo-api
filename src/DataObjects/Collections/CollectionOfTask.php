<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects\Collections;

use Illuminate\Support\Collection;
use NetworkRailBusinessSystems\BravoApi\DataObjects\Task;

class CollectionOfTask extends Collection
{
    // @phpstan-ignore-next-line
    public function offsetGet(mixed $key): Task
    {
        return parent::offsetGet($key);
    }
}
