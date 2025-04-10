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

    protected function sendRequest(array $payload, string $endpoint)
    {
        return Http::withToken($this->apiKey)
            ->post("{$this->baseUrl}/payment/{$endpoint}", $payload)  // Different endpoint for customer and charge
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

        return $this->sendRequest($data, 'customer');
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
            'status' => 'active', // Include this for DB sync

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

        return $this->sendRequest($data, 'customer');
    }

    public function retrieveCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveCustomer',
            'service' => 'stripe',
            'customer_id' => 'cus_ABC123',
        ], $data);

        return $this->sendRequest($data, 'customer');
    }

    public function deleteCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'deleteCustomer',
            'service' => 'stripe',
            'customer_id' => 'cus_ABC123',
        ], $data);

        return $this->sendRequest($data, 'customer');
    }

    public function listCustomers(array $data = [])
    {
        $data = array_merge([
            'action' => 'listCustomers',
            'service' => 'stripe',
            'limit' => 5,
        ], $data);

        return $this->sendRequest($data, 'customer');
    }

    public function searchCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'searchCustomer',
            'service' => 'stripe',
            'query' => 'email:"john.doe@example.com"',
            'limit' => 3,
        ], $data);

        return $this->sendRequest($data, 'customer');
    }

    // ==========================
    // CHARGE OPERATIONS
    // ==========================

    public function createCharge(array $data = [])
    {
        $data = array_merge([
            'action' => 'createCharge',
            'service' => 'stripe',
            'amount' => 1500,
            'currency' => 'usd',
            'source' => 'tok_visa', // Example token for payment source
            'description' => 'Test charge',
            'receipt_email' => 'john.doe@example.com',
            'metadata' => ['source' => 'testing'],
            'shipping' => [
                'name' => 'John Doe',
                'phone' => '1234567890',
                'address' => [
                    'line1' => '123 Shipping Ln',
                    'city' => 'ShipCity',
                    'state' => 'SC',
                    'country' => 'US',
                    'postal_code' => '54321',
                ],
            ],
            'payment_method' => 'pm_card_visa', // Payment method
            'tax' => ['vat' => '123456789'], // Tax info
            'balance' => 0,
            'invoice_prefix' => 'JDOE',
            'preferred_locales' => ['en'],
            'promotion_code' => 'PROMO123',
            'tax_exempt' => 'none',
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    public function updateCharge(array $data = [])
    {
        $data = array_merge([
            'action' => 'updateCharge',
            'service' => 'stripe',
            'charge_id' => 'ch_xxxx',  // Charge ID
            'metadata' => ['updated' => true],
            'description' => 'Updated charge description',
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    public function retrieveCharge(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveCharge',
            'service' => 'stripe',
            'charge_id' => 'ch_xxxx',  // Charge ID
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    public function listCharges(array $data = [])
    {
        $data = array_merge([
            'action' => 'listCharges',
            'service' => 'stripe',
            'limit' => 5,  // Default limit, you can customize
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    public function captureCharge(array $data = [])
    {
        $data = array_merge([
            'action' => 'captureCharge',
            'service' => 'stripe',
            'charge_id' => 'ch_xxxx',  // Charge ID
            'amount' => 1500,           // Amount to capture, optional
            'receipt_email' => 'john.doe@example.com',
            'statement_descriptor' => 'Captured charge',
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    // public function cancelCharge(array $data = [])
    // {
    //     $data = array_merge([
    //         'action' => 'cancelCharge',
    //         'service' => 'stripe',
    //         'charge_id' => 'ch_xxxx',  // Charge ID
    //     ], $data);

    //     return $this->sendRequest($data, 'charges');
    // }

    public function searchCharges(array $data = [])
    {
        $data = array_merge([
            'action' => 'searchCharges',
            'service' => 'stripe',
            'query' => 'amount:500',
            'limit' => 5,  // Default limit for search
        ], $data);

        return $this->sendRequest($data, 'charges');
    }

    // ==========================
    // SETUP INTENT OPERATIONS
    // ==========================

    public function createSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'createSetupIntent',
            'service' => 'stripe',
            'payment_method_types' => ['card'],
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function retrieveSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveSetupIntent',
            'service' => 'stripe',
            'setup_intent_id' => 'seti_ABC123',
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function updateSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'updateSetupIntent',
            'service' => 'stripe',
            'setup_intent_id' => 'seti_ABC123',
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function cancelSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelSetupIntent',
            'service' => 'stripe',
            'setup_intent_id' => 'seti_ABC123',
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    // ==========================
    // CONFIRM AND VERIFY MICRODEPOSITS OPERATIONS
    // ==========================

    public function confirmSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'confirmSetupIntent',
            'service' => 'stripe',
            'setup_intent_id' => 'seti_ABC123',
            'payment_method' => 'pm_card_visa',  // example
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function verifyMicrodeposits(array $data = [])
    {
        $data = array_merge([
            'action' => 'verifyMicrodeposits',
            'service' => 'stripe',
            'setup_intent_id' => 'seti_ABC123',
            'amounts' => [0.1, 0.2],
            'descriptor_code' => '1234',
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function listSetupIntents(array $data = [])
    {
        $data = array_merge([
            'action' => 'listSetupIntents',
            'service' => 'stripe',
            'limit' => 5,
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    // ==========================
    // PAYMENT INTENT OPERATIONS
    // ==========================

    public function createPaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'createPaymentIntent',
            'service' => 'stripe',
            'amount' => 1500,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
            'customer' => null,
            'description' => 'Test payment intent',
            'metadata' => ['source' => 'testing'],
            'receipt_email' => 'john.doe@example.com',
            'shipping' => [
                'name' => 'John Doe',
                'phone' => '1234567890',
                'address' => [
                    'line1' => '123 Shipping Ln',
                    'city' => 'ShipCity',
                    'state' => 'SC',
                    'country' => 'US',
                    'postal_code' => '54321',
                ],
            ],
            'statement_descriptor' => 'TestCharge',
            'transfer_data' => null,
            'capture_method' => 'automatic',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function updatePaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'updatePaymentIntent',
            'service' => 'stripe',
            'payment_intent_id' => 'pi_ABC123',
            'amount' => 1600,
            'description' => 'Updated payment intent description',
            'metadata' => ['updated' => true],
            'shipping' => [
                'name' => 'John Updated',
                'phone' => '0987654321',
                'address' => [
                    'line1' => '456 New Shipping Ln',
                    'city' => 'NewShipCity',
                    'state' => 'NS',
                    'country' => 'US',
                    'postal_code' => '98765',
                ],
            ],
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function retrievePaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrievePaymentIntent',
            'service' => 'stripe',
            'payment_intent_id' => 'pi_ABC123',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function cancelPaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelPaymentIntent',
            'service' => 'stripe',
            'payment_intent_id' => 'pi_ABC123',
            'cancellation_reason' => 'requested_by_customer',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function capturePaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'capturePaymentIntent',
            'service' => 'stripe',
            'payment_intent_id' => 'pi_ABC123',
            'amount_to_capture' => 1500,  // Optional: specify the amount to capture
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function confirmPaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'confirmPaymentIntent',
            'service' => 'stripe',
            'payment_intent_id' => 'pi_ABC123',
            'payment_method' => 'pm_card_visa', // Example of payment method
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function searchPaymentIntents(array $data = [])
    {
        $data = array_merge([
            'action' => 'searchPaymentIntents',
            'service' => 'stripe',
            'query' => 'amount:500',  // Example search query
            'limit' => 5,  // Default limit for search
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function verifyPaymentIntentMicrodeposits(array $data = [])
    {
        $data = array_merge([
            'action' => 'verifyPaymentIntentMicrodeposits',
            'service' => 'stripe',
            'payment_intent_id' => 'pi_ABC123',
            'amounts' => [0.1, 0.2], // Example of microdeposit amounts
            'descriptor_code' => '1234', // Optional: descriptor code for microdeposit verification
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    // ==========================
    // INCREMENT AUTHORIZATION OPERATIONS
    // ==========================

    public function incrementAuthorization(array $data = [])
    {
        $data = array_merge([
            'action' => 'incrementAuthorization',
            'service' => 'stripe',
            'payment_intent_id' => 'pi_ABC123',
            'amount' => 1000,  // The amount to increase the authorization by
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    // ==========================
    // APPLY CUSTOMER BALANCE OPERATIONS
    // ==========================

    public function applyCustomerBalance(array $data = [])
    {
        $data = array_merge([
            'action' => 'applyCustomerBalance',
            'service' => 'stripe',
            'payment_intent_id' => 'pi_ABC123',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    // ==========================
    // LIST PAYMENT INTENTS OPERATIONS
    // ==========================

    public function listPaymentIntents(array $data = [])
    {
        $data = array_merge([
            'action' => 'listPaymentIntents',
            'service' => 'stripe',
            'limit' => 5,
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    // ==========================
    // REFUND OPERATIONS
    // ==========================

    public function createRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'createRefund',
            'service' => 'stripe',
            'charge' => 'ch_1IwGVF2eZvKYlo2C1B09sYsY', // Example charge ID
            'payment_intent' => null,
            'amount' => 1000,  // Optional: Amount to refund
            'reason' => 'requested_by_customer',
            'metadata' => null,
            'refund_application_fee' => false,
            'reverse_transfer' => false,
        ], $data);

        return $this->sendRequest($data, 'refunds');
    }

    public function updateRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'updateRefund',
            'service' => 'stripe',
            'refund_id' => 're_ABC123', // Example refund ID
            'metadata' => ['updated' => true], // Update metadata
        ], $data);

        return $this->sendRequest($data, 'refunds');
    }

    public function retrieveRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveRefund',
            'service' => 'stripe',
            'refund_id' => 're_ABC123',  // Refund ID
        ], $data);

        return $this->sendRequest($data, 'refunds');
    }

    public function listRefunds(array $data = [])
    {
        $data = array_merge([
            'action' => 'listRefunds',
            'service' => 'stripe',
            'limit' => 5,  // Default limit
            'charge' => null, // Optional: pass charge ID to filter
            'payment_intent' => null, // Optional: pass payment intent ID to filter
        ], $data);

        return $this->sendRequest($data, 'refunds');
    }

    public function cancelRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelRefund',
            'service' => 'stripe',
            'refund_id' => 're_ABC123',  // Refund ID
        ], $data);

        return $this->sendRequest($data, 'refunds');
    }

    // ==========================
    // PAYMENT METHOD OPERATIONS
    // ==========================

    public function createPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'createPaymentMethod',
            'service' => 'stripe',
            'type' => 'card', // Example type, you can change this dynamically
            'billing_details' => [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'address' => [
                    'line1' => '123 Test St',
                    'line2' => 'Suite 100',
                    'city' => 'Testville',
                    'state' => 'TS',
                    'country' => 'US',
                    'postal_code' => '12345',
                ],
            ],
            'metadata' => null,
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => 12,
                'exp_year' => 2025,
                'cvc' => '123',
            ],
            'acss_debit' => null, // Add additional fields based on type
            'affirm' => null,
            'afterpay_clearpay' => null,
            'alipay' => null,
            'alma' => null,
            'amazon_pay' => null,
            'au_becs_debit' => null,
            'bacs_debit' => null,
            'bancontact' => null,
            'blik' => null,
            'boleto' => null,
            'cashapp' => null,
            'customer_balance' => null,
            'eps' => null,
            'fpx' => null,
            'giropay' => null,
            'grabpay' => null,
            'ideal' => null,
            'interac_present' => null,
            'kakao_pay' => null,
            'klarna' => null,
            'konbini' => null,
            'kr_card' => null,
            'link' => null,
            'mobilepay' => null,
            'multibanco' => null,
            'naver_pay' => null,
            'nz_bank_account' => null,
            'oxxo' => null,
            'p24' => null,
            'pay_by_bank' => null,
            'payco' => null,
            'paynow' => null,
            'paypal' => null,
            'pix' => null,
            'promptpay' => null,
            'radar_options' => null,
            'revolut_pay' => null,
            'samsung_pay' => null,
            'sepa_debit' => null,
            'sofort' => null,
            'swish' => null,
            'twint' => null,
            'us_bank_account' => null,
            'wechat_pay' => null,
            'zip' => null,
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function updatePaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'updatePaymentMethod',
            'service' => 'stripe',
            'payment_method_id' => 'pm_ABC123', // Example payment method ID
            'billing_details' => [
                'name' => 'John Updated',
                'email' => 'john.updated@example.com',
            ],
            'metadata' => ['updated' => true],
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function retrievePaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrievePaymentMethod',
            'service' => 'stripe',
            'payment_method_id' => 'pm_ABC123',  // Payment Method ID
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function listPaymentMethods(array $data = [])
    {
        $data = array_merge([
            'action' => 'listPaymentMethods',
            'service' => 'stripe',
            'limit' => 5,  // Default limit, can customize
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function attachPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'attachPaymentMethod',
            'service' => 'stripe',
            'payment_method_id' => 'pm_ABC123',
            'customer_id' => 'cus_ABC123',
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function detachPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'detachPaymentMethod',
            'service' => 'stripe',
            'payment_method_id' => 'pm_ABC123',
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function reinstatePaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'reinstatePaymentMethod',
            'service' => 'stripe',
            'payment_method_id' => 'pm_ABC123',
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function retrieveCustomerPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveCustomerPaymentMethod',
            'service' => 'stripe',
            'customer_id' => 'cus_ABC123',  // Example customer ID
            'payment_method_id' => 'pm_ABC123',  // Example payment method ID
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function listCustomerPaymentMethods(array $data = [])
    {
        $data = array_merge([
            'action' => 'listCustomerPaymentMethods',
            'service' => 'stripe',
            'customer_id' => 'cus_ABC123',  // Example customer ID
            'limit' => 5,  // Default limit, you can customize
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    // ==========================
    // PAYMENT LINK OPERATIONS
    // ==========================

    public function createPaymentLink(array $data = [])
    {
        $data = array_merge([
            'action' => 'createPaymentLink',
            'service' => 'stripe',
            'line_items' => [], // Example empty line items, adjust as needed
            'currency' => 'usd',
            'payment_method_types' => ['card'],
            'customer_email' => 'john.doe@example.com',
            'allow_promotion_codes' => true,
            'payment_intent_data' => null,
            'after_completion' => null,
            'shipping_address_collection' => null,
            'metadata' => [],
            'custom_fields' => [],
        ], $data);

        return $this->sendRequest($data, 'payment-links');
    }

    public function updatePaymentLink(array $data = [])
    {
        $data = array_merge([
            'action' => 'updatePaymentLink',
            'service' => 'stripe',
            'payment_link_id' => 'link_ABC123',  // Example payment link ID
            'line_items' => [],
            'currency' => 'usd',
            'payment_method_types' => ['card'],
            'customer_email' => 'john.doe@example.com',
            'allow_promotion_codes' => true,
            'payment_intent_data' => null,
            'after_completion' => null,
            'shipping_address_collection' => null,
            'metadata' => [],
            'custom_fields' => [],
        ], $data);

        return $this->sendRequest($data, 'payment-links');
    }

    public function retrievePaymentLink(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrievePaymentLink',
            'service' => 'stripe',
            'payment_link_id' => 'link_ABC123', // Example payment link ID
        ], $data);

        return $this->sendRequest($data, 'payment-links');
    }

    public function listPaymentLinks(array $filters = [])
    {
        $data = array_merge([
            'action' => 'listPaymentLinks',
            'service' => 'stripe',
            'limit' => 5,  // Default limit
        ], $filters);

        return $this->sendRequest($data, 'payment-links');
    }

    public function retrieveLineItems(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveLineItems',
            'service' => 'stripe',
            'payment_link_id' => 'link_ABC123',  // Example payment link ID
        ], $data);

        return $this->sendRequest($data, 'payment-links');
    }

    // ==========================
    // PRICE OPERATIONS
    // ==========================

    public function createPrice(array $data = [])
    {
        $data = array_merge([
            'action' => 'createPrice',
            'service' => 'stripe',
            'currency' => 'usd', // Currency for price
            'active' => true,
            'metadata' => null,
            'nickname' => 'Example Price',
            'product' => 'prod_ABC123', // Example product ID
            'recurring' => null, // If recurring price, provide the recurring options
            'tax_behavior' => 'exclusive', // Example tax behavior
            'unit_amount' => 1000, // Example price in cents
            'billing_scheme' => 'per_unit', // Per unit pricing scheme
            'currency_options' => null,
            'custom_unit_amount' => null,
            'lookup_key' => null,
            'product_data' => null,
            'tiers' => null,
            'tiers_mode' => null,
            'transfer_lookup_key' => null,
            'transform_quantity' => null,
            'unit_amount_decimal' => null,
        ], $data);

        return $this->sendRequest($data, 'prices');
    }

    public function updatePrice(array $data = [])
    {
        $data = array_merge([
            'action' => 'updatePrice',
            'service' => 'stripe',
            'price_id' => 'price_ABC123', // Example price ID
            'active' => true,
            'metadata' => null,
            'nickname' => 'Updated Price',
            'tax_behavior' => 'inclusive',
            'currency_options' => null,
            'lookup_key' => null,
            'transfer_lookup_key' => null,
        ], $data);

        return $this->sendRequest($data, 'prices');
    }

    public function retrievePrice(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrievePrice',
            'service' => 'stripe',
            'price_id' => 'price_ABC123',  // Price ID
        ], $data);

        return $this->sendRequest($data, 'prices');
    }

    public function listPrices(array $filters = [])
    {
        $data = array_merge([
            'action' => 'listPrices',
            'service' => 'stripe',
            'limit' => 5, // Default limit
        ], $filters);

        return $this->sendRequest($data, 'prices');
    }

    public function searchPrice(array $data = [])
    {
        $data = array_merge([
            'action' => 'searchPrice',
            'service' => 'stripe',
            'query' => 'product_id:"prod_ABC123"', // Example search query
            'limit' => 5, // Default limit for search
        ], $data);

        return $this->sendRequest($data, 'prices');
    }
}
