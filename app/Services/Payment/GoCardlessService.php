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
            'metadata' => [],
            'phone_number' => '',
            'postal_code' => '',
            'region' => '',
            'swedish_identity_number' => '',
        ], $data);

        return $this->sendRequest($data, 'customers');
    }

    public function updateCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'updateCustomer',
            'service' => 'gocardless',

            'customer_id' => '',

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
            'metadata' => [],
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
            'customer_id' => '',
        ], $data);

        return $this->sendRequest($data, 'customers');
    }

    public function deleteCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'deleteCustomer',
            'service' => 'gocardless',
            'customer_id' => '',
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
            'query' => '', // Custom search logic on DB side
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
            'amount' => '',
            'currency' => '',

            // Optional
            'app_fee' => '',
            'charge_date' => '',
            'description' => '',
            'faster_ach' => '',
            'metadata' => [],
            'reference' => '',
            'retry_if_possible' => ''
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    public function updateCharge(array $data = [])
    {
        $data = array_merge([
            'action' => 'updateCharge',
            'service' => 'gocardless',

            'charge_id' => '',
            'metadata' => [], // Required
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    public function retrieveCharge(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveCharge',
            'service' => 'gocardless',
            'charge_id' => '', // Required
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
            'charge_id' => '', // Required
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
            'customer' => '',
            'metadata' => [],
            'status' => '',
            'limit' => '',
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    public function captureCharge(array $data = [])
    {
        $data = array_merge([
            'action' => 'captureCharge',
            'service' => 'gocardless',

            'charge_id' => '', // Required
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    public function createSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'createSetupIntent',
            'service' => 'gocardless',

            // Required
            'session_token' => '',
            'description' => 'Setup Direct Debit Mandate',
            'success_redirect_url' => url('gocardless-success'),

            // Optional
            'metadata' => [],
            'scheme' => '',
            'creditor_id' => '',

            // Prefilled Customer Fields (Optional)
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
            'swedish_identity_number' => '',
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function retrieveSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveSetupIntent',
            'service' => 'gocardless',
            'setup_intent_id' => '', // Required
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function confirmSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'confirmSetupIntent',
            'service' => 'gocardless',
            'setup_intent_id' => '', // Required
            'session_token' => '',   // Required
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
        ], $data);

        throw new \Exception("Updating setup intents is not supported by GoCardless.");
    }

    public function cancelSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelSetupIntent',
            'service' => 'gocardless',
        ], $data);

        throw new \Exception("Cancelling setup intents is not supported by GoCardless.");
    }

    public function verifyMicrodeposits(array $data = [])
    {
        $data = array_merge([
            'action' => 'verifyMicrodeposits',
            'service' => 'gocardless',
        ], $data);

        throw new \Exception("Microdeposit verification is not supported by GoCardless.");
    }

    public function createPaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'createPaymentIntent',
            'service' => 'gocardless',
            'mandate_id' => '',
            'amount' => 0,
            'currency' => '',
            'app_fee' => null,
            'charge_date' => null,
            'description' => null,
            'faster_ach' => null,
            'metadata' => [],
            'reference' => null,
            'retry_if_possible' => null,
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function updatePaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'updatePaymentIntent',
            'service' => 'gocardless',
            'payment_intent_id' => '',
            'metadata' => [],
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function retrievePaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrievePaymentIntent',
            'service' => 'gocardless',
            'payment_intent_id' => '',
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
            'payment_intent_id' => '',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function capturePaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'capturePaymentIntent',
            'service' => 'gocardless',
            'payment_intent_id' => '',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function confirmPaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'confirmPaymentIntent',
            'service' => 'gocardless',
            'payment_intent_id' => '',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function incrementAuthorization(array $data = [])
    {
        $data = array_merge([
            'action' => 'incrementAuthorization',
            'service' => 'gocardless',
            'payment_intent_id' => '',
            'amount' => 0,
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function applyCustomerBalance(array $data = [])
    {
        $data = array_merge([
            'action' => 'applyCustomerBalance',
            'service' => 'gocardless',
            'payment_intent_id' => '',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function searchPaymentIntents(array $data = [])
    {
        $data = array_merge([
            'action' => 'searchPaymentIntents',
            'service' => 'gocardless',
            'query' => '',
            'limit' => 5,
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function verifyPaymentIntentMicrodeposits(array $data = [])
    {
        $data = array_merge([
            'action' => 'verifyPaymentIntentMicrodeposits',
            'service' => 'gocardless',
            'payment_intent_id' => '',
            'amounts' => [],
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function createRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'createRefund',
            'service' => 'gocardless',
            'payment' => '',                      // required
            'amount' => '',                       // required
            'total_amount_confirmation' => '',   // required
            'reference' => null,                 // optional
            'metadata' => [],                    // optional
        ], $data);

        return $this->sendRequest($data, 'refund');
    }

    public function updateRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'updateRefund',
            'service' => 'gocardless',
            'refund_id' => '',       // required
            'metadata' => [],        // required
        ], $data);

        return $this->sendRequest($data, 'refund');
    }

    public function retrieveRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveRefund',
            'service' => 'gocardless',
            'refund_id' => '',       // required
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
            'refund_id' => '',     // required
        ], $data);

        return $this->sendRequest($data, 'refund');
    }

    public function createPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'createPaymentMethod',
            'service' => 'gocardless',
            'links' => [
                'customer_bank_account' => '', // required
            ],
            'metadata' => [],
            'scheme' => null,
            'reference' => null,
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function updatePaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'updatePaymentMethod',
            'service' => 'gocardless',
            'payment_method_id' => '',  // required
            'metadata' => [],
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function retrievePaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrievePaymentMethod',
            'service' => 'gocardless',
            'payment_method_id' => '',  // required
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function listCustomerPaymentMethods(array $data = [])
    {
        $data = array_merge([
            'action' => 'listCustomerPaymentMethods',
            'service' => 'gocardless',
            'customer_id' => '',  // required
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function cancelPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelPaymentMethod',
            'service' => 'gocardless',
            'payment_method_id' => '',  // required
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function reinstatePaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'reinstatePaymentMethod',
            'service' => 'gocardless',
            'payment_method_id' => '',  // required
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

    public function createPaymentLink(array $data = [])
    {
        $data = array_merge([
            'action' => 'createPaymentLink',
            'service' => 'gocardless',
            'name' => '', // required
            'redirect_uri' => url('gocardless-payment-link-success'),
            'mandate_request_description' => '',
            'mandate_request_currency' => '', // required
            'payment_request_description' => '',
            'payment_request_amount' => '', // required
            'payment_request_currency' => '', // required
            'metadata' => [],
        ], $data);

        return $this->sendRequest($data, 'payment-links');
    }

    public function initialisePaymentLink(array $data = [])
    {
        $data = array_merge([
            'action' => 'initialisePaymentLink',
            'service' => 'gocardless',
            'billing_request_flow_id' => '', // required
        ], $data);

        return $this->sendRequest($data, 'payment-links');
    }

    public function updatePaymentLink(array $data = [])
    {
        $data = array_merge([
            'action' => 'updatePaymentLink',
            'service' => 'gocardless',
            'payment_link_id' => '', // required
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
            'payment_link_id' => '', // required
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
        throw new \Exception("Line item retrieval is not supported by GoCardless.");
    }

    public function createPrice(array $data = [])
    {
        throw new \Exception("Price creation is not supported by GoCardless.");
    }

    public function updatePrice(array $data = [])
    {
        throw new \Exception("Price update is not supported by GoCardless.");
    }

    public function retrievePrice(array $data = [])
    {
        throw new \Exception("Price retrieval is not supported by GoCardless.");
    }

    public function listPrices(array $filters = [])
    {
        throw new \Exception("Listing prices is not supported by GoCardless.");
    }

    public function searchPrice(array $filters = [])
    {
        throw new \Exception("Price search is not supported by GoCardless.");
    }
}
