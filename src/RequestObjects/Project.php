<?php

namespace NetworkRailBusinessSystems\BravoApi\RequestObjects;

class Project
{
    public Tender $tender;
    public Opportunity $opportunity;

    public CategoryList $categoryList;

    /** @var User[] */
    public $projectTeam;

    public function __construct(bool $withOpportunity = false)
    {
        $this->tender = new Tender();

        if ($withOpportunity) {
            $this->opportunity = new Opportunity();
        }

        $this->categoryList = new CategoryList();
    }

    public function toArray(): array
    {
        return [
            'tender' => $this->tender->toArray(),
            'opportunity' => $this->opportunity ?? null,
            'categoryList' => $this->categoryList->toArray(),
            'projectTeam' => $this->projectTeam ?? null,
        ];
    }
}
