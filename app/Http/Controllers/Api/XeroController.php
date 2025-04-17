<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Strategies\Accounting\AccountingServiceStrategy;
use Illuminate\Http\Request;

class XeroController extends Controller
{
    public function getAccounts(Request $request)
    {
        $xero = AccountingServiceStrategy::getStrategy('xero');
        return response()->json($xero->getAccounts());
    }

    public function createAccount(Request $request)
    {
        $xero = AccountingServiceStrategy::getStrategy('xero');
        return response()->json($xero->createAccount());
    }

    public function getInvoices(Request $request)
    {
        $xero = AccountingServiceStrategy::getStrategy('xero');
        return response()->json($xero->getInvoices());
    }

    public function createInvoice(Request $request)
    {
        $xero = AccountingServiceStrategy::getStrategy('xero');
        return response()->json($xero->createInvoice());
    }

    public function getContacts(Request $request)
    {
        $xero = AccountingServiceStrategy::getStrategy('xero');
        return response()->json($xero->getContacts());
    }

    public function createItem(Request $request)
    {
        $xero = AccountingServiceStrategy::getStrategy('xero');
        return response()->json($xero->createItem());
    }

    public function createPayment(Request $request)
    {
        $xero = AccountingServiceStrategy::getStrategy('xero');
        return response()->json($xero->createPayment());
    }
}
