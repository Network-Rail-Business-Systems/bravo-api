<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests\Feature;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use NetworkRailBusinessSystems\BravoApi\BravoApi;
use NetworkRailBusinessSystems\BravoApi\Tests\Data\WorkflowResponse;
use NetworkRailBusinessSystems\BravoApi\Tests\TestCase;

class GetWorkflowTest extends TestCase
{
    public function test_get_workflow()
    {
        Cache::set('bravo_bearer_token', 'test_token');

        Http::fake([
            'bravo.test/ja/v1/workflows/tender_12345' => Http::response(
                WorkflowResponse::successful(),
            ),
        ]);

        $bravoApi = new BravoApi();
        $response = $bravoApi->getWorkflow('tender_12345');

        $this->assertNotNull($response);
        $this->assertEquals('tender_12345', $response->tenderCode);
        $this->assertEquals(
            'One Tender To Rule Them All, One Tender To Find Them, One Tender To Bring Them All And In The Darkness Bind Them.',
            $response->tenderTitle
        );
        $this->assertEquals('One potato, two potatoes, three potatoes, four...', $response->tasks->first()->name);
    }

    /** @test */
    public function unsuccessful_get_workflow_returns_404()
    {
        $this->expectException(RequestException::class);

        Cache::set('bravo_bearer_token', 'test_token');

        Http::fake([
            'bravo.test/ja/v1/workflows/tender_unknown' => Http::response(WorkflowResponse::unsuccessful(), 404),
        ]);

        $bravoApi = new BravoApi();
        $bravoApi->getWorkflow('tender_unknown');
    }
}
