<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests\Unit;

use NetworkRailBusinessSystems\BravoApi\DataObjects\ProjectSearchData;
use NetworkRailBusinessSystems\BravoApi\Tests\TestCase;

class ProjectSearchTest extends TestCase
{
    public function test_project_search_data()
    {
        $data = file_get_contents(__DIR__.'/../Data/projects_search.json');

        $response = new ProjectSearchData(json_decode($data, true));

        $this->assertNotNull($response);
        $this->assertEquals(
            'tender_10066',
            $response->projectList->project->first()->tender->tenderCode
        );
        $this->assertEquals(
            '29/03/2010',
            $response->projectList->project->first()->tender->activationDate->format('d/m/Y')
        );
        $this->assertNull($response->projectList->project->first()->tender->officialStartDate);
    }
}
