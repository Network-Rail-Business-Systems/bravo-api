<?php

namespace NetworkRailBusinessSystems\BravoApi\RequestObjects;

use NetworkRailBusinessSystems\BravoApi\Enums\LotType;
use NetworkRailBusinessSystems\BravoApi\Enums\WorkflowType;

class Tender
{
    public string|null $code;
    public string|null $tenderCode;
    public string|null $tenderReferenceCode;
    public string $title;
    public string|null $description;
    public string|null $reference;
    public User|null $buyerCompany = null;
    public User|null $projectOwner = null;
    public string|null $officialStartDate;
    public string|null $requirementsDate;
    public string|null $sourceTemplateCode;
    public string|null $sourceTemplateReferenceCode;
    public LotType $lotType;
    public string|null $projectType;
    public WorkflowType $workFlowType;

    /** @var FlexibleField[] */
    public $flexibleFields;

    public AdditionalInfoList $additionalInfoList;
    public Attachment $buyerAttachmentList;
    public Attachment $sellerAttachmentList;

    public function __construct()
    {
        $this->additionalInfoList = new AdditionalInfoList();
        $this->buyerAttachmentList = new Attachment();
        $this->sellerAttachmentList = new Attachment();

        $this->lotType = LotType::SINGLELOTS();
        $this->workFlowType = WorkflowType::NONE();
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code ?? null,
            'tenderCode' => $this->tenderCode ?? null,
            'tenderReferenceCode' => $this->tenderReferenceCode ?? null,
            'title' => $this->title ?? null,
            'description' => $this->description ?? null,
            'reference' => $this->reference ?? null,
            'buyerCompany' => $this->buyerCompany?->toArray(),
            'projectOwner' => $this->projectOwner?->toArray(),
            'officialStartDate' => $this->officialStartDate ?? null,
            'requirementsDate' => $this->requirementsDate ?? null,
            'sourceTemplateCode' => $this->sourceTemplateCode ?? null,
            'sourceTemplateReferenceCode' => $this->sourceTemplateReferenceCode ?? null,
            'lotType' => $this->lotType->value,
            'projectType' => $this->projectType ?? null,
            'workFlowType' => $this->workFlowType->value,
            'flexibleFields' => $this->flexibleFields,
            'additionalInfoList' => $this->additionalInfoList->toArray(),
            'buyerAttachmentList' => $this->buyerAttachmentList->toArray(),
            'sellerAttachmentList' => $this->sellerAttachmentList->toArray(),
        ];
    }
}
