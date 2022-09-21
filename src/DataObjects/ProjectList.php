<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects;

use NetworkRailBusinessSystems\BravoApi\DataObjects\Casters\TenderCollectionCaster;
use NetworkRailBusinessSystems\BravoApi\DataObjects\Collections\CollectionOfTender;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class ProjectList extends DataTransferObject
{
    #[CastWith(TenderCollectionCaster::class)]
    public CollectionOfTender $project;
}
