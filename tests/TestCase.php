<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function getPackageProviders($app): array
    {
        return [
            'NetworkRailBusinessSystems\BravoApi\BravoApiServiceProvider',
        ];
    }

    public function createTestStubs(array $files): array
    {
        $tmpDir = __DIR__ . '/tmp/';

        if (is_dir($tmpDir) === false) {
            mkdir($tmpDir);
        }

        $paths = [];

        foreach ($files as $path => $filename) {
            $newPath = "{$tmpDir}{$filename}";
            copy($path, $newPath);
            $paths[] = $newPath;
        }

        return $paths;
    }
}
