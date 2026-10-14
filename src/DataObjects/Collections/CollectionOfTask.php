<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects\Collections;

use Illuminate\Support\Collection;
use NetworkRailBusinessSystems\BravoApi\DataObjects\Task;

class CollectionOfTask extends Collection
{
    public function offsetGet(mixed $key): Task
    {
        return parent::offsetGet($key);
    }
}
