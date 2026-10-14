<?php

namespace NetworkRailBusinessSystems\BravoApi\RequestObjects;

use NetworkRailBusinessSystems\BravoApi\Enums\LotType;
use NetworkRailBusinessSystems\BravoApi\Enums\WorkflowType;

class Tender
{
    public ?string $code;
    public ?string $tenderCode;
    public ?string $tenderReferenceCode;
    public string $title;
    public ?string $description;
    public ?string $reference;
    public ?User $buyerCompany = null;
    public ?User $projectOwner = null;
    public ?string $officialStartDate;
    public ?string $requirementsDate;
    public ?string $sourceTemplateCode;
    public ?string $sourceTemplateReferenceCode;
    public LotType $lotType;
    public ?string $projectType;
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
