<?php

namespace App\Services\Accounting;

use App\Services\BaseRemoteService;

class XeroService extends BaseRemoteService
{
    protected string $service = 'xero';

    public function getAccounts(array $data = [])
    {
        $data = array_merge([
            'action' => 'getAccounts',
            'service' => $this->service,
        ], $data);

        return $this->sendRequest($data, 'accounting');
    }

    public function createAccount(array $data = [])
    {
        $data = array_merge([
            'action' => 'createAccount',
            'service' => $this->service,

            'code'                    => '',
            'name'                    => '',
            'type'                    => '',
            'taxType'                 => '',
            'description'             => '',
            'enablePaymentsToAccount' => false,
            'showInExpenseClaims'     => false,
            'BankAccountNumber'       => '',

        ], $data);


        return $this->sendRequest($data, 'accounting');
    }

    public function getInvoices(array $data = [])
    {
        $data = array_merge([
            'action' => 'getInvoices',
            'service' => $this->service,
        ], $data);

        return $this->sendRequest($data, 'accounting');
    }

    public function createInvoice(array $data = [])
    {
        $data = array_merge([
            'action' => 'createInvoice',
            'service' => $this->service,

            // Account-specific defaults
            'code' => '',
            'name' => '',
            'type' => '',
            'taxType' => '',
            'description' => '',
            'enablePaymentsToAccount' => false,
            'showInExpenseClaims' => false,
            'BankAccountNumber' => '',

            // Added invoice-related fields
            'contact'               => [],
            'lineItems'             => [],
            'date'                  => now()->toDateString(),
            'dueDate'               => null,
            'lineAmountTypes'       => '',
            'invoiceNumber'         => '',
            'reference'             => '',
            'brandingThemeID'       => '',
            'url'                   => '',
            'currencyCode'          => '',
            'currencyRate'          => null,
            'status'                => '',
            'sentToContact'         => false,
            'expectedPaymentDate'   => null,
            'plannedPaymentDate'    => null,

        ], $data);

        return $this->sendRequest($data, 'accounting');
    }

    public function getContacts(array $data = [])
    {
        $data = array_merge([
            'action' => 'getContacts',
            'service' => $this->service,
        ], $data);

        return $this->sendRequest($data, 'accounting');
    }

    public function createItem(array $data = [])
    {
        $data = array_merge([
            'action' => 'createItem',
            'service' => $this->service,
            'items' => [[
                'code'                          => '',
                'name'                          => '',
                'isSold'                        => false,
                'isPurchased'                   => false,
                'description'                   => '',
                'purchaseDescription'           => '',
                'purchaseDetails' => [
                    'unitPrice'                 => null,
                    'accountCode'               => '',
                    'taxType'                   => ''
                ],
                'salesDetails' => [
                    'unitPrice'                 => null,
                    'accountCode'               => '',
                    'taxType'                   => ''
                ]
            ]]
        ], $data);

        return $this->sendRequest($data, 'accounting');
    }

    public function createPayment(array $data = [])
    {
        $data = array_merge([
            'action' => 'createPayment',
            'service' => $this->service,

            'Invoice' => [
                'InvoiceID' => '',
            ],
            'Account' => [
                'Code' => '',
            ],
            'Date' => now()->toDateString(),
            'Amount' => 0.01,

        ], $data);

        return $this->sendRequest($data, 'accounting');
    }
}
