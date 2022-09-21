<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects;

use Spatie\DataTransferObject\DataTransferObject;

class Task extends DataTransferObject
{
    public int $taskId;

    public string $name;

    public string $taskStatus;
}
