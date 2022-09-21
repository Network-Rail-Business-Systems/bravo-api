<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects;

use Spatie\DataTransferObject\DataTransferObject;

class ProjectSearchData extends DataTransferObject
{
    public int $returnCode;
    public string $returnMessage;
    public int $totRecords;
    public int $returnedRecords;
    public int $startAt;
    public ProjectList|null $projectList;
}
