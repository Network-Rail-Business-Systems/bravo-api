<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects;

use Carbon\Carbon;
use NetworkRailBusinessSystems\BravoApi\DataObjects\Casters\CarbonCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class TenderData extends DataTransferObject
{
    public ?string $code;

    public string $tenderCode;

    public string $tenderReferenceCode;

    public string $title;

    public User $buyerCompany;

    public User $projectOwner;

    #[CastWith(CarbonCaster::class)]
    public ?Carbon $activationDate;

    #[CastWith(CarbonCaster::class)]
    public ?Carbon $officialStartDate;

    #[CastWith(CarbonCaster::class)]
    public ?Carbon $estimatedCompletionDate;

    #[CastWith(CarbonCaster::class)]
    public Carbon $creationDate;

    #[CastWith(CarbonCaster::class)]
    public ?Carbon $requirementsDate;

    #[CastWith(CarbonCaster::class)]
    public ?Carbon $lastModTime;

    public int $divisionId;

    public string $divisionName;

    public int $tenderState;

    public string $tenderStatusLabel;

    public string $sourceTemplateCode;

    public string $sourceTemplateReferenceCode;

    public string $lotType;

    public string $projectType;

    public ?string $workFlowType;

    public int $archiveStatus;

    public ?array $additionalInfoList;

    public ?array $buyerAttachmentList;

    public ?int $deleted;
}
