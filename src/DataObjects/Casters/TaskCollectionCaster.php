<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects\Casters;

use NetworkRailBusinessSystems\BravoApi\DataObjects\Collections\CollectionOfTask;
use NetworkRailBusinessSystems\BravoApi\DataObjects\Task;
use Spatie\DataTransferObject\Caster;

class TaskCollectionCaster implements Caster
{
    public function cast(mixed $value): CollectionOfTask
    {
        return new CollectionOfTask(array_map(
            fn (array $data) => new Task(...$data),
            $value
        ));
    }
}
