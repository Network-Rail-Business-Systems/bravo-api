<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects;

use NetworkRailBusinessSystems\BravoApi\DataObjects\Casters\CategoryCollectionCaster;
use NetworkRailBusinessSystems\BravoApi\DataObjects\Collections\CollectionOfCategory;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class GetProject extends DataTransferObject
{
    public TenderData $tender;

    #[CastWith(CategoryCollectionCaster::class)]
    public CollectionOfCategory $categoryList;

    public array $projectTeam;
    public array $projectObjectList;
    public array $purchaseRequestList;
}
