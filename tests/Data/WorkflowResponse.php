<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests\Data;

class WorkflowResponse
{
    public static function successful(): array
    {
        return json_decode(file_get_contents(__DIR__.'/get_workflow.json'), true);
    }

    public static function unsuccessful(): int
    {
        return 1;
    }
}
