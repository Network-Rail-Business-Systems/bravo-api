<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests\Data;

class AuthenticateResponse
{
    public static function successful()
    {
        return [
            'token' => 'test-token-1234',
            'resource' => 'test-url/tokens',
            'token_type' => 'Bearer',
            'expire_on' => now()->addDay()->toAtomString(),
            'expire_in' => 86399911
        ];
    }
}
