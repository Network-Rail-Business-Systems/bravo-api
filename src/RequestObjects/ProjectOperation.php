<?php

namespace NetworkRailBusinessSystems\BravoApi\RequestObjects;

use NetworkRailBusinessSystems\BravoApi\Enums\OperationCode;

class ProjectOperation
{
    public OperationCode $operationCode;
    public Project $project;

    public function toArray(): array
    {
        return [
            'operationCode' => $this->operationCode->value,
            'project' => $this->project->toArray(),
        ];
    }
}
