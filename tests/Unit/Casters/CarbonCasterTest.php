<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests\Unit\Casters;

use NetworkRailBusinessSystems\BravoApi\DataObjects\Casters\CarbonCaster;
use NetworkRailBusinessSystems\BravoApi\Tests\TestCase;

class CarbonCasterTest extends TestCase
{
    /** @test */
    public function it_returns_null_for_null()
    {
        $carbonCaster = new CarbonCaster();
        $this->assertNull($carbonCaster->cast(null));
    }

    /** @test */
    public function it_returns_carbon_instance_for_valid_date()
    {
        $carbonCaster = new CarbonCaster();
        $this->assertEquals(
            '23/08/2021',
            $carbonCaster->cast('2021-08-23T13:11:34.000Z')->format('d/m/Y'),
        );
    }
}
