<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects;

use Spatie\DataTransferObject\DataTransferObject;

class User extends DataTransferObject
{
    public int $id;
    public ?string $code;
    public string $name;
}
