<?php

namespace App\Services\Customer;

use Illuminate\Support\Facades\Http;

/**
 * Service class for handling Stripe customer and charge-related operations.
 */
class CustomerService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.customer_api.base_url');
        $this->apiKey = config('services.customer_api.key');
    }

    protected function sendRequest(array $payload, string $endpoint)
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
        ])
            ->post("{$this->baseUrl}/{$endpoint}", $payload)
            ->throw()
            ->json();
    }

    public function createCustomer(array $data)
    {
        $data = array_merge([
            'action' => 'createCustomer',
            'monolith_customer_id' => 'cus_435n',
            'email' => 'vigneshcs@gmail.com',
            'name' => 'Vignesh',
            'phone' => '',
            'postal_code' => '',
            'business_registration_number' => '',
            'billing_currency_id' => '',
            'type' => '1',
        ], $data);

        return $this->sendRequest($data, 'customers');
    }

    /**
     * Update an existing Stripe customer.
     *
     * @param array $data Updated customer details.
     * @return mixed Response from Stripe API.
     */
    public function updateCustomer(array $data)
    {
        $data = array_merge([
            'action' => 'updateCustomer',
            'monolith_customer_id' => 'cus_435n',
            'type' => '2',
            'name' => 'Vignesh',
            'email' => 'vigneshcs@gmail.com',
            'phone' => '5685758766',
            'billing_currency_id' => '',
            'business_registration_number' => '',
        ], $data);

        return $this->sendRequest($data, 'customers');
    }
}
