<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests\Feature;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use NetworkRailBusinessSystems\BravoApi\BravoApi;
use NetworkRailBusinessSystems\BravoApi\Exceptions\BravoApiException;
use NetworkRailBusinessSystems\BravoApi\Tests\Data\ProjectSearchResponse;
use NetworkRailBusinessSystems\BravoApi\Tests\TestCase;

class SearchProjectsTest extends TestCase
{
    public function successful_search_projects()
    {
        Cache::set('bravo_bearer_token', 'test_token');
        Http::fake([
            'bravo.test/ja/v1/projects/*' => Http::response(
                ProjectSearchResponse::successfulSearch(),
            ),
        ]);

        $bravoApi = new BravoApi();
        $response = $bravoApi->searchProjects('test');

        $this->assertNotNull($response);
        $this->assertEquals(0, $response->returnCode);
        $this->assertCount(2, $response->projectList->project);
        $this->assertEquals(
            'tender_10066',
            $response->projectList->project->first()->tender->tenderCode,
        );
        $this->assertEquals(
            'GURU(38668)',
            $response->projectList->project->first()->tender->buyerCompany->name,
        );
    }

    /** @test */
    public function unsuccessful_search_projects()
    {
        $this->expectException(BravoApiException::class);

        Cache::set('bravo_bearer_token', 'test_token');
        Http::fake([
            'bravo.test/ja/v1/projects/*' => Http::response(
                ProjectSearchResponse::unsuccessfulResponse(),
            ),
        ]);

        $bravoApi = new BravoApi();
        $bravoApi->searchProjects('test');
    }
}
