<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects\Casters;

use NetworkRailBusinessSystems\BravoApi\DataObjects\Category;
use NetworkRailBusinessSystems\BravoApi\DataObjects\Collections\CollectionOfCategory;
use Spatie\DataTransferObject\Caster;

class CategoryCollectionCaster implements Caster
{
    public function cast(mixed $value): CollectionOfCategory
    {
        return new CollectionOfCategory(
            array_map(fn(array $data) => new Category(...$data), $value),
        );
    }
}
