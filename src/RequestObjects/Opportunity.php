<?php

namespace NetworkRailBusinessSystems\BravoApi\RequestObjects;

class Opportunity
{
    public string $description;
    public ?string $notes;
    public ?string $opportunityStatus;
    public int $workCategoryId;
    public int $procurementRouteId;
    public string $listingExpiryDate;
    public ?string $contractStartDate;
    public ?string $contractDuration;
    public ?string $contractValue;
    public ?string $buyerOrganisation;
    public ?string $buyerName;
    public ?string $buyerEmail;
    public ?string $directUrl;
    public ?string $webLink;

    /** @var AttachmentDetail[] */
    public $opportunityAttachmentList;
}
