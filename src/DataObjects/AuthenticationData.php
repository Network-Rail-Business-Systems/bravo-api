<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects;

use Spatie\DataTransferObject\DataTransferObject;

class AuthenticationData extends DataTransferObject
{
    public string $token;
    public string $resource;
    public string $token_type;
    public string $expire_on;
    public int $expire_in;
}
