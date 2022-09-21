<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects;

use Spatie\DataTransferObject\DataTransferObject;

class Tender extends DataTransferObject
{
    public TenderData $tender;
}
