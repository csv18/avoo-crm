<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Strategies\Payment\PaymentServiceStrategy;
use Illuminate\Http\Request;

class CustomerController extends Controller
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

    public function retrieve(Request $request, string $customer_id)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->retrieveCustomer(['customer_id' => $customer_id]);
        return response()->json($response);
    }

    public function delete(Request $request, string $customer_id)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->deleteCustomer(['customer_id' => $customer_id]);
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
