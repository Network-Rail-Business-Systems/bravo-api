<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests\Data;

class ProjectSearchResponse
{
    public static function successfulSearch()
    {
        return json_decode(file_get_contents(__DIR__.'/projects_search.json'), true);
    }

    public static function successfulGet()
    {
        return json_decode(file_get_contents(__DIR__.'/get_project.json'), true);
    }

    public static function unsuccessfulResponse()
    {
        return [
            'returnCode' => 2,
            'returnMessage' => 'operation not completed due to error as detailed in the returned message',
            'totRecords' => 0,
            'returnedRecords' => 0,
            'startAt' => 1,
        ];
    }
}
