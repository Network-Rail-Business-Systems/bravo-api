<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests\Feature;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use NetworkRailBusinessSystems\BravoApi\BravoApi;
use NetworkRailBusinessSystems\BravoApi\Tests\Data\AuthenticateResponse;
use NetworkRailBusinessSystems\BravoApi\Tests\TestCase;

class AuthenticateTest extends TestCase
{
    /** @test */
    public function successful_authentication()
    {
        Http::fake([
            'bravo.test/v1/tokens' => Http::response(AuthenticateResponse::successful()),
        ]);

        $bravoApi = new BravoApi();
        $response = $bravoApi->authenticate();

        $this->assertTrue($response);
    }

    /** @test */
    public function failed_authentication()
    {
        $this->expectException(RequestException::class);
        $this->expectExceptionMessage('HTTP request returned status code 401');
        $this->expectExceptionCode(401);

        Http::fake([
            'bravo.test/v1/tokens' => Http::response(null, 401),
        ]);

        $bravoApi = new BravoApi();
        $bravoApi->authenticate();
    }
}
