<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects;

use Spatie\DataTransferObject\DataTransferObject;

class Category extends DataTransferObject
{
    public string $categoryCode;
    public string $categoryName;
}
