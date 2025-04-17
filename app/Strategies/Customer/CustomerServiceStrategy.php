<?php

namespace App\Strategies\Customer;

use App\Services\Customer\CustomerService;

class CustomerServiceStrategy
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
        return match ($service) {
            'customer'    => app(CustomerService::class), // Resolve CustomerService instance from the Laravel container
            default     => throw new \Exception("Unsupported customer service: $service"), // Handle invalid services
        };
    }
}
