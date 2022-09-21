<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests\Feature;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use NetworkRailBusinessSystems\BravoApi\BravoApi;
use NetworkRailBusinessSystems\BravoApi\Tests\Data\ProjectSearchResponse;
use NetworkRailBusinessSystems\BravoApi\Tests\TestCase;

class GetProjectTest extends TestCase
{
    public function test_get_project()
    {
        Cache::set('bravo_bearer_token', 'test_token');
        Http::fake([
            'bravo.test/ja/v1/projects/tender_10066' => Http::response(
                ProjectSearchResponse::successfulGet(),
            ),
        ]);

        $bravoApi = new BravoApi();
        $response = $bravoApi->getProject('tender_10066');

        $this->assertNotNull($response);
        $this->assertEquals('tender_10066', $response->tender->tenderCode);
        $this->assertEquals('GURU(38668)', $response->tender->buyerCompany->name);
        $this->assertEquals('01.02.03.04', $response->categoryList->first()->categoryCode);
        $this->assertEquals('An example category', $response->categoryList->first()->categoryName);
    }

    /** @test */
    public function unsuccessful_get_project_returns_404()
    {
        $this->expectException(RequestException::class);

        Cache::set('bravo_bearer_token', 'test_token');

        Http::fake([
            'bravo.test/ja/v1/projects/tender_10066' => Http::response([], 404),
        ]);

        $bravoApi = new BravoApi();
        $bravoApi->getProject('tender_10066');
    }
}
