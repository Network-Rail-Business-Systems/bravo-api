<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects;

use NetworkRailBusinessSystems\BravoApi\DataObjects\Casters\TaskCollectionCaster;
use NetworkRailBusinessSystems\BravoApi\DataObjects\Collections\CollectionOfTask;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;

class Workflow extends DataTransferObject
{
    public string $tenderCode;

    public string $tenderReferenceCode;

    public string $tenderTitle;

    public string $tenderStatus;

    public string $workFlowType;

    public string $sourceTemplateCode;

    public string $sourceTemplateReferenceCode;

    public string $sourceTemplateTitle;

    #[MapFrom('taskList.task')]
    #[CastWith(TaskCollectionCaster::class)]
    public CollectionOfTask $tasks;
}
