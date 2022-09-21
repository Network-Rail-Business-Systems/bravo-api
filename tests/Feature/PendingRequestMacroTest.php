<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests\Feature;

use Faker\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use NetworkRailBusinessSystems\BravoApi\Tests\TestCase;

class PendingRequestMacroTest extends TestCase
{
    private string $proxyAddress;

    public function setUp(): void
    {
        parent::setUp();

        $this->proxyAddress = Factory::create()->url();
    }


    /**
     * @test
     * @dataProvider nonProxyEnvironments
     */
    public function proxy_will_not_be_added_to_client_when_environment_to(string $environment)
    {
        $this->setEnvironment($environment);

        $client = Http::proxy($this->proxyAddress);

        $options = $this->getOptions($client);

        $this->assertArrayNotHasKey('proxy', $options);
    }


    /**
     * @test
     * @dataProvider proxyEnvironments
     */
    public function proxy_will_be_added_to_client_when_environment_set_to(string $environment)
    {
        $this->setEnvironment($environment);

        $client = Http::proxy($this->proxyAddress);

        $options = $this->getOptions($client);

        $this->assertArrayHasKey('proxy', $options);
        $this->assertSame($this->proxyAddress, $options['proxy']);
    }


    public function nonProxyEnvironments(): array
    {
        return [
            ['local'],
            ['testing'],
        ];
    }


    public function proxyEnvironments(): array
    {
        return [
            ['staging'],
            ['production'],
        ];
    }


    protected function getOptions(PendingRequest $client): array
    {
        $reflectionProperty = (new \ReflectionClass(PendingRequest::class))
            ->getProperty('options');

        $reflectionProperty->setAccessible(true);

        return $reflectionProperty->getValue($client);
    }


    protected function setEnvironment(string $environment): void
    {
        app()->detectEnvironment(fn () => $environment);
    }
}
