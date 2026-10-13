<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests\Feature;

use GuzzleHttp\Psr7\Stream;
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

    public function test_attaches_json_file_to_request(): void
    {
        [$jsonFilePath] = $this->createTestStubs([
            __DIR__ . "/../Data/create_project.json" => 'project.json',
        ]);

        Http::fake([
            'bravo.test/ja/v1/projects/' => Http::response(ProjectOperationResponse::successful()),
        ]);

        $bravoApi = new BravoApi();
        $bravoApi->postProject($jsonFilePath);

        Http::assertSent(function (Request $request) {
            $data = $request->data();

            return $data[0]['name'] === 'data'
                && $data[0]['contents'] instanceof Stream;
        });
    }

    public function test_attaches_attachment_to_request(): void
    {
        [$jsonFilePath, $pdfFilePath] = $this->createTestStubs([
            __DIR__ . "/../Data/create_project.json" => 'project.json',
            __DIR__ . "/../Data/attachment.pdf" => 'attachment.pdf',
        ]);

        Http::fake([
            'bravo.test/ja/v1/projects/' => Http::response(ProjectOperationResponse::successful()),
        ]);

        $bravoApi = new BravoApi();
        $bravoApi->postProject($jsonFilePath, $pdfFilePath);

        Http::assertSent(function (Request $request) {
            $data = $request->data();

            return $data[0]['name'] === 'data'
                && $data[0]['contents'] instanceof Stream
                && $data[1]['name'] === 'attachment.pdf'
                && $data[1]['contents'] instanceof Stream;
        });
    }

    public function test_deletes_temporary_files(): void
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

    public function test_successfully_create_project(): void
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

    public function test_error_creating_project(): void
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
