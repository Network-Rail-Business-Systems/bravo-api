<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects\Casters;

use NetworkRailBusinessSystems\BravoApi\DataObjects\Collections\CollectionOfUser;
use NetworkRailBusinessSystems\BravoApi\DataObjects\User;
use Spatie\DataTransferObject\Caster;

class UserCollectionCaster implements Caster
{
    public function cast(mixed $value): CollectionOfUser
    {
        return new CollectionOfUser(array_map(fn(array $data) => new User(...$data), $value));
    }
}
