<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects;

use NetworkRailBusinessSystems\BravoApi\DataObjects\Casters\TaskCollectionCaster;
use NetworkRailBusinessSystems\BravoApi\DataObjects\Collections\CollectionOfTask;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class Workflow extends DataTransferObject
{
    public ?string $tenderCode;

    public ?string $tenderReferenceCode;

    public ?string $tenderTitle;

    public ?string $tenderStatus;

    public ?string $workFlowType;

    public ?string $sourceTemplateCode;

    public ?string $sourceTemplateReferenceCode;

    public ?string $sourceTemplateTitle;

    public ?string $primaryIp;

    #[MapFrom('taskList.task')]
    #[CastWith(TaskCollectionCaster::class)]
    public CollectionOfTask $tasks;
}
