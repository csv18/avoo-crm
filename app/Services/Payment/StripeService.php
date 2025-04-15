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
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
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
            'name' => 'Vignesh',
            'email' => 'vigneshcs18172@gmail.com',
            'phone' => '6282053205',
            'monolith_customer_id' => 'cus_ty6654sdf',
            'service' => 'stripe',
            'type' => 1,

            'address' => [], // no address details provided
            'description' => '',
            'metadata' => [],
            'payment_method' => '',
            'shipping' => [],
            'tax' => [],
            'balance' => '',
            'cash_balance' => '',
            'invoice_prefix' => '',
            'invoice_settings' => [],
            'next_invoice_sequence' => '',
            'preferred_locales' => [],
            'source' => '',
            'tax_exempt' => '',
            'tax_id_data' => [],
            'test_clock' => '',
        ], $data);

        return $this->sendRequest($data, 'customers');
    }

    public function updateCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'updateCustomer',
            'service' => 'stripe',
            'customer_id' => 'cus_S8JVcWbwI5ZjYa', // updated from your input
            'monolith_customer_id' => 'cus_ty6654sdf', // updated from your input
            'name' => 'Vignesh18', // updated
            'email' => 'vigneshcs18172@gmail.com', // updated
            'phone' => '35435', // updated
            'description' => '', // cleared
            'metadata' => [], // cleared
            'status' => 'active', // keeping from original for DB sync

            'address' => [], // cleared
            'shipping' => [], // cleared
            'tax' => [], // cleared
            'balance' => '', // cleared
            'cash_balance' => '', // new field from your input
            'default_source' => '', // new field from your input
            'invoice_prefix' => '', // cleared
            'invoice_settings' => [], // new field from your input
            'next_invoice_sequence' => '', // new field from your input
            'preferred_locales' => [], // cleared
            'source' => '', // new field from your input
            'tax_exempt' => '', // cleared
        ], $data);

        return $this->sendRequest($data, 'customers');
    }

    public function retrieveCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveCustomer',
            'service' => 'stripe',
            'customer_id' => 'cus_S8JVcWbwI5ZjYa',
        ], $data);

        return $this->sendRequest($data, 'customers');
    }

    public function deleteCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'deleteCustomer',
            'service' => 'stripe',
            'customer_id' => 'cus_S8JVcWbwI5ZjYa',
        ], $data);

        return $this->sendRequest($data, 'customers');
    }

    public function listCustomers(array $data = [])
    {
        $data = array_merge([
            'action' => 'listCustomers',
            'service' => 'stripe',
            'limit' => 5,
        ], $data);

        return $this->sendRequest($data, 'customers');
    }

    public function searchCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'searchCustomer',
            'service' => 'stripe',
            'query' => 'name:"vignesh"',
            'limit' => 3,
        ], $data);

        return $this->sendRequest($data, 'customers');
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
            'charge_id' => 'ch_3RE3PRS0vtd2x8w91LCHcTof',  // Charge ID
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
            'charge_id' => 'ch_3RE3PRS0vtd2x8w91LCHcTof',  // Charge ID
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
            'charge_id' => 'ch_3RE3PRS0vtd2x8w91LCHcTof',  // Charge ID
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
            'query' => 'metadata["order_id"]:"ORD12345"',
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

            'automatic_payment_methods' => '',
            // 'confirm' => 1, // Uncomment if needed
            'customer' => '',
            'description' => '',
            'metadata' => [],
            'payment_method' => '',
            'usage' => '',
            'attach_to_self' => '',
            'confirmation_token' => '',
            'flow_directions' => [],
            'mandate_data' => [],
            'on_behalf_of' => '',
            'payment_method_configuration' => '',
            'payment_method_data' => [],
            'payment_method_options' => [],
            'payment_method_types' => ['card'], // already present
            'return_url' => '',
            'single_use' => '',
            'use_stripe_sdk' => '',
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function retrieveSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveSetupIntent',
            'service' => 'stripe',
            'setup_intent_id' => 'seti_1RE3sqS0vtd2x8w9qt4ESYDn',
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function updateSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'updateSetupIntent',
            'service' => 'stripe',
            'setup_intent_id' => 'seti_1R7D1ZS0vtd2x8w9HUbloAU7', // updated ID from your input

            'customer' => '',
            'description' => '',
            'metadata' => [],
            'payment_method' => '',
            'attach_to_self' => '',
            'flow_directions' => [],
            'payment_method_configuration' => '',
            'payment_method_data' => [],
            'payment_method_options' => [],
            'payment_method_types' => [],
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function cancelSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelSetupIntent',
            'service' => 'stripe',
            'setup_intent_id' => 'seti_1RE3sqS0vtd2x8w9qt4ESYDn',
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
            'setup_intent_id' => 'seti_1RE4QSS0vtd2x8w9HEJwqwTd', // updated from input
            'payment_method' => 'pm_card_visa', // updated from input

            'confirmation_token' => '',
            'mandate_data' => [],
            'payment_method_data' => [],
            'payment_method_options' => [],
            'return_url' => '',
            'use_stripe_sdk' => '',
        ], $data);

        return $this->sendRequest($data, 'setup-intents');
    }

    public function verifyMicrodeposits(array $data = [])
    {
        $data = array_merge([
            'action' => 'verifyMicrodeposits',
            'service' => 'stripe',
            'setup_intent_id' => 'seti_1RE4QSS0vtd2x8w9HEJwqwTd',
            'amounts' => [100, 200],
            'descriptor_code' => 'SM1234',
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
            'amount' => 10000, // updated from your input
            'currency' => 'USD',

            'automatic_payment_methods' => [],
            'confirm' => '',
            'customer' => '',
            'description' => '',
            'metadata' => [],
            'off_session' => '',
            'payment_method' => '',
            'receipt_email' => '',
            'setup_future_usage' => '',
            'shipping' => [],
            'statement_descriptor' => '',
            'statement_descriptor_suffix' => '',
            'application_fee_amount' => '',
            'capture_method' => '',
            'confirmation_method' => '',
            'confirmation_token' => '',
            'error_on_requires_action' => '',
            'mandate' => '',
            'mandate_data' => [],
            'on_behalf_of' => '',
            'payment_method_configuration' => '',
            'payment_method_data' => [],
            'payment_method_options' => [],
            'payment_method_types' => [],
            'radar_options' => [],
            'transfer_data' => '',
            'transfer_group' => '',
            'use_stripe_sdk' => '',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function updatePaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'updatePaymentIntent',
            'service' => 'stripe',
            'payment_intent_id' => 'pi_3R7Y7wS0vtd2x8w91jhEyrQu', // updated from your input

            'amount' => '',
            'currency' => '',
            'customer' => '',
            'description' => '',
            'metadata' => [],
            'payment_method' => '',
            'receipt_email' => '',
            'setup_future_usage' => '',
            'shipping' => [],
            'statement_descriptor' => '',
            'statement_descriptor_suffix' => '',
            'application_fee_amount' => '',
            'capture_method' => '',
            'payment_method_configuration' => '',
            'payment_method_data' => [],
            'payment_method_options' => [],
            'payment_method_types' => [],
            'transfer_data' => '',
            'transfer_group' => '',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function retrievePaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrievePaymentIntent',
            'service' => 'stripe',
            'payment_intent_id' => 'pi_3RE4WfS0vtd2x8w90okObr2i',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function cancelPaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelPaymentIntent',
            'service' => 'stripe',
            'payment_intent_id' => 'pi_3RE4zVS0vtd2x8w90Qb9aGFI',
            'cancellation_reason' => 'requested_by_customer',
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function capturePaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'capturePaymentIntent',
            'service' => 'stripe',
            'payment_intent_id' => 'pi_3RE4WfS0vtd2x8w90okObr2i',
            'amount_to_capture' => 1500,  // Optional: specify the amount to capture
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function confirmPaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'confirmPaymentIntent',
            'service' => 'stripe',
            'payment_intent_id' => 'pi_3RE4WfS0vtd2x8w90okObr2i',
            'payment_method' => 'pm_card_visa', // Example of payment method
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function searchPaymentIntents(array $data = [])
    {
        $data = array_merge([
            'action' => 'searchPaymentIntent',
            'service' => 'stripe',
            'query' => 'amount:500',  // Example search query
            'limit' => 5,  // Default limit for search
        ], $data);

        return $this->sendRequest($data, 'payment-intents');
    }

    public function verifyPaymentIntentMicrodeposits(array $data = [])
    {
        $data = array_merge([
            'action' => 'verifyMicrodeposits',
            'service' => 'stripe',
            'payment_intent_id' => 'pi_3R7XB6S0vtd2x8w91s9M2NZQ', // updated ID
            'amounts' => [32, 45], // from input
            'descriptor_code' => '', // empty as per input
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
            'payment_intent_id' => 'pi_3RE4WfS0vtd2x8w90okObr2i',
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
            'payment_intent_id' => 'pi_3RE4WfS0vtd2x8w90okObr2i',
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
            'charge' => 'ch_3RE5JXS0vtd2x8w91X9BHW0U', // updated from input
            'amount' => 100, // updated from input
            'metadata' => [],
            // 'payment_intent' => '3242', // updated from input
            'reason' => '',
            'instructions_email' => '',
            'origin' => '',
            'refund_application_fee' => false,
            'reverse_transfer' => false,
        ], $data);

        return $this->sendRequest($data, 'refund');
    }

    public function updateRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'updateRefund',
            'service' => 'stripe',
            'refund_id' => 're_3RE5JXS0vtd2x8w910O8IzZj', // Example refund ID
            'metadata' => ['updated' => true], // Update metadata
        ], $data);

        return $this->sendRequest($data, 'refund');
    }

    public function retrieveRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveRefund',
            'service' => 'stripe',
            'refund_id' => 're_3RE5JXS0vtd2x8w910O8IzZj',  // Refund ID
        ], $data);

        return $this->sendRequest($data, 'refund');
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

        return $this->sendRequest($data, 'refund');
    }

    public function cancelRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelRefund',
            'service' => 'stripe',
            'refund_id' => 're_3RE5JXS0vtd2x8w910O8IzZj',  // Refund ID
        ], $data);

        return $this->sendRequest($data, 'refund');
    }

    // ==========================
    // PAYMENT METHOD OPERATIONS
    // ==========================

    public function createPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'createPaymentMethod',
            'service' => 'stripe',
            'type' => 'us_bank_account', // Example type, you can change this dynamically
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
            'us_bank_account' => [
                'account_holder_type' => 'individual',
                'account_number' => '000123456789',
                'routing_number' => '110000000',
            ],
            // 'card' => [
            //     'number' => '4242424242424242',
            //     'exp_month' => 12,
            //     'exp_year' => 2025,
            //     'cvc' => '123',
            // ],
            'acss_debit' => [], // Add additional fields based on type
            'affirm' => [],
            'afterpay_clearpay' => [],
            'alipay' => null,
            'alma' => [],
            'amazon_pay' => [],
            'au_becs_debit' => null,
            'bacs_debit' => [],
            'bancontact' => [],
            'blik' => null,
            'boleto' => null,
            'cashapp' => null,
            'customer_balance' => null,
            'eps' => null,
            'fpx' => null,
            'giropay' => null,
            'grabpay' => null,
            'ideal' => [],
            'interac_present' => null,
            'kakao_pay' => null,
            'klarna' => [],
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
            'paypal' => [],
            'pix' => null,
            'promptpay' => null,
            'radar_options' => null,
            'revolut_pay' => null,
            'samsung_pay' => null,
            'sepa_debit' => [],
            'sofort' => [],
            'swish' => null,
            'twint' => null,
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
            'payment_method_id' => 'pm_1RE5ksS0vtd2x8w9ZvirOBXw', // updated from input

            'billing_details' => [], // cleared
            'metadata' => [],
            'allow_redisplay' => '',
            'card' => [],
            'link' => [],
            'pay_by_bank' => [],
            'us_bank_account' => [],
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function retrievePaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrievePaymentMethod',
            'service' => 'stripe',
            'payment_method_id' => 'pm_1RE5ksS0vtd2x8w9ZvirOBXw',  // Payment Method ID
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
            'payment_method_id' => 'pm_1RE5ksS0vtd2x8w9ZvirOBXw',
            'customer_id' => 'cus_S8Mu3YNTxaQ9J8',
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function detachPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'detachPaymentMethod',
            'service' => 'stripe',
            'payment_method_id' => 'pm_1RE5ksS0vtd2x8w9ZvirOBXw',
            'payment_method' => 'card',
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function reinstatePaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'reinstatePaymentMethod',
            'service' => 'stripe',
            'payment_method_id' => 'pm_1RE5ksS0vtd2x8w9ZvirOBXw',
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function retrieveCustomerPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveCustomerPaymentMethod',
            'service' => 'stripe',
            'customer_id' => 'cus_S8Mu3YNTxaQ9J8',  // Example customer ID
            'payment_method_id' => 'pm_1RE5ksS0vtd2x8w9ZvirOBXw',  // Example payment method ID
        ], $data);

        return $this->sendRequest($data, 'payment-methods');
    }

    public function listCustomerPaymentMethods(array $data = [])
    {
        $data = array_merge([
            'action' => 'listCustomerPaymentMethods',
            'service' => 'stripe',
            'customer_id' => 'cus_S8Mu3YNTxaQ9J8',  // Example customer ID
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
            'currency' => 'usd',

            'line_items' => [
                [
                    'price' => 'price_1R904WS0vtd2x8w9RUaORMNx',
                    'quantity' => 2,
                ]
            ],

            'metadata' => [
                'order_id' => 'IWER234',
            ],
            'after_completion' => null,
            'allow_promotion_codes' => '',
            'application_fee_amount' => '',
            'application_fee_percent' => '',
            'automatic_tax' => [],
            'billing_address_collection' => '',
            'consent_collection' => [],
            'custom_fields' => [],
            'custom_text' => [],
            'customer_creation' => '',
            'inactive_message' => '',
            'invoice_creation' => [],
            'on_behalf_of' => '',
            'optional_items' => [],
            'payment_intent_data' => [],
            'payment_method_collection' => '',
            'payment_method_types' => ['card'],
            'phone_number_collection' => [],
            'restrictions' => [],
            'shipping_address_collection' => [],
            'shipping_options' => [],
            'submit_type' => '',
            'subscription_data' => [],
            'tax_id_collection' => [],
        ], $data);

        return $this->sendRequest($data, 'payment-links');
    }

    public function updatePaymentLink(array $data = [])
    {
        $data = array_merge([
            'action' => 'updatePaymentLink',
            'service' => 'stripe',
            'payment_link_id' => 'plink_1RBweOS0vtd2x8w9a8k9JBg0', // updated from input
            'active' => '',
            'line_items' => '',
            'metadata' => [],
            'after_completion' => null,
            'allow_promotion_codes' => '',
            'automatic_tax' => [],
            'billing_address_collection' => '',
            'custom_fields' => [],
            'custom_text' => [],
            'customer_creation' => '',
            'inactive_message' => '',
            'invoice_creation' => [],
            'payment_intent_data' => [],
            'payment_method_collection' => '',
            'payment_method_types' => ['card'],
            'phone_number_collection' => [],
            'restrictions' => [],
            'shipping_address_collection' => [],
            'submit_type' => '',
            'subscription_data' => [],
            'tax_id_collection' => [],
        ], $data);

        return $this->sendRequest($data, 'payment-links');
    }

    public function retrievePaymentLink(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrievePaymentLink',
            'service' => 'stripe',
            'payment_link_id' => 'plink_1RBweOS0vtd2x8w9a8k9JBg0', // Example payment link ID
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
            'payment_link_id' => 'plink_1RBweOS0vtd2x8w9a8k9JBg0',  // Example payment link ID
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
            'currency' => 'usd',
            'product_data' => [
                'name' => 'Gold', // From input
            ],
            // 'unit_amount' => 10000, // From input
            'active' => '',
            'metadata' => [],
            'nickname' => '',
            // 'product' => '', // intentionally excluded as commented in input
            'recurring' => [],
            'tax_behavior' => '',
            'billing_scheme' => '',
            'currency_options' => [],
            'custom_unit_amount' => [],
            'lookup_key' => '',
            // 'product_data' => [], // already used above
            'tiers' => [],
            'tiers_mode' => '',
            'transfer_lookup_key' => '',
            'transform_quantity' => [],
            'unit_amount_decimal' => '1000.0',
        ], $data);

        return $this->sendRequest($data, 'prices');
    }

    public function updatePrice(array $data = [])
    {
        $data = array_merge([
            'action' => 'updatePrice',
            'service' => 'stripe',
            'price_id' => 'price_1RE6TES0vtd2x8w99gudpdXb', // Example price ID
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
            'price_id' => 'price_1RE6TES0vtd2x8w99gudpdXb',  // Price ID
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
            'action' => 'searchPrices',
            'service' => 'stripe',
            'query' => 'metadata["order_id"]:"34"', // Example search query
            'limit' => 5, // Default limit for search
        ], $data);

        return $this->sendRequest($data, 'prices');
    }
}
