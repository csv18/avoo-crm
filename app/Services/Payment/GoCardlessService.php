<?php

namespace App\Services\Payment;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Services\BaseRemoteService;

class GoCardlessService extends BaseRemoteService
{
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

        return $this->sendRequest($data, 'customers', 'payment/');
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

        return $this->sendRequest($data, 'customers', 'payment/');
    }

    public function retrieveCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveCustomer',
            'service' => 'gocardless',
            'customer_id' => 'CU001FRKGXFTVJ',
        ], $data);

        return $this->sendRequest($data, 'customers', 'payment/');
    }

    public function deleteCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'deleteCustomer',
            'service' => 'gocardless',
            'customer_id' => 'CU001FRKGXFTVJ',
        ], $data);

        return $this->sendRequest($data, 'customers', 'payment/');
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

        return $this->sendRequest($data, 'customers', 'payment/');
    }

    public function searchCustomer(array $data = [])
    {
        $data = array_merge([
            'action' => 'searchCustomer',
            'service' => 'gocardless',
            'query' => 'Avoo', // Custom search logic on DB side
        ], $data);

        return $this->sendRequest($data, 'customers', 'payment/');
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

        return $this->sendRequest($data, 'charges', 'payment/');
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

        return $this->sendRequest($data, 'charges', 'payment/');
    }

    public function retrieveCharge(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveCharge',
            'service' => 'gocardless',
            'charge_id' => 'ch_3R6r2dS0vtd2x8w91TPCrrct', // Required
        ], $data);

        return $this->sendRequest($data, 'charges', 'payment/');
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

        return $this->sendRequest($data, 'charges', 'payment/');
    }

    public function cancelCharge(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelCharge',
            'service' => 'gocardless',
            'charge_id' => 'ch_3R6r2dS0vtd2x8w91TPCrrct', // Required
        ], $data);

        return $this->sendRequest($data, 'charges', 'payment/');
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

        return $this->sendRequest($data, 'charges', 'payment/');
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

        return $this->sendRequest($data, 'charges', 'payment/');
    }

    public function captureCharge(array $data = [])
    {
        $data = array_merge([
            'action' => 'captureCharge',
            'service' => 'gocardless',

            'charge_id' => 'ch_3R6r2dS0vtd2x8w91TPCrrct', // Required
        ], $data);

        return $this->sendRequest($data, 'charges', 'payment/');
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

        return $this->sendRequest($data, 'setup-intents', 'payment/');
    }

    public function retrieveSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveSetupIntent',
            'service' => 'gocardless',
            'setup_intent_id' => 'RE00073Z8MQ6F0MM1GY8TFW3VGSRC63B', // Required
            'client_secret' => ''
        ], $data);

        return $this->sendRequest($data, 'setup-intents', 'payment/');
    }

    public function confirmSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'confirmSetupIntent',
            'service' => 'gocardless',
            'setup_intent_id' => 'RE00073Z8MQ6F0MM1GY8TFW3VGSRC63B', // Required
            'session_token' => '1212',   // Required
        ], $data);

        return $this->sendRequest($data, 'setup-intents', 'payment/');
    }

    public function listSetupIntents(array $data = [])
    {
        $data = array_merge([
            'action' => 'listSetupIntents',
            'service' => 'gocardless',
            'limit' => 5,
        ], $data);

        return $this->sendRequest($data, 'setup-intents', 'payment/');
    }

    public function updateSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'updateSetupIntent',
            'service' => 'gocardless',
            'setup_intent_id' => 'seti_1R7D1ZS0vtd2x8w9HUbloAU7', // Required
        ], $data);

        return $this->sendRequest($data, 'setup-intents', 'payment/');
    }

    public function cancelSetupIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelSetupIntent',
            'service' => 'gocardless',
            'setup_intent_id' => 'seti_1R7D1ZS0vtd2x8w9HUbloAU7', // Required
        ], $data);

        return $this->sendRequest($data, 'setup-intents', 'payment/');
    }

    public function verifyMicrodeposits(array $data = [])
    {
        $data = array_merge([
            'action' => 'verifyMicrodeposits',
            'service' => 'gocardless',
            'setup_intent_id' => 'seti_1R7D1ZS0vtd2x8w9HUbloAU7', // Required
        ], $data);

        return $this->sendRequest($data, 'setup-intents', 'payment/');
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

        return $this->sendRequest($data, 'payment-intents', 'payment/');
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

        return $this->sendRequest($data, 'payment-intents', 'payment/');
    }

    public function retrievePaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrievePaymentIntent',
            'service' => 'gocardless',
            'payment_intent_id' => 'pi_3R7Y7wS0vtd2x8w91jhEyrQu',
        ], $data);

        return $this->sendRequest($data, 'payment-intents', 'payment/');
    }

    public function listPaymentIntents(array $data = [])
    {
        $data = array_merge([
            'action' => 'listPaymentIntents',
            'service' => 'gocardless',
            'limit' => 10,
        ], $data);

        return $this->sendRequest($data, 'payment-intents', 'payment/');
    }

    public function cancelPaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelPaymentIntent',
            'service' => 'gocardless',
            'payment_intent_id' => 'pi_3R7Y7wS0vtd2x8w91jhEyrQu',
        ], $data);

        return $this->sendRequest($data, 'payment-intents', 'payment/');
    }

    public function capturePaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'capturePaymentIntent',
            'service' => 'gocardless',
            'payment_intent_id' => 'pi_3R7Y7wS0vtd2x8w91jhEyrQu',
        ], $data);

        return $this->sendRequest($data, 'payment-intents', 'payment/');
    }

    public function confirmPaymentIntent(array $data = [])
    {
        $data = array_merge([
            'action' => 'confirmPaymentIntent',
            'service' => 'gocardless',
            'payment_intent_id' => 'pi_3R7Y7wS0vtd2x8w91jhEyrQu',
        ], $data);

        return $this->sendRequest($data, 'payment-intents', 'payment/');
    }

    public function incrementAuthorization(array $data = [])
    {
        $data = array_merge([
            'action' => 'incrementAuthorization',
            'service' => 'gocardless',
            'payment_intent_id' => 'pi_3R7Y7wS0vtd2x8w91jhEyrQu',
            'amount' => 10,
        ], $data);

        return $this->sendRequest($data, 'payment-intents', 'payment/');
    }

    public function applyCustomerBalance(array $data = [])
    {
        $data = array_merge([
            'action' => 'applyCustomerBalance',
            'service' => 'gocardless',
            'payment_intent_id' => 'pi_3R7Y7wS0vtd2x8w91jhEyrQu',
        ], $data);

        return $this->sendRequest($data, 'payment-intents', 'payment/');
    }

    public function searchPaymentIntents(array $data = [])
    {
        $data = array_merge([
            'action' => 'searchPaymentIntent',
            'service' => 'gocardless',
            'query' => 'Avoo',
            'limit' => 5,
        ], $data);

        return $this->sendRequest($data, 'payment-intents', 'payment/');
    }

    public function verifyPaymentIntentMicrodeposits(array $data = [])
    {
        $data = array_merge([
            'action' => 'verifyMicrodeposits',
            'service' => 'gocardless',
            'payment_intent_id' => 'pi_3R7Y7wS0vtd2x8w91jhEyrQu',
            'amounts' => [12, 14],
        ], $data);

        return $this->sendRequest($data, 'payment-intents', 'payment/');
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

        return $this->sendRequest($data, 'refund', 'payment/');
    }

    public function updateRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'updateRefund',
            'service' => 'gocardless',
            'refund_id' => 'rd_3hjb243',       // required
            'metadata' => ['order_id' => '23'],        // required
        ], $data);

        return $this->sendRequest($data, 'refund', 'payment/');
    }

    public function retrieveRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveRefund',
            'service' => 'gocardless',
            'refund_id' => 'rd_3hjb243',       // required
        ], $data);

        return $this->sendRequest($data, 'refund', 'payment/');
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

        return $this->sendRequest($data, 'refund', 'payment/');
    }

    public function cancelRefund(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelRefund',
            'service' => 'gocardless',
            'refund_id' => 'rd_3hjb243',     // required
        ], $data);

        return $this->sendRequest($data, 'refund', 'payment/');
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


        return $this->sendRequest($data, 'payment-methods', 'payment/');
    }

    public function updatePaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'updatePaymentMethod',
            'service' => 'gocardless',
            'payment_method_id' => 'pm_1RBwHvS0vtd2x8w9O0tcZzYe',  // required
            'metadata' => [],
        ], $data);

        return $this->sendRequest($data, 'payment-methods', 'payment/');
    }

    public function retrievePaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrievePaymentMethod',
            'service' => 'gocardless',
            'payment_method_id' => 'pm_1RBwHvS0vtd2x8w9O0tcZzYe',  // required
        ], $data);

        return $this->sendRequest($data, 'payment-methods', 'payment/');
    }

    public function listCustomerPaymentMethods(array $data = [])
    {
        $data = array_merge([
            'action' => 'listCustomerPaymentMethods',
            'service' => 'gocardless',
            'customer_id' => 'cus_423bh45',  // required
        ], $data);

        return $this->sendRequest($data, 'payment-methods', 'payment/');
    }

    public function cancelPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'cancelPaymentMethod',
            'service' => 'gocardless',
            'payment_method_id' => 'pm_1RBwHvS0vtd2x8w9O0tcZzYe',  // required
        ], $data);

        return $this->sendRequest($data, 'payment-methods', 'payment/');
    }

    public function reinstatePaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'reinstatePaymentMethod',
            'service' => 'gocardless',
            'payment_method_id' => 'pm_1RBwHvS0vtd2x8w9O0tcZzYe',  // required
        ], $data);

        return $this->sendRequest($data, 'payment-methods', 'payment/');
    }

    public function retrieveCustomerPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveCustomerPaymentMethod',
            'service' => 'gocardless',
            'customer_id' => 'cus_S8Mu3YNTxaQ9J8',  // Example customer ID
            'payment_method_id' => 'pm_1RE5ksS0vtd2x8w9ZvirOBXw',  // Example payment method ID
        ], $data);

        return $this->sendRequest($data, 'payment-methods', 'payment/');
    }

    public function listPaymentMethods(array $data = [])
    {
        $data = array_merge([
            'action' => 'listPaymentMethods',
            'service' => 'gocardless',
        ], $data);

        return $this->sendRequest($data, 'payment-methods', 'payment/');
    }

    public function attachPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'attachPaymentMethod',
            'service' => 'gocardless',
            'payment_method_id' => 'pm_1RE5ksS0vtd2x8w9ZvirOBXw',
            'customer_id' => 'cus_S8Mu3YNTxaQ9J8',
        ], $data);

        return $this->sendRequest($data, 'payment-methods', 'payment/');
    }

    public function detachPaymentMethod(array $data = [])
    {
        $data = array_merge([
            'action' => 'detachPaymentMethod',
            'service' => 'gocardless',
            'payment_method_id' => 'pm_1RE5ksS0vtd2x8w9ZvirOBXw',
            'payment_method' => 'card',
        ], $data);

        return $this->sendRequest($data, 'payment-methods', 'payment/');
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


        return $this->sendRequest($data, 'payment-links', 'payment/');
    }

    public function initialisePaymentLink(array $data = [])
    {
        $data = array_merge([
            'action' => 'initialisePaymentLink',
            'service' => 'gocardless',
            'billing_request_flow_id' => 'brf_435nj', // required
            'billing_template_id' => 'brf_435nj', // required
        ], $data);

        return $this->sendRequest($data, 'payment-links', 'payment/');
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

        return $this->sendRequest($data, 'payment-links', 'payment/');
    }

    public function retrievePaymentLink(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrievePaymentLink',
            'service' => 'gocardless',
            'payment_link_id' => 'brf_435nj', // required
        ], $data);

        return $this->sendRequest($data, 'payment-links', 'payment/');
    }

    public function listPaymentLinks(array $data = [])
    {
        $data = array_merge([
            'action' => 'listPaymentLinks',
            'service' => 'gocardless',
            'limit' => 5,  // Default limit, can customize
        ], $data);

        return $this->sendRequest($data, 'payment-links', 'payment/');
    }

    public function retrieveLineItems(array $data = [])
    {
        $data = array_merge([
            'action' => 'retrieveLineItems',
            'service' => 'gocardless',
            'payment_link_id' => 'brf_435nj', // required
        ], $data);
        return $this->sendRequest($data, 'payment-links', 'payment/');
    }

    public function createPrice(array $data = [])
    {
        $data = array_merge([
            'action' => 'createPrice',
            'service' => 'gocardless',

            // Required fields
            'currency' => 'usd',
            'product_data' => [
                'name' => 'Gold'
            ],
            'unit_amount' => 10000,

            // New fields (with placeholders to be filled)
            'active' => null,  // Optional: Set whether the price is active
            'metadata' => [],  // Optional: Custom metadata for the price
            'nickname' => null,  // Optional: Nickname for the price
            'product' => '5436',  // Optional: Product ID or reference
            'recurring' => null,  // Optional: Set if recurring
            'tax_behavior' => null,  // Optional: Set tax behavior (e.g., exclusive or inclusive)
            'billing_scheme' => null,  // Optional: Billing scheme for pricing
            'currency_options' => null,  // Optional: Currency options
            'custom_unit_amount' => null,  // Optional: Custom unit amount
            'lookup_key' => null,  // Optional: Lookup key for the price
            'tiers' => null,  // Optional: Pricing tiers
            'tiers_mode' => null,  // Optional: Mode for pricing tiers
            'transfer_lookup_key' => null,  // Optional: Transfer lookup key
            'transform_quantity' => null,  // Optional: Quantity transformation
            'unit_amount_decimal' => null,  // Optional: Decimal unit amount

        ], $data);

        return $this->sendRequest($data, 'prices', 'payment/');
    }

    public function updatePrice(array $data = [])
    {
        $data = array_merge([
            'action' => 'updatePrice',
            'service' => 'gocardless',

            // Required fields
            'price_id' => 'price_1R904WS0vtd2x8w9RUaORMNx', // Set the actual price_id here

            // New fields
            'metadata' => [
                'order_id' => 34, // Set the order_id here
            ],
            'active' => null,  // Optional: Set whether the price is active
            'nickname' => null,  // Optional: Nickname for the price
            'tax_behavior' => null,  // Optional: Tax behavior (e.g., exclusive or inclusive)
            'currency_options' => null,  // Optional: Currency options
            'lookup_key' => null,  // Optional: Lookup key for the price
            'transfer_lookup_key' => null,  // Optional: Transfer lookup key

        ], $data);

        return $this->sendRequest($data, 'prices', 'payment/');
    }

    public function retrievePrice(array $data = [])
    {

        $data = array_merge([
            'action' => 'retrievePrice',
            'service' => 'gocardless',

            // Required fields
            'price_id' => 'price_1R904WS0vtd2x8w9RUaORMNx', // Replace with the actual price_id

        ], $data);

        return $this->sendRequest($data, 'prices', 'payment/');
    }

    public function listPrices(array $data = [])
    {
        $data = array_merge([
            'action' => 'listPrices',
            'service' => 'gocardless',

            // Optional fields
            'active' => null,  // Optional: Set whether the prices are active
            'currency' => null,  // Optional: Currency filter (e.g., 'usd')
            'product' => null,  // Optional: Product ID or reference
            'type' => null,  // Optional: Price type (e.g., one-time, recurring)
            'created' => null,  // Optional: Filter by creation date
            'ending_before' => null,  // Optional: Ending date or pagination filter
            'limit' => null,  // Optional: Limit the number of results
            'lookup_keys' => null,  // Optional: Lookup keys for filtering
            'recurring' => null,  // Optional: Set if recurring
            'starting_after' => null,  // Optional: Starting date or pagination filter

        ], $data);

        return $this->sendRequest($data, 'prices', 'payment/');
    }

    public function searchPrice(array $data = [])
    {
        $data = array_merge([
            'action' => 'searchPrices',
            'service' => 'gocardless',

            // Required fields
            'monolith_customer_id' => 'cus_ty6654sdf',  // Replace with the actual customer ID
            'type' => 2,  // Set to the desired customer type (e.g., '2')
            'name' => 'Vignesh',  // Customer's name
            'email' => 'vigneshcs18172@gmail.com',  // Customer's email
            'query' => 'Avoo',
            // Optional fields
            'phone' => null,  // Optional: Customer's phone number
            'billing_currency_id' => null,  // Optional: Billing currency ID
            'business_registration_number' => null,  // Optional: Customer's business registration number

        ], $data);

        return $this->sendRequest($data, 'prices', 'payment/');
    }
}
