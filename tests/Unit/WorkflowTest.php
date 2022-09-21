<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests\Unit;

use NetworkRailBusinessSystems\BravoApi\DataObjects\Workflow;
use NetworkRailBusinessSystems\BravoApi\Tests\Data\WorkflowResponse;
use NetworkRailBusinessSystems\BravoApi\Tests\TestCase;

class WorkflowTest extends TestCase
{
    public function test_workflow_data()
    {
        $data = WorkflowResponse::successful();

        $response = new Workflow($data);

        $this->assertNotNull($response);

        $this->assertEquals(
            'One Tender To Rule Them All, One Tender To Find Them, One Tender To Bring Them All And In The Darkness Bind Them.',
            $response->tenderTitle
        );

        $this->assertEquals(
            'One potato, two potatoes, three potatoes, four...',
            $response->tasks->first()->name
        );
    }
}
