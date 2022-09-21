<?php

namespace NetworkRailBusinessSystems\BravoApi\Tests\Data;

class ProjectOperationResponse
{
    public static function successful()
    {
        return [
            'returnCode' => 0,
            'returnMessage' => 'Ok',
            'tenderCode' => 'tender_99999',
            'tenderReferenceCode' => '9999',
        ];
    }

    public static function unsuccessful()
    {
        return [
            'returnCode' => 2,
            'returnMessage' => '124(code,TenderCode,TenderReferenceCode)',
            'tenderCode' => null,
            'tenderReferenceCode' => null,
        ];
    }
}
