<?php

namespace NetworkRailBusinessSystems\BravoApi\DataObjects\Casters;

use Carbon\Carbon;
use Spatie\DataTransferObject\Caster;

class CarbonCaster implements Caster
{
    public function cast(mixed $value): Carbon|null
    {
        return Carbon::make($value);
    }
}
