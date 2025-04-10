<?php

namespace App\Services\Payment;

use Illuminate\Support\Facades\Http;

class StripeService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.customer_api.base_url');
        $this->apiKey = config('services.customer_api.key');
    }

    protected function sendRequest(array $payload)
    {
        return Http::withToken($this->apiKey)
            ->post("{$this->baseUrl}/payment/customer", $payload)
            ->throw()
            ->json();
    }

    public function createCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'createCustomer',
            'service' => 'stripe',
            'monolith_customer_id' => 'test_12345',
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '1234567890',
            'description' => 'Test customer',
            'metadata' => ['source' => 'testing'],

            'address' => [
                'line1' => '123 Test St',
                'line2' => 'Suite 100',
                'city' => 'Testville',
                'state' => 'TS',
                'country' => 'US',
                'postal_code' => '12345',
            ],

            'shipping' => [
                'name' => 'John Doe',
                'phone' => '1234567890',
                'address' => [
                    'line1' => '123 Shipping Ln',
                    'line2' => 'Dock 9',
                    'city' => 'ShipCity',
                    'state' => 'SC',
                    'country' => 'US',
                    'postal_code' => '54321',
                ]
            ],

            'payment_method' => 'pm_card_visa',
            'tax' => ['vat' => '123456789'],
            'balance' => 0,
            'invoice_prefix' => 'JDOE',
            'preferred_locales' => ['en'],
            'promotion_code' => 'PROMO123',
            'tax_exempt' => 'none',

        ], $data);

        return $this->sendRequest($data);
    }

    public function updateCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'updateCustomer',
            'service' => 'stripe',
            'customer_id' => 'cus_ABC123',
            'monolith_customer_id' => 'test_12345',
            'name' => 'John Updated',
            'email' => 'john.updated@example.com',
            'phone' => '0987654321',
            'description' => 'Updated customer',
            'metadata' => ['updated' => true],
            'status' => 'active', // 👈 Include this for DB sync

            'address' => [
                'line1' => '456 New St',
                'line2' => null,
                'city' => 'Newville',
                'state' => 'NV',
                'country' => 'US',
                'postal_code' => '67890',
            ],

            'shipping' => [
                'name' => 'John Updated',
                'phone' => '0987654321',
                'address' => [
                    'line1' => '456 New Shipping Ln',
                    'line2' => null,
                    'city' => 'NewShipCity',
                    'state' => 'NS',
                    'country' => 'US',
                    'postal_code' => '98765',
                ]
            ],

            'payment_method' => 'pm_card_mastercard',
            'tax' => ['vat' => '987654321'],
            'balance' => 2000,
            'invoice_prefix' => 'UPD',
            'preferred_locales' => ['en', 'fr'],
            'promotion_code' => null,
            'tax_exempt' => 'exempt',

        ], $data);

        return $this->sendRequest($data);
    }


    public function retrieveCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveCustomer',
            'service' => 'stripe',
            'customer_id' => 'cus_ABC123',
        ], $data);

        return $this->sendRequest($data);
    }

    public function deleteCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'deleteCustomer',
            'service' => 'stripe',
            'customer_id' => 'cus_ABC123',
        ], $data);

        return $this->sendRequest($data);
    }

    public function listCustomers(array $data = [])
    {
        $data = array_merge([
            'action' => 'listCustomers',
            'service' => 'stripe',
            'limit' => 5,
        ], $data);

        return $this->sendRequest($data);
    }

    public function searchCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'searchCustomer',
            'service' => 'stripe',
            'query' => 'email:"john.doe@example.com"',
            'limit' => 3,
        ], $data);

        return $this->sendRequest($data);
    }
}
