<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use NetworkRailBusinessSystems\BravoApi\BravoApi;
use NetworkRailBusinessSystems\BravoApi\Exceptions\BravoApiException;
use NetworkRailBusinessSystems\BravoApi\Tests\Data\ProjectOperationResponse;
use NetworkRailBusinessSystems\BravoApi\Tests\TestCase;

class PostProjectTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Cache::set('bravo_bearer_token', 'test_token');
    }

    /** @test */
    public function attaches_json_file_to_request()
    {
        [$jsonFilePath] = $this->createTestStubs([
            __DIR__ . "/../Data/create_project.json" => 'project.json',
        ]);

        Http::fake([
            'bravo.test/ja/v1/projects/' => Http::response(ProjectOperationResponse::successful()),
        ]);

        $bravoApi = new BravoApi();
        $response = $bravoApi->postProject($jsonFilePath);

        Http::assertSent(function (Request $request) {
            return count($request->data()) === 1
                && $request->data()[0]['name'] === 'data'
                && is_resource($request->data()[0]['contents']);
        });
    }

    /** @test */
    public function attaches_attachment_to_request()
    {
        [$jsonFilePath, $pdfFilePath] = $this->createTestStubs([
            __DIR__ . "/../Data/create_project.json" => 'project.json',
            __DIR__ . "/../Data/attachment.pdf" => 'attachment.pdf',
        ]);

        Http::fake([
            'bravo.test/ja/v1/projects/' => Http::response(ProjectOperationResponse::successful()),
        ]);

        $bravoApi = new BravoApi();
        $response = $bravoApi->postProject($jsonFilePath, $pdfFilePath);

        Http::assertSent(function (Request $request) {
            return count($request->data()) === 2
                && $request->data()[0]['name'] === 'data'
                && $request->data()[1]['name'] === 'attachment.pdf'
                && is_resource($request->data()[0]['contents'])
                && is_resource($request->data()[1]['contents']);
        });
    }

    /** @test */
    public function deletes_temporary_files()
    {
        [$jsonFilePath] = $this->createTestStubs([
            __DIR__ . "/../Data/create_project.json" => 'project.json',
        ]);

        $this->assertTrue(file_exists($jsonFilePath));

        Http::fake([
            'bravo.test/ja/v1/projects/' => Http::response(ProjectOperationResponse::successful()),
        ]);

        $bravoApi = new BravoApi();
        $response = $bravoApi->postProject($jsonFilePath);

        $this->assertFalse(file_exists($jsonFilePath));
    }

    /** @test */
    public function successfully_create_project()
    {
        [$jsonFilePath] = $this->createTestStubs([
            __DIR__ . "/../Data/create_project.json" => 'project.json',
        ]);

        Http::fake([
            'bravo.test/ja/v1/projects/' => Http::response(ProjectOperationResponse::successful()),
        ]);

        $bravoApi = new BravoApi();
        $response = $bravoApi->postProject($jsonFilePath);

        $this->assertEquals(0, $response->returnCode);
        $this->assertEquals('Ok', $response->returnMessage);
        $this->assertEquals('tender_99999', $response->tenderCode);
        $this->assertEquals('9999', $response->tenderReferenceCode);
    }

    /** @test */
    public function error_creating_project()
    {
        $this->expectException(BravoApiException::class);
        $this->expectExceptionMessage('124(code,TenderCode,TenderReferenceCode)');

        [$jsonFilePath] = $this->createTestStubs([
            __DIR__ . "/../Data/create_project.json" => 'project.json',
        ]);

        Http::fake([
            'bravo.test/ja/v1/projects/' => Http::response(
                ProjectOperationResponse::unsuccessful(),
            ),
        ]);

        $bravoApi = new BravoApi();
        $bravoApi->postProject($jsonFilePath);
    }
}
