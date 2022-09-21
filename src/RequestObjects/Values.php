<?php

namespace NetworkRailBusinessSystems\BravoApi\RequestObjects;

class Values
{
    public Value $value;

    public function __construct()
    {
        $this->value = new Value();
    }
}
