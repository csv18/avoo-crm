<?php

namespace App\Strategies\Payment;

use App\Services\Payment\GoCardlessService;
use App\Services\Payment\StripeService;
use Exception;

class PaymentServiceStrategy
{
    /**
     * Get the appropriate payment service strategy based on the given service name.
     *
     * @param string $service The name of the payment service (e.g., 'stripe').
     * @return mixed An instance of the corresponding payment service class.
     * @throws \Exception If the provided service is not supported.
     */
    public static function getStrategy(string $service)
    {
        return match (strtolower($service)) {
            'stripe'         => app(StripeService::class),
            'gocardless'     => app(GoCardlessService::class),
            default      => throw new Exception("Unsupported payment service: $service"),
        };
    }
}
