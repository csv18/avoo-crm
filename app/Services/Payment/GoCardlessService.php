<?php

namespace App\Services\Payment;

use Illuminate\Support\Facades\Http;

class GoCardlessService
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
            ->post("{$this->baseUrl}/payment/{$endpoint}", $payload)
            ->throw()
            ->json();
    }

    // ==========================
    // CUSTOMER OPERATIONS
    // ==========================

    public function createCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'createCustomer',
            'service' => 'gocardless',
            'monolith_customer_id' => 'cus_ty6654sdf',
            'address_line1' => '',
            'address_line2' => '',
            'address_line3' => '',
            'city' => '',
            'company_name' => '',
            'country_code' => '',
            'danish_identity_number' => '',
            'email' => 'vignesh@gmail.com',
            'family_name' => '',
            'given_name' => '',
            'language' => '',
            'metadata' => '',
            'phone_number' => '',
            'postal_code' => '',
            'region' => '',
            'swedish_identity_number' => '',
            'company_name' => 'Avoo',
        ], $data);

        return $this->sendRequest($data, 'customers');
    }

    public function updateCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'updateCustomer',
            'service' => 'gocardless',

            'customer_id' => 'CU001FRKGXFTVJ',
            'monolith_customer_id' => 'cus_ty6654sdf',
            'address_line1' => '',
            'address_line2' => '',
            'address_line3' => '',
            'city' => '',
            'company_name' => '',
            'country_code' => '',
            'danish_identity_number' => '',
            'email' => '',
            'family_name' => '',
            'given_name' => '',
            'language' => '',
            'metadata' => '',
            'phone_number' => '',
            'postal_code' => '',
            'region' => '',
            'swedish_identity_number' => '',
        ], $data);

        return $this->sendRequest($data, 'customers');
    }

    public function retrieveCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveCustomer',
            'service' => 'gocardless',
            'customer_id' => 'CU001FRKGXFTVJ',
        ], $data);

        return $this->sendRequest($data, 'customers');
    }

    public function deleteCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'deleteCustomer',
            'service' => 'gocardless',
            'customer_id' => 'CU001FRKGXFTVJ',
        ], $data);

        return $this->sendRequest($data, 'customers');
    }

    public function listCustomers(array $data = [])
    {
        $data = array_merge([
            'action' => 'listCustomers',
            'service' => 'gocardless',
            'after' => '',
            'before' => '',
            'created_at[gt]' => '',
            'created_at[gte]' => '',
            'created_at[lt]' => '',
            'created_at[lte]' => '',
            'currency' => '',
            'limit' => '',
            'sort_direction' => '',
            'sort_field' => '',
            'email' => '',
        ], $data);

        return $this->sendRequest($data, 'customers');
    }

    public function searchCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'searchCustomer',
            'service' => 'gocardless',
            'query' => 'Avoo', // Custom search logic on DB side
        ], $data);

        return $this->sendRequest($data, 'customers');
    }

    public function createCharge(array $data = [])
    {
        $data = array_merge([
            'action' => 'createCharge',
            'service' => 'gocardless',

            // Required
            'mandate_id' => '',
            'amount' => '100',
            'currency' => 'USD',

            // Optional
            'app_fee' => '',
            'charge_date' => '',
            'description' => '',
            'faster_ach' => '',
            'metadata' => [],
            'reference' => '',
            'retry_if_possible' => '',
            'source' => 'card',
            'mandate_id' => 'MD123'
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    public function updateCharge(array $data = [])
    {
        $data = array_merge([
            'action' => 'updateCharge',
            'service' => 'gocardless',
            'amount' => 10000,
            'currency' => 'INR',
            'metadata' => ['order_id' => '12345'],
            'retry_if_possible' => '',
            'charge_id' => 'PM123',
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    public function retrieveCharge(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveCharge',
            'service' => 'gocardless',
            'charge_id' => 'ch_3R6r2dS0vtd2x8w91TPCrrct', // Required
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    public function listCharges(array $data = [])
    {
        $data = array_merge([
            'action' => 'listCharges',
            'service' => 'gocardless',

            // Optional filters
            'after' => '',
            'before' => '',
            'charge_date[gt]' => '',
            'charge_date[gte]' => '',
            'charge_date[lt]' => '',
            'charge_date[lte]' => '',
            'created_at[gt]' => '',
            'created_at[gte]' => '',
            'created_at[lt]' => '',
            'created_at[lte]' => '',
            'creditor' => '',
            'currency' => '',
            'customer' => '',
            'limit' => '',
            'mandate' => '',
            'subscription' => '',
            'sort_direction' => '',
            'sort_field' => '',
            'status' => '',
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    public function cancelCharge(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelCharge',
            'service' => 'gocardless',
            'charge_id' => 'ch_3R6r2dS0vtd2x8w91TPCrrct', // Required
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    public function retryCharge(array $data = [])
    {
        $data = array_merge([
            'action' => 'retryCharge',
            'service' => 'gocardless',

            // Required
            'charge_id' => '',

            // Optional
            'charge_date' => '',
            'metadata' => [],
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    public function searchCharges(array $data = [])
    {
        $data = array_merge([
            'action' => 'searchCharges',
            'service' => 'gocardless',

            // Typical filters for searching
            'customer' => 'ch_3R6r2dS0vtd2x8w91TPCrrct',
            'metadata' => [],
            'status' => '',
            'limit' => '',
            'query' => 'Avoo',
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    public function captureCharge(array $data = [])
    {
        $data = array_merge([
            'action' => 'captureCharge',
            'service' => 'gocardless',

            'charge_id' => 'ch_3R6r2dS0vtd2x8w91TPCrrct', // Required
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    public function createSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'createSetupIntent',
            'service' => 'gocardless',

            // Required
            'session_token' => '1212',
            'description' => 'Setup Direct Debit Mandate',
            'success_redirect_url' => url('gocardless-success'),

            // Optional
            'metadata' => [],
            'scheme' => '',
            'creditor_id' => '',

            // Prefilled Customer Fields (Optional)
            'prefilled_customer' => [
                'address_line1' => '',
                'address_line2' => '',
                'address_line3' => '',
                'city' => '',
                'company_name' => '',
                'country_code' => '',
                'danish_identity_number' => '',
                'email' => '',
                'family_name' => '',
                'given_name' => '',
                'language' => '',
                'phone_number' => '',
                'postal_code' => '',
                'region' => '',
                'swedish_identity_number' => ''
            ],

            // Optional fields
            'scheme' => '',
            'links' => [
                'creditor' => ''
            ]
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function retrieveSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveSetupIntent',
            'service' => 'gocardless',
            'setup_intent_id' => 'RE00073Z8MQ6F0MM1GY8TFW3VGSRC63B', // Required
            'client_secret' => ''
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function confirmSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'confirmSetupIntent',
            'service' => 'gocardless',
            'setup_intent_id' => 'RE00073Z8MQ6F0MM1GY8TFW3VGSRC63B', // Required
            'session_token' => '1212',   // Required
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function listSetupIntents(array $data = [])
    {
        $data = array_merge([
            'action' => 'listSetupIntents',
            'service' => 'gocardless',
            'limit' => 5,
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function updateSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'updateSetupIntent',
            'service' => 'gocardless',
            'setup_intent_id' => 'seti_1R7D1ZS0vtd2x8w9HUbloAU7', // Required
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function cancelSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelSetupIntent',
            'service' => 'gocardless',
            'setup_intent_id' => 'seti_1R7D1ZS0vtd2x8w9HUbloAU7', // Required
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function verifyMicrodeposits(array $data = [])
    {
        $data = array_merge([
            'action' => 'verifyMicrodeposits',
            'service' => 'gocardless',
            'setup_intent_id' => 'seti_1R7D1ZS0vtd2x8w9HUbloAU7', // Required
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function createPaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'createPaymentMethod',
            'service' => 'gocardless',

            // New fields
            'authorisation_source' => '',
            'metadata' => [],
            'payer_ip_address' => '',
            'reference' => null,
            'scheme' => '',
            'links' => [
                'creditor' => '',
                'customer_bank_account' => ''
            ],

            // Existing fields
            'action' => 'createPaymentIntent',  // Keep original action if needed
            'service' => 'gocardless',  // Keep original service if needed
            'mandate_id' => '',
            'amount' => 1000,
            'currency' => 'USD',
            'app_fee' => null,
            'charge_date' => null,
            'description' => null,
            'faster_ach' => null,
            'retry_if_possible' => null,
            'mandate_id' => 'MD123',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function updatePaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'updatePaymentIntent',
            'service' => 'gocardless',

            // New fields
            'payment_intent_id' => 'pi_3R7Y7wS0vtd2x8w91jhEyrQu',
            'amount' => null,  // Default value (you can set it dynamically)
            'currency' => '',  // Default value (you can set it dynamically)
            'metadata' => ['order_id' => '12345'],
            'retry_if_possible' => null, // Default value (can be updated as needed)
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function retrievePaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrievePaymentIntent',
            'service' => 'gocardless',
            'payment_intent_id' => 'pi_3R7Y7wS0vtd2x8w91jhEyrQu',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function listPaymentIntents(array $data = [])
    {
        $data = array_merge([
            'action' => 'listPaymentIntents',
            'service' => 'gocardless',
            'limit' => 10,
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function cancelPaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelPaymentIntent',
            'service' => 'gocardless',
            'payment_intent_id' => 'pi_3R7Y7wS0vtd2x8w91jhEyrQu',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function capturePaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'capturePaymentIntent',
            'service' => 'gocardless',
            'payment_intent_id' => 'pi_3R7Y7wS0vtd2x8w91jhEyrQu',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function confirmPaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'confirmPaymentIntent',
            'service' => 'gocardless',
            'payment_intent_id' => 'pi_3R7Y7wS0vtd2x8w91jhEyrQu',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function incrementAuthorization(array $data = [])
    {
        $data = array_merge([
            'action' => 'incrementAuthorization',
            'service' => 'gocardless',
            'payment_intent_id' => 'pi_3R7Y7wS0vtd2x8w91jhEyrQu',
            'amount' => 10,
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function applyCustomerBalance(array $data = [])
    {
        $data = array_merge([
            'action' => 'applyCustomerBalance',
            'service' => 'gocardless',
            'payment_intent_id' => 'pi_3R7Y7wS0vtd2x8w91jhEyrQu',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function searchPaymentIntents(array $data = [])
    {
        $data = array_merge([
            'action' => 'searchPaymentIntent',
            'service' => 'gocardless',
            'query' => 'Avoo',
            'limit' => 5,
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function verifyPaymentIntentMicrodeposits(array $data = [])
    {
        $data = array_merge([
            'action' => 'verifyMicrodeposits',
            'service' => 'gocardless',
            'payment_intent_id' => 'pi_3R7Y7wS0vtd2x8w91jhEyrQu',
            'amounts' => [12, 14],
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function createRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'createRefund',
            'service' => 'gocardless',

            // Required fields
            'payment' => 'card',                      // required
            'amount' => '10',                       // required
            'total_amount_confirmation' => '10',    // required
            'charge' => 'ch_3R6r2dS0vtd2x8w91TPCrrct',                      // required
            // Optional fields
            'reference' => null,                  // optional
            'metadata' => [],                     // optional

            // New fields (links)
            'links' => [
                'mandate' => '',
                'payment' => ''
            ],
        ], $data);

        return $this->sendRequest($data, 'refund');
    }

    public function updateRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'updateRefund',
            'service' => 'gocardless',
            'refund_id' => 'rd_3hjb243',       // required
            'metadata' => ['order_id' => '23'],        // required
        ], $data);

        return $this->sendRequest($data, 'refund');
    }

    public function retrieveRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveRefund',
            'service' => 'gocardless',
            'refund_id' => 'rd_3hjb243',       // required
        ], $data);

        return $this->sendRequest($data, 'refund');
    }

    public function listRefunds(array $data = [])
    {
        $data = array_merge([
            'action' => 'listRefunds',
            'service' => 'gocardless',
            'limit' => 10,
            'after' => null,
            'before' => null,
            'created_at[gt]' => null,
            'created_at[gte]' => null,
            'created_at[lt]' => null,
            'created_at[lte]' => null,
            'mandate' => null,
            'payment' => null,
            'refund_type' => null,
        ], $data);

        return $this->sendRequest($data, 'refund');
    }

    public function cancelRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelRefund',
            'service' => 'gocardless',
            'refund_id' => 'rd_3hjb243',     // required
        ], $data);

        return $this->sendRequest($data, 'refund');
    }

    public function createPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'createPaymentMethod',
            'service' => 'gocardless',

            // Required fields
            'links' => [
                'customer_bank_account' => 'SBI',  // required and set to 'SBI'
            ],

            // Optional fields
            'metadata' => [],
            'scheme' => null,
            'reference' => null,

            // New fields
            'authorisation_source' => '',
            'payer_ip_address' => '',
            'billing_details' => [
                'name' => '12'  // Set billing name to '12'
            ],

            // Additional links
            'links' => array_merge([
                'creditor' => '',
                'customer_bank_account' => 'SBI'  // Add 'customer_bank_account' inside the links
            ], [
                // Other links can be added here if needed
            ])

        ], $data);


        return $this->sendRequest($data, 'payment-methods');
    }

    public function updatePaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'updatePaymentMethod',
            'service' => 'gocardless',
            'payment_method_id' => 'pm_1RBwHvS0vtd2x8w9O0tcZzYe',  // required
            'metadata' => [],
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function retrievePaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrievePaymentMethod',
            'service' => 'gocardless',
            'payment_method_id' => 'pm_1RBwHvS0vtd2x8w9O0tcZzYe',  // required
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function listCustomerPaymentMethods(array $data = [])
    {
        $data = array_merge([
            'action' => 'listCustomerPaymentMethods',
            'service' => 'gocardless',
            'customer_id' => 'cus_423bh45',  // required
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function cancelPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelPaymentMethod',
            'service' => 'gocardless',
            'payment_method_id' => 'pm_1RBwHvS0vtd2x8w9O0tcZzYe',  // required
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function reinstatePaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'reinstatePaymentMethod',
            'service' => 'gocardless',
            'payment_method_id' => 'pm_1RBwHvS0vtd2x8w9O0tcZzYe',  // required
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function retrieveCustomerPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveCustomerPaymentMethod',
            'service' => 'gocardless',
            'customer_id' => 'cus_S8Mu3YNTxaQ9J8',  // Example customer ID
            'payment_method_id' => 'pm_1RE5ksS0vtd2x8w9ZvirOBXw',  // Example payment method ID
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function listPaymentMethods(array $data = [])
    {
        $data = array_merge([
            'action' => 'listPaymentMethods',
            'service' => 'gocardless',
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function attachPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'attachPaymentMethod',
            'service' => 'gocardless',
            'payment_method_id' => 'pm_1RE5ksS0vtd2x8w9ZvirOBXw',
            'customer_id' => 'cus_S8Mu3YNTxaQ9J8',
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function detachPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'detachPaymentMethod',
            'service' => 'gocardless',
            'payment_method_id' => 'pm_1RE5ksS0vtd2x8w9ZvirOBXw',
            'payment_method' => 'card',
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function createPaymentLink(array $data = [])
    {
        $data = array_merge([
            'action' => 'createPaymentLink',
            'service' => 'gocardless',

            // Required fields
            'name' => '',
            'redirect_uri' => url('gocardless-payment-link-success'),
            'mandate_request_description' => '',
            'mandate_request_currency' => '', // required
            'payment_request_description' => '',
            'payment_request_amount' => '', // required
            'payment_request_currency' => '', // required

            // Optional fields
            'metadata' => [],

            // New fields
            'auto_fulfil' => null,
            'customer_details_captured' => null,
            'exit_uri' => null,
            'language' => null,
            'lock_bank_account' => null,
            'lock_currency' => null,
            'lock_customer_details' => null,

            // Prefilled customer fields
            'prefilled_bank_account' => [
                'account_type' => null
            ],
            'prefilled_customer' => [
                'address_line1' => null,
                'address_line2' => null,
                'address_line3' => null,
                'city' => null,
                'company_name' => null,
                'country_code' => null,
                'danish_identity_number' => null,
                'email' => null,
                'family_name' => null,
                'given_name' => null,
                'postal_code' => null,
                'region' => null,
                'swedish_identity_number' => null
            ],
            'currency' => 'USD',
            'name' => 'Avoo',
            'amount' => '1000',
            'payment_description' => 'Avoo',
            // Links
            'links' => [
                'billing_request' => null
            ]
        ], $data);


        return $this->sendRequest($data, 'payment-links');
    }

    public function initialisePaymentLink(array $data = [])
    {
        $data = array_merge([
            'action' => 'initialisePaymentLink',
            'service' => 'gocardless',
            'billing_request_flow_id' => 'brf_435nj', // required
            'billing_template_id' => 'brf_435nj', // required
        ], $data);

        return $this->sendRequest($data, 'payment-links');
    }

    public function updatePaymentLink(array $data = [])
    {
        $data = array_merge([
            'action' => 'updatePaymentLink',
            'service' => 'gocardless',
            'payment_link_id' => 'brf_435nj', // required
            'name' => null,
            'redirect_uri' => url('gocardless-update-payment-link-success'),
            'mandate_request_description' => null,
            'mandate_request_currency' => null,
            'payment_request_description' => null,
            'payment_request_amount' => null,
            'payment_request_currency' => null,
            'metadata' => null
        ], $data);

        return $this->sendRequest($data, 'payment-links');
    }

    public function retrievePaymentLink(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrievePaymentLink',
            'service' => 'gocardless',
            'payment_link_id' => 'brf_435nj', // required
        ], $data);

        return $this->sendRequest($data, 'payment-links');
    }

    public function listPaymentLinks(array $data = [])
    {
        $data = array_merge([
            'action' => 'listPaymentLinks',
            'service' => 'gocardless',
            'limit' => 5,  // Default limit, can customize
        ], $data);

        return $this->sendRequest($data, 'payment-links');
    }

    public function retrieveLineItems(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveLineItems',
            'service' => 'gocardless',
            'payment_link_id' => 'brf_435nj', // required
        ], $data);
        return $this->sendRequest($data, 'payment-links');
    }

    public function createPrice(array $data = [])
    {
        return $this->sendRequest($data, 'prices');
    }

    public function updatePrice(array $data = [])
    {
        return $this->sendRequest($data, 'prices');
    }

    public function retrievePrice(array $data = [])
    {
        return $this->sendRequest($data, 'prices');
    }

    public function listPrices(array $filters = [])
    {
        return $this->sendRequest($data, 'prices');
    }

    public function searchPrice(array $filters = [])
    {
        return $this->sendRequest($data, 'prices');
    }
}
