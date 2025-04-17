<?php

namespace App\Strategies\Accounting;

use App\Services\Accounting\XeroService;

class AccountingServiceStrategy
{
    public static function getStrategy(string $service)
    {
        return match ($service) {
            'xero' => new XeroService(),
            default => throw new \Exception("Unsupported accounting service: $service"),
        };
    }
}
