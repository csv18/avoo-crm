<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RetrieveCustomerRequest;
use App\Strategies\Payment\PaymentServiceStrategy;
use Illuminate\Http\Request;

class PaymentCustomerController extends Controller
{
    public function create(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->createCustomer($request->all());
        return response()->json($response);
    }

    public function update(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->updateCustomer($request->all());
        return response()->json($response);
    }

    public function retrieve(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->retrieveCustomer();
        return response()->json($response);
    }

    public function delete(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->deleteCustomer();
        return response()->json($response);
    }

    public function list(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->listCustomers($request->all());
        return response()->json($response);
    }

    public function search(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->searchCustomer($request->all());
        return response()->json($response);
    }
}
