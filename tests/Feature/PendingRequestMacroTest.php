<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests\Feature;

use Faker\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use NetworkRailBusinessSystems\BravoApi\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use ReflectionClass;

class PendingRequestMacroTest extends TestCase
{
    private string $proxyAddress;

    public function setUp(): void
    {
        parent::setUp();

        $this->proxyAddress = Factory::create()->url();
    }

    #[DataProvider('nonProxyEnvironments')]
    public function test_proxy_will_not_be_added_to_client_when_environment_to(string $environment)
    {
        $this->setEnvironment($environment);

        $client = Http::proxy($this->proxyAddress);

        $options = $this->getOptions($client);

        $this->assertArrayNotHasKey('proxy', $options);
    }

    #[DataProvider('proxyEnvironments')]
    public function test_proxy_will_be_added_to_client_when_environment_set_to(string $environment)
    {
        $this->setEnvironment($environment);

        $client = Http::proxy($this->proxyAddress);

        $options = $this->getOptions($client);

        $this->assertArrayHasKey('proxy', $options);
        $this->assertSame($this->proxyAddress, $options['proxy']);
    }

    public static function nonProxyEnvironments(): array
    {
        return [
            ['local'],
            ['testing'],
        ];
    }

    public static function proxyEnvironments(): array
    {
        return [
            ['staging'],
            ['production'],
        ];
    }

    protected function getOptions(PendingRequest $client): array
    {
        $reflectionProperty = (new ReflectionClass(PendingRequest::class))
            ->getProperty('options');

        $reflectionProperty->setAccessible(true);

        return $reflectionProperty->getValue($client);
    }

    protected function setEnvironment(string $environment): void
    {
        app()->detectEnvironment(fn() => $environment);
    }
}
