<?php

namespace NetworkRailBusinessSystems\BravoApi\RequestObjects;

class Opportunity
{
    public string $description;
    public string|null $notes;
    public string|null $opportunityStatus;
    public int $workCategoryId;
    public int $procurementRouteId;
    public string $listingExpiryDate;
    public string|null $contractStartDate;
    public string|null $contractDuration;
    public string|null $contractValue;
    public string|null $buyerOrganisation;
    public string|null $buyerName;
    public string|null $buyerEmail;
    public string|null $directUrl;
    public string|null $webLink;

    /** @var AttachmentDetail[] */
    public $opportunityAttachmentList;
}
