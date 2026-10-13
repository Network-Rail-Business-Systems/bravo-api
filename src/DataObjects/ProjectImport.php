<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects;

use Spatie\DataTransferObject\DataTransferObject;

class ProjectImport extends DataTransferObject
{
    public int $returnCode;
    public string $returnMessage;
    public ?string $tenderCode;
    public ?string $tenderReferenceCode;
    public ?string $primaryIp;
}
