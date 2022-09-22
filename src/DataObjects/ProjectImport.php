<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects;

use Spatie\DataTransferObject\DataTransferObject;

class ProjectImport extends DataTransferObject
{
    public int $returnCode;
    public string $returnMessage;
    public string|null $tenderCode;
    public string|null $tenderReferenceCode;
    public ?string $primaryIp;
}
